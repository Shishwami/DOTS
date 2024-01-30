<?php
include "DB_Connect.php";
include "Querries.php";

$inputs = json_decode(file_get_contents("php://input"), true);

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
}
$conn->close();


function INSERT_($inputs, $conn)
{
    $querries = new Querries();
    $valid = false;

    $TABLE_NAME = $inputs['TABLE_NAME'];
    unset($inputs['TABLE_NAME']);


    $sql = $querries->insertQuerry($TABLE_NAME, $inputs);
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

function SELECT_($inputs, $conn)
{
    $querries = new Querries();
    $valid = false;

    $TABLE_NAME = $inputs['TABLE_NAME'];
    unset($inputs['TABLE_NAME']);
    $COLUMNS = "";
    if (isset($inputs['COLUMNS'])) {
        $COLUMNS = $inputs['COLUMNS'];
        unset($inputs['COLUMNS']);
    }

    $sql = $querries->selectQuerry($TABLE_NAME, $COLUMNS, $inputs);
    //echo $sql

    $result = mysqli_query($conn, $sql);
    if ($result) {
        $valid = true;
        $rows = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        mysqli_free_result($result);

        echo json_encode(
            array(
                'VALID' => $valid,
                'SQL' => $sql,
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
    $querries = new Querries();
    $valid = false;

    $TABLE_NAME = $inputs['TABLE_NAME'];
    unset($inputs['TABLE_NAME']);
    $CONDITION = $inputs['CONDITION'];
    $CONDITION = json_decode($CONDITION, true);
    unset($inputs['CONDITION']);

    $sql = $querries->updateQuerry($TABLE_NAME, $inputs, $CONDITION);

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
    $querries = new Querries();
    $valid = false;

    $TABLE_NAME = $inputs['TABLE_NAME'];
    unset($inputs['TABLE_NAME']);
    $CONDITION = $inputs['CONDITION'];
    $CONDITION = json_decode($CONDITION, true);
    unset($inputs['CONDITION']);

    $sql = $querries->deleteQuerry($TABLE_NAME, $CONDITION);
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

function getTime($inputs, $conn)
{
    $valid = false;
    $time = "";

    if (isset($inputs['DATE'])) {
        $time = date("Y-m-d");
        $valid = true;
    }
    if (isset($inputs['TIME'])) {
        $time = date('Y-m-d');
    }
    if (isset($inputs['DATE_TIME'])) {

    }
}

?>