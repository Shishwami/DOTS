<?php
class Queries
{

    function selectQuery($tableName, $tableColumns, $condition, $joinCondition)
    {
        $sql = "SELECT ";
        if ($tableColumns == "") {
            $sql .= "* ";
        } else {
            $sql .= "`" . implode("` , `", $tableColumns) . "`";
        }
        $sql .= " FROM `" . $tableName . "`";

        if (!empty($joinCondition)) {
            $sql .= " " . $joinCondition;
        }

        if ($condition) {

            $sql .= " WHERE ";

            $tableKeys = array_keys($condition);
            $tableValues = array_values($condition);

            for ($i = 0; $i < count($condition); $i++) {
                $sql .= "" . $tableKeys[$i] . " = '" . $tableValues[$i] . "' ";
                if ($i < (count($tableKeys) - 1)) {
                    $sql .= " AND ";
                }
            }
        }
        $sql .= ";";

        return $sql;
    }

    function insertQuery($tableName, $tableKeysAndValues)
    {
        $tableKeys = array_keys($tableKeysAndValues);
        $tableValues = array_values($tableKeysAndValues);

        $sql = "INSERT INTO `" . $tableName . "` (`" . implode('` , `', $tableKeys) . "`) VALUES ('" . implode("' , '", $tableValues) . "')";

        $sql .= ";";
        return $sql;
    }

    function updateQuery($tableName, $tableKeysAndValues, $condition)
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

    function deleteQuery($tableName, $condition)
    {
        $sql = "DELETE FROM $tableName ";
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