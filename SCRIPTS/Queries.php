<?php
class Queries
{

    function selectQuery($inputs)
    {

        $TABLE_NAME = $inputs['TABLE_NAME'];
        unset($inputs['TABLE_NAME']);

        $COLUMNS = "";
        if (isset($inputs['COLUMNS'])) {
            $COLUMNS = $inputs['COLUMNS'];
            unset($inputs['COLUMNS']);
        }

        $joinCondition = "";
        if (isset($inputs['JOIN_CONDITION'])) {
            $joinCondition = $inputs['JOIN_CONDITION'];
            unset($inputs['JOIN_CONDITION']);
        }

        $CONDITIONS = "";
        if (isset($inputs['CONDITIONS'])) {
            $joinCondition = $inputs['CONDITIONS'];
            unset($inputs['CONDITIONS']);
        }

        $sql = "SELECT ";
        if ($COLUMNS == "") {
            $sql .= "* ";
        } else {
            $sql .= "`" . implode("` , `", $COLUMNS) . "`";
        }
        $sql .= " FROM `" . $TABLE_NAME . "`";

        if (!empty($joinCondition)) {
            $sql .= " " . $joinCondition;
        }

        if ($CONDITIONS) {

            $sql .= " WHERE ";

            $tableKeys = array_keys($CONDITIONS);
            $tableValues = array_values($CONDITIONS);

            for ($i = 0; $i < count($CONDITIONS); $i++) {
                $sql .= "" . $tableKeys[$i] . " = '" . $tableValues[$i] . "' ";
                if ($i < (count($tableKeys) - 1)) {
                    $sql .= " AND ";
                }
            }
        }
        $sql .= ";";
        function createJoinStatement($joinCondition)
        {

        }
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