<?php
/**
 * Class Queries
 * 
 * Represents a class for executing database queries.
 */
class Queries
{
    /**
     * @var PDO The PDO connection object.
     */
    private $pdo;

    /**
     * Constructs a new Queries object with the given PDO connection.
     * 
     * @param PDO $pdo The PDO connection object to use.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // jsonformat== '{
    //     "COLUMNS": ["t1.column1", "t2.column2", "t3.column3"],
    //     "TABLE": "table1",
    //     "JOIN": [
    //         {
    //             "table": "table2",
    //             "ON": ["t1.id = t2.table1_id"],
    //             "TYPE": "INNER"
    //         },
    //         {
    //             "table": "table3",
    //             "ON": ["t1.id = t3.table1_id"],
    //             "TYPE": "LEFT"
    //         }
    //     ],
    //     "WHERE": {"t1.column4": "value1"},//AND
    //              ["t1.column4": "value1"]//OR
    //     "ORDER BY": "t1.column1",
    //     "LIMIT": 10
    // }';

    /**
     * Executes a SELECT query based on the provided inputs.
     *
     * @param array $inputs An associative array containing parameters for the SELECT query.
     *                      - 'COLUMNS': (optional) An array of column names to select. Default is all columns (*).
     *                      - 'TABLE': The name of the table from which to select data.
     *                      - 'JOIN': (optional) An array of join operations with tables and ON conditions.
     *                               Each join operation should have the keys 'table', 'TYPE', and 'ON'.
     *                      - 'WHERE': (optional) An array defining the WHERE clause conditions.
     *                                 It should be an associative array with logical conditions ('AND' or 'OR'),
     *                                 where each condition is an array of column-value pairs.
     *                      - 'ORDER_BY': (optional) A string defining the ORDER BY clause for sorting results.
     * @return array|bool Returns an array of fetched rows if successful, or false on failure.
     */
    function selectQuery($inputs)
    {
        global $pdo;
        $params = [];
        $sql = "SELECT ";

        // Check if specific columns are requested, otherwise select all (*)
        if (isset ($inputs['COLUMNS'])) {
            $columns = array_map(function ($column) {
                return "$column";
            }, $inputs['COLUMNS']);
            $sql .= implode(', ', $columns);
        } else {
            $sql .= '*';
        }

        // Check if a specific table is provided
        if (isset ($inputs['TABLE'])) {
            $sql .= ' FROM ' . $inputs['TABLE'];
        } else {
            // Handle error if table is not provided
            return false;
        }

        // Check if there are JOIN operations
        if (isset ($inputs['JOIN'])) {
            foreach ($inputs['JOIN'] as $join) {
                $sql .= " {$join['TYPE']} JOIN {$join['table']} ON " . implode(' AND ', $join['ON']);
            }
        }

        // Check if WHERE conditions are provided
        if (isset ($inputs['WHERE'])) {
            $whereData = $inputs['WHERE'];
            $whereConditions = [];
            foreach ($whereData as $key => $value) {
                $innerConditions = [];
                foreach ($value as $key2 => $value2) {
                    foreach ($value2 as $key3 => $value3) {
                        $innerConditions[] = "$key3 = ?";
                        $params[] = $value3;
                    }
                }
                $whereConditions[] = '(' . implode(" $key ", $innerConditions) . ')';
            }
            $sql .= ' WHERE ' . implode(' AND ', $whereConditions);
        }

        // Check if ORDER BY clause is provided
        if (isset ($inputs['ORDER_BY'])) {
            $sql .= ' ORDER BY ' . $inputs['ORDER_BY'];
        }

        // Prepare the SQL statement
        $stmt = $pdo->prepare($sql);
        checkStatement(!$stmt);

        // Bind parameters to the prepared statement
        foreach ($params as $key => $value) {
            $stmt->bindValue($key + 1, $value);
        }

        // Execute the query
        checkSuccess(!$stmt->execute());

        // Fetch and return the results
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // jsonFormat= = '{
    //     "TABLE": "table_name",
    //     "DATA": {
    //         "column1": "value1",
    //         "column2": "value2",
    //         "column3": "value3"
    //     }
    // }';

    /** 
     * Executes an INSERT query based on the provided inputs.
     *
     * @param array $inputs An associative array containing parameters for the INSERT query.
     *                      - 'TABLE': The name of the table into which data will be inserted.
     *                      - 'DATA': An associative array where keys represent column names and values represent data to be inserted.
     * @return int|string Returns the last inserted ID if successful, or false on failure.
     */
    function insertQuery($inputs)
    {
        global $pdo;

        // Extract table name and data from inputs
        $tableName = $inputs['TABLE'];
        $data = $inputs['DATA'];

        // Construct the SQL query with placeholders for values
        $sql = "INSERT INTO $tableName (";
        $sql .= implode(', ', array_keys($data)); // Columns
        $sql .= ') VALUES (';
        $sql .= rtrim(str_repeat('?, ', count($data)), ', '); // Placeholders for values
        $sql .= ')';

        // Prepare the SQL statement
        $stmt = $pdo->prepare($sql);
        checkStatement(!$stmt); // Check if statement preparation fails

        // Bind values to the placeholders
        $i = 1;
        foreach ($data as $value) {
            $stmt->bindValue($i++, $value);
        }

        // Execute the statement
        checkSuccess(!$stmt->execute()); // Check if execution fails

        // Return the last inserted ID
        return $pdo->lastInsertId();
    }


    // jsonFormat = '{
    //     "TABLE": "table_name",
    //     "DATA": {
    //         "column1": "value1",
    //         "column2": "value2",
    //         "column3": "value3"
    //     },
    //     "WHERE": {
    //         "condition_column": "condition_value"
    //     }
    // }';
    /**
     * Executes an UPDATE query based on the provided inputs.
     *
     * @param array $inputs An associative array containing parameters for the UPDATE query.
     *                      - 'TABLE': The name of the table to update.
     *                      - 'DATA': An associative array where keys represent column names and values represent new data to be set.
     *                      - 'WHERE': An associative array where keys represent column names and values represent conditions for the WHERE clause.
     * @return int Returns the number of rows affected by the UPDATE query.
     */
    function updateQuery($inputs)
    {
        global $pdo;

        // Extract table name, data to update, and WHERE conditions from inputs
        $tableName = $inputs['TABLE'];
        $data = $inputs['DATA'];
        $condition = $inputs['WHERE'];

        // Construct the SQL query
        $sql = "UPDATE $tableName SET ";

        // Construct SET clause
        $setPairs = [];
        $setValues = [];
        foreach ($data as $column => $value) {
            $setPairs[] = "$column = ?";
            $setValues[] = $value;
        }
        $sql .= implode(', ', $setPairs);

        // Construct WHERE clause
        $sql .= ' WHERE ';
        $wherePairs = [];
        $whereValues = [];
        foreach ($condition as $column => $value) {
            $wherePairs[] = "$column = ?";
            $whereValues[] = $value;
        }
        $sql .= implode(' AND ', $wherePairs);

        // Prepare the SQL statement
        $stmt = $pdo->prepare($sql);
        checkStatement(!$stmt); // Check if statement preparation fails

        // Bind values to the placeholders in SET clause
        for ($i = 0; $i < count($setValues); $i++) {
            $stmt->bindValue(($i + 1), $setValues[$i]);
        }

        // Bind values to the placeholders in WHERE clause
        $startIndex = count($setValues) + 1;
        for ($i = 0; $i < count($whereValues); $i++) {
            $stmt->bindValue(($startIndex + $i), $whereValues[$i]);
        }

        // Execute the statement
        checkSuccess(!$stmt->execute()); // Check if execution fails

        // Return the number of rows affected by the UPDATE query
        return $stmt->rowCount();
    }


    // jsonFormat= '{
    //     "TABLE": "table_name",
    //     "WHERE": {
    //         "condition_column": "condition_value"
    //     }
    // }';
    // function deleteQuery($inputs)
    // {
    //     $tableName = $inputs['TABLE'];
    //     $condition = $inputs['WHERE'];

    //     $sql = "DELETE FROM $tableName";

    //     $sql .= ' WHERE ';

    //     $wherePairs = [];
    //     foreach ($condition as $column => $value) {
    //         $wherePairs[] = "$column = '$value'";
    //     }

    //     $sql .= implode(' AND ', $wherePairs);

    //     $sql .= ";";
    //     return $sql;
    // }
}

function checkStatement($stmt)
{
    // if ($stmt != false) {
    //     echo json_encode(
    //         [
    //             'VALID' => false,
    //             'MESSAGE' => 'SQL Error 1'
    //         ]
    //     );
    // }
}

function checkSuccess($stmt)
{
    // if ($stmt != false) {
    //     echo json_encode(
    //         [
    //             'VALID' => false,
    //             'MESSAGE' => 'SQL Error 2'
    //         ]
    //     );
    // }
}
?>