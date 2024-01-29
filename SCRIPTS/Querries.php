<?php
class Querries
{

    function selectQuerry($tableName, $tableColumns, $tableKeysAndValues)
    {
        $sql = "SELECT ";
        if ($tableColumns == "") {
            $sql .= "* ";
        } else {
            $sql .= "`" . implode("` , `", $tableColumns) . "`";
        }
        $sql .= " FROM `" . $tableName . "`";
        if ($tableKeysAndValues) {

            $sql .= " WHERE ";

            $tableKeys = array_keys($tableKeysAndValues);
            $tableValues = array_values($tableKeysAndValues);

            for ($i = 0; $i < count($tableKeysAndValues); $i++) {
                $sql .= "" . $tableKeys[$i] . " = '" . $tableValues[$i] . "' ";
                if ($i < (count($tableKeys) - 1)) {
                    $sql .= " AND ";
                }
            }
        }
        $sql .= ";";
        return $sql;
    }

    function insertQuerry($tableName, $tableKeysAndValues)
    {
        $tableKeys = array_keys($tableKeysAndValues);
        $tableValues = array_values($tableKeysAndValues);

        $sql = "INSERT INTO `" . $tableName . "` (`" . implode('` , `', $tableKeys) . "`) VALUES ('" . implode("' , '", $tableValues) . "')";
        
        $sql .= ";";
        return $sql;
    }

    function updateQuerry($tableName, $tableKeysAndValues, $condition)
    {
        $tableKeys = array_keys($tableKeysAndValues);
        $tableValues = array_values($tableKeysAndValues);


        $sql = "UPDATE `" . $tableName . "` SET ";

        for ($i = 0; $i < count($tableKeysAndValues); $i++) {
            $sql .= "`" . $tableKeys[$i] . "` = '" . $tableValues[$i] . "' ";
            if ($i < (count($tableKeysAndValues) - 1)) {
                $sql .= ", ";
            }
        }

        $conditionKeys = array_keys($condition);
        $conditionValues = array_values($condition);

        $sql .= " WHERE ";

        for ($i = 0; $i < count($condition); $i++) {
            $sql .= "`" . $conditionKeys[$i] . "` = '" . $conditionValues[$i] . "'";
            if ($i < (count($condition) - 1)) {
                $sql .= " AND ";
            }
        }

        $sql .= ";";
        return $sql;
    }
}



?>