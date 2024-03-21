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
    function selectQuery($inputs)
    {

        global $pdo;
        $params = [];
        $sql = "SELECT ";

        if (isset ($inputs['COLUMNS'])) {
            $columns = array_map(function ($column) {
                return "$column";
            }, $inputs['COLUMNS']);
            $sql .= implode(', ', $columns);
        } else {
            $sql .= '*';
        }

        if (isset ($inputs['TABLE'])) {
            $sql .= ' FROM ' . $inputs['TABLE'];
        } else {
            // handle error
            return false;
        }

        if (isset ($inputs['JOIN'])) {
            foreach ($inputs['JOIN'] as $join) {
                $sql .= " {$join['TYPE']} JOIN {$join['table']} ON " . implode(' AND ', $join['ON']);
            }
        }
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

        if (isset ($inputs['ORDER_BY'])) {
            $sql .= ' ORDER BY ' . $inputs['ORDER_BY'];
        }

        $stmt = $pdo->prepare($sql);
        checkStatement(!$stmt);

        // Bind parameters
        foreach ($params as $key => $value) {
            $stmt->bindValue($key + 1, $value);
        }

        checkSuccess(!$stmt->execute());

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
    function insertQuery($inputs)
    {
        global $pdo;

        $tableName = $inputs['TABLE'];
        $data = $inputs['DATA'];

        // Construct the SQL query with placeholders
        $sql = "INSERT INTO $tableName (";
        $sql .= implode(', ', array_keys($data));
        $sql .= ') VALUES (';
        $sql .= rtrim(str_repeat('?, ', count($data)), ', ');
        $sql .= ')';

        // Prepare the statement
        $stmt = $pdo->prepare($sql);
        checkStatement(!$stmt);

        // Bind parameters
        $i = 1;
        foreach ($data as $value) {
            $stmt->bindValue($i++, $value);
        }
        // Execute the statement
        checkSuccess(!$stmt->execute());

        // Return the last inserted ID if needed
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
    function updateQuery($inputs)
    {
        global $pdo;

        $tableName = $inputs['TABLE'];
        $data = $inputs['DATA'];
        $condition = $inputs['WHERE'];

        $sql = "UPDATE $tableName SET ";

        $setPairs = [];
        $setValues = [];
        foreach ($data as $column => $value) {
            $setPairs[] = "$column = ?";
            $setValues[] = $value;
        }
        $sql .= implode(', ', $setPairs);

        $sql .= ' WHERE ';
        $wherePairs = [];
        $whereValues = [];
        foreach ($condition as $column => $value) {
            $wherePairs[] = "$column = ?";
            $whereValues[] = $value;
        }
        $sql .= implode(' AND ', $wherePairs);

        $stmt = $pdo->prepare($sql);
        checkStatement(!$stmt);

        for ($i = 0; $i < count($setValues); $i++) {
            $stmt->bindValue(($i + 1), $setValues[$i]);
        }

        $startIndex = count($setValues) + 1;
        for ($i = 0; $i < count($whereValues); $i++) {
            $stmt->bindValue(($startIndex + $i), $whereValues[$i]);
        }

        checkSuccess(!$stmt->execute());

        return $stmt->rowCount();
    }


    // jsonFormat= '{
    //     "TABLE": "table_name",
    //     "WHERE": {
    //         "condition_column": "condition_value"
    //     }
    // }';
    function deleteQuery($inputs)
    {
        $tableName = $inputs['TABLE'];
        $condition = $inputs['WHERE'];

        $sql = "DELETE FROM $tableName";

        $sql .= ' WHERE ';

        $wherePairs = [];
        foreach ($condition as $column => $value) {
            $wherePairs[] = "$column = '$value'";
        }

        $sql .= implode(' AND ', $wherePairs);

        $sql .= ";";
        return $sql;
    }
}

function checkStatement($stmt)
{
    // echo json_encode(
    //     [
    //         'VALID' => false,
    //         'MESSAGE' => 'SQL Error 1'
    //     ]
    // );
}

function checkSuccess($stmt)
{
    // echo json_encode(
    //     [
    //         'VALID' => false,
    //         'MESSAGE' => 'SQL Error 2'
    //     ]
    // );
}
?>