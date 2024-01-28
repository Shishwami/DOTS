<?php
include "DB_Connect.php";
include "Querries.php";

$inputs = json_decode(file_get_contents("php://input"), true);
$REQUEST = $inputs['REQUEST'];
unset($inputs['REQUEST']);
switch ($REQUEST) {
    case 'INSERT':
        INSERT($inputs, $conn);
        break;
    case 'SELECT':
        SELECT($inputs, $conn);
        break;
}
$conn->close();


function INSERT($inputs, $conn)
{
    $querries = new Querries();
    $valid = false;

    $TABLE_NAME = $inputs['TABLE_NAME'];
    unset($inputs['TABLE_NAME']);

    $sql = $querries->insertQuerry($TABLE_NAME, $inputs);

    if (mysqli_query($conn, $sql)) {
        $valid = true;
    }

    echo json_encode(
        array(
            'VALID' => $valid
        )
    );
}

function SELECT($inputs, $conn)
{
    $querries = new Querries();
    $valid = true;

    $TABLE_NAME = $inputs['TABLE_NAME'];
    unset($inputs['TABLE_NAME']);
    $COLUMNS = $inputs['COLUMNS'];
    unset($inputs['COLUMNS']);

    $sql = $querries->selectQuerry($TABLE_NAME, $COLUMNS, $inputs);


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
                'RESULT' => $rows
            )
        );
    } else {
        echo json_encode(
            array(
                'VALID' => $valid,
            )
        );
    }


}


?>