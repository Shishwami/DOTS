<?php
class Queries
{
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

        $sql = "SELECT ";

        if (isset($inputs['COLUMNS'])) {
            $sql .= implode(', ', $inputs['COLUMNS']);
        } else {
            $sql .= '*';
        }

        if (isset($inputs['TABLE'])) {
            $sql .= ' FROM ' . $inputs['TABLE'];
        } else {
            //no table name
        }
        if (isset($inputs['JOIN'])) {
            foreach ($inputs['JOIN'] as $join) {
                $sql .= " {$join['TYPE']} JOIN {$join['table']} ON " . implode(' AND ', $join['ON']);
            }
        }

        if (isset($inputs['WHERE'])) {
            // $whereConditions = [];
            // foreach ($inputs['WHERE'] as $logicalOperator => $conditions) {
            //     $innerConditions = [];
            //     foreach ($conditions as $column => $value) {
            //         $innerConditions[] = "$column = '$value'";
            //     }
            //     $whereConditions[] = '(' . implode(" $logicalOperator ", $innerConditions) . ')';
            // }
            // $sql .= ' WHERE ' . implode(' AND ', $whereConditions);

            $whereData = $inputs['WHERE'];
            $whereConditions = [];
            foreach ($whereData as $key => $value) {
                $innerConditions = [];

                foreach ($value as $key2 => $value2) {
                    foreach ($value2 as $key3 => $value3) {
                        $innerConditions[] = "$key3 = $value3";
                    }
                }
                $whereConditions[] = '(' . implode(" $key ", $innerConditions) . ')';

            }
            $sql .= ' WHERE ' . implode(' AND ', $whereConditions);
        }

        if (isset($inputs['ORDER_BY'])) {
            $sql .= ' ORDER BY ' . $inputs['ORDER_BY'];
        }

        $sql .= ";";
        $sql = str_replace('&#39;', "'", $sql);
        // echo $sql;

        return $sql;
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
        $tableName = $inputs['TABLE'];
        $data = $inputs['DATA'];

        $sql = "INSERT INTO $tableName (";

        $sql .= implode(', ', array_keys($data));

        $sql .= ') VALUES (';

        $sql .= "'" . implode("', '", array_values($data)) . "')";

        $sql .= ";";
        // echo $sql;

        return $sql;
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
        $tableName = $inputs['TABLE'];
        $data = $inputs['DATA'];
        $condition = $inputs['WHERE'];

        $sql = "UPDATE $tableName SET ";

        $setPairs = [];
        foreach ($data as $column => $value) {
            $setPairs[] = "$column = '$value'";
        }
        $sql .= implode(', ', $setPairs);

        $sql .= ' WHERE ';
        $wherePairs = [];
        foreach ($condition as $column => $value) {
            $wherePairs[] = "$column = '$value'";
        }
        $sql .= implode(' AND ', $wherePairs);

        $sql .= ";";
        // echo $sql;
        return $sql;
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
?>