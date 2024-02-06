<?php
include "DB_Connect.php";
include "Queries.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$inputs = json_decode(file_get_contents("php://input"), true);
$inputs = sanitizeInputs($inputs);
// var_dump($inputs);

$REQUEST = $inputs['REQUEST'];
unset($inputs['REQUEST']);
switch ($REQUEST) {
    case 'INSERT':
        INSERT_($inputs, $conn);
        break;
    case 'SELECT':
        SELECT_($inputs, $conn);
        break;
    case 'UPDATE':
        UPDATE_($inputs, $conn);
        break;
    case 'DELETE':
        DELETE_($inputs, $conn);
        break;
    case 'GET_DATE':
        get_Date($inputs);
        break;
    case 'CREATE_SESSION':
        createSession($inputs, $conn);
        break;
    case 'GET_SESSION_NAME':
        getSessionName();
        break;
    case 'GET_SESSION_INITIAL':
        getSessionInitial();
        break;
    case 'GET_SESSION_ID':
        getSessionID();
        break;
}
$conn->close();


function INSERT_($inputs, $conn)
{
    $querries = new Queries();
    $valid = false;

    $TABLE_NAME = $inputs['TABLE_NAME'];
    unset($inputs['TABLE_NAME']);

    $sql = $querries->insertQuery($TABLE_NAME, $inputs);
    // echo $sql;

    if (mysqli_query($conn, $sql)) {
        $valid = true;
    } else {
        echo "Failed to connect to MySQL: " . $conn->connect_error;
    }

    echo json_encode(
        array(
            'VALID' => $valid,
            'SQL' => $sql,
        )
    );
}

function SELECT_($inputs, $conn)
{
    $querries = new Queries();
    $valid = false;

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
    $sql = $querries->selectQuery($TABLE_NAME, $COLUMNS, $inputs, $joinCondition);
    // echo $sql;

    $result = mysqli_query($conn, $sql);
    if ($result) {
        $rows = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
            $valid = true;
        }
        mysqli_free_result($result);

        echo json_encode(
            array(
                'VALID' => $valid,
                // 'SQL' => $sql,
                'RESULT' => $rows
            )
        );
    } else {
        echo json_encode(
            array(
                'VALID' => $valid,
                'SQL' => $sql,
            )
        );
    }


}
function UPDATE_($inputs, $conn)
{
    $querries = new Queries();
    $valid = false;

    $TABLE_NAME = $inputs['TABLE_NAME'];
    unset($inputs['TABLE_NAME']);
    $CONDITION = $inputs['CONDITION'];
    $CONDITION = json_decode($CONDITION, true);
    unset($inputs['CONDITION']);

    $sql = $querries->updateQuery($TABLE_NAME, $inputs, $CONDITION);

    if (mysqli_query($conn, $sql)) {
        $valid = true;
    } else {
        echo "Failed to connect to MySQL: " . $conn->connect_error;
    }

    echo json_encode(
        array(
            'VALID' => $valid
        )
    );
}

function DELETE_($inputs, $conn)
{
    $querries = new Queries();
    $valid = false;

    $TABLE_NAME = $inputs['TABLE_NAME'];
    unset($inputs['TABLE_NAME']);
    
    $CONDITION = $inputs['CONDITION'];
    $CONDITION = json_decode($CONDITION, true);
    unset($inputs['CONDITION']);

    $sql = $querries->deleteQuery($TABLE_NAME, $CONDITION);
    //echo $sql

    if (mysqli_query($conn, $sql)) {
        $valid = true;
    } else {
        echo "Failed to connect to MySQL: " . $conn->connect_error;
    }

    echo json_encode(
        array(
            'VALID' => $valid
        )
    );
}

function get_Date($inputs)
{

    $time = "";
    date_default_timezone_set("Asia/Manila");

    if ($inputs['DATE'] == "DATE") {
        $time = date("Y-m-d");
        $valid = true;
    }
    if ($inputs['DATE'] == "TIME") {
        $time = date('h:i');
    }
    if ($inputs['DATE'] == "DATE_TIME") {
        $time = date("Y-m-d\TH:i");
    }

    if ($time != "") {
        $valid = true;

        echo json_encode(
            array(
                'VALID' => $valid,
                'TIME' => $time,
            )
        );
    } else {
        echo json_encode(
            array(
                'VALID' => $valid
            )
        );
    }
}

function createSession($inputs, $conn)
{
    $valid = false;

    $keys = array_keys($inputs);
    $values = array_values($inputs);

    for ($i = 0; $i < count($inputs); $i++) {
        $_SESSION[$keys[$i]] = $values[$i];
        $valid = true;
    }

    echo json_encode(
        array(
            'VALID' => $valid
        )
    );
}
function getSessionName()
{
    $valid = false;

    if (isset($_SESSION["FULL_NAME"])) {
        $valid = true;
        echo json_encode(
            array(
                'VALID' => $valid,
                'FULLNAME' => $_SESSION["FULL_NAME"],
            )
        );
    } else {
        echo json_encode(
            array(
                'VALID' => $valid
            )
        );
    }
}

function getSessionInitial()
{
    $valid = false;

    if (isset($_SESSION["INITIAL"])) {
        $valid = true;
        echo json_encode(
            array(
                'VALID' => $valid,
                'INITIAL' => $_SESSION["INITIAL"],
            )
        );
    } else {
        echo json_encode(
            array(
                'VALID' => $valid
            )
        );
    }
}

function getSessionID()
{
    $valid = false;

    if (isset($_SESSION["HRIS_ID"])) {
        $valid = true;
        echo json_encode(
            array(
                'VALID' => $valid,
                'HRIS_ID' => $_SESSION["HRIS_ID"],
            )
        );
    } else {
        echo json_encode(
            array(
                'VALID' => $valid
            )
        );
    }
}

function sanitizeInputs($input)
{
    if (is_array($input)) {
        foreach ($input as $key => $value) {
            $input[$key] = sanitizeInputs($value);
        }
    } else {
        $input = filter_var($input, FILTER_SANITIZE_STRING);
    }
    return $input;
}
?>