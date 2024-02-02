<?php
class Querries
{

    function selectQuery($tableName, $tableColumns = "*", $condition = array())
    {
        if (empty($tableName)) {
            throw new InvalidArgumentException("Table name cannot be empty");
        }

        $sql = "SELECT ";
        if (!empty($tableColumns)) {
            if (!is_array($tableColumns)) {
                throw new InvalidArgumentException("Table columns must be an array");
            }
            $sql .= "`" . implode("`, `", $tableColumns) . "`";
        } else {
            $sql .= "*";
        }
        $sql .= " FROM `" . $tableName . "`";

        if (!empty($condition)) {
            $sql .= " WHERE ";
            $conditions = array();
            foreach ($condition as $column => $value) {
                $conditions[] = "`$column` = ?";
            }
            $sql .= implode(" AND ", $conditions);
        }

        return $sql;
    }


    function insertQuery($tableName, $tableKeysAndValues)
    {
        if (empty($tableName)) {
            throw new InvalidArgumentException("Table name cannot be empty");
        }
        if (empty($tableKeysAndValues)) {
            throw new InvalidArgumentException("Table keys and values cannot be empty");
        }

        $tableKeys = array_keys($tableKeysAndValues);
        $tableValues = array_map(function ($value) {
            return "'" . addslashes($value) . "'";
        }, array_values($tableKeysAndValues));

        $sql = "INSERT INTO `" . $tableName . "` (`" . implode('`, `', $tableKeys) . "`) VALUES (" . implode(', ', $tableValues) . ")";

        return $sql;
    }

    function updateQuery($tableName, $tableKeysAndValues, $condition)
    {
        // Validate inputs
        if (empty($tableName)) {
            throw new InvalidArgumentException("Table name cannot be empty");
        }
        if (empty($tableKeysAndValues)) {
            throw new InvalidArgumentException("Table keys and values cannot be empty");
        }
        if (empty($condition)) {
            throw new InvalidArgumentException("Condition cannot be empty for update query");
        }

        // Construct the SQL query
        $sql = "UPDATE `" . $tableName . "` SET ";
        $updates = array();
        foreach ($tableKeysAndValues as $column => $value) {
            $updates[] = "`$column` = '" . addslashes($value) . "'";
        }
        $sql .= implode(", ", $updates);

        $conditions = array();
        foreach ($condition as $column => $value) {
            $conditions[] = "`$column` = '" . addslashes($value) . "'";
        }
        $sql .= " WHERE " . implode(" AND ", $conditions);

        return $sql;
    }

    function deleteQuery($tableName, $condition)
    {
        if (empty($tableName)) {
            throw new InvalidArgumentException("Table name cannot be empty");
        }
        if (empty($condition)) {
            throw new InvalidArgumentException("Condition cannot be empty for delete query");
        }

        $sql = "DELETE FROM `$tableName` WHERE ";
        $conditions = array();
        foreach ($condition as $column => $value) {
            $conditions[] = "`$column` = '" . addslashes($value) . "'";
        }
        $sql .= implode(" AND ", $conditions);

        return $sql;
    }

}



?>