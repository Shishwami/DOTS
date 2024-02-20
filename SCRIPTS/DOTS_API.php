<?php
include "DB_Connect.php";
include "Queries.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$sql = "";
try {
    $inputs = json_decode(file_get_contents("php://input"), true);
    $inputs = sanitizeInputs($inputs);
    // var_dump($inputs);

    $REQUEST = $inputs['REQUEST'];

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
        case 'GET_SESSION_HRIS_ID':
            getSessionHrisID();
            break;
        case 'GET_SESSION_DEPT_ID':
            getSessionDeptID();
            break;

        //REMAKE

        case 'GET_DOC_NUM':
            getDocNum($inputs, $conn);
            break;
        case 'GET_ADDRESSEE':
            getAddressee($inputs, $conn);
            break;

        case "GET_DOC_TYPE":
            getOptions('DOTS_DOC_TYPE', 'DOC_TYPE', $conn);
            break;
        case 'GET_DEPT':
            getOptions('DOTS_DOC_DEPT', 'DOC_DEPT', $conn);
            break;
        case 'GET_DOC_OFFICE':
            getOptions('DOTS_DOC_OFFICE', 'DOC_OFFICE', $conn);
            break;
        case 'GET_DOC_PRPS':
            getOptions('DOTS_DOC_PRPS', 'DOC_PRPS', $conn);
            break;

        case 'SEND_DOCUMENT_MAIN':
            sendDocMain($inputs, $conn);
            break;
    }
    $conn->close();


} catch (mysqli_sql_exception $th) {
    // throw $th;
    echo '' . $th->getMessage() . '\r\n asd' . $sql;
}

function INSERT_($inputs, $conn)
{
    $querries = new Queries();
    $valid = false;

    $sql = $querries->insertQuery($inputs);
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

    $sql = $querries->selectQuery($inputs);
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
                'VALID' => $sql,
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
function UPDATE_($inputs, $conn)
{
    $querries = new Queries();
    $valid = false;


    $sql = $querries->updateQuery($inputs);
    // echo $sql;
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

    $sql = $querries->deleteQuery($inputs);
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

function getSessionHrisID()
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

function getSessionDeptID()
{
    $valid = false;

    if (isset($_SESSION["DEPT_ID"])) {
        $valid = true;
        echo json_encode(
            array(
                'VALID' => $valid,
                'DEPT_ID' => $_SESSION["DEPT_ID"],
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
function getDocNum($inputs, $conn)
{
    $querries = new Queries();

    $valid = false;
    $data = array(
        'TABLE' => 'DOTS_DOCUMENT',
        'COLUMNS' => array(
            'DOC_NUM',
        ),
        'ORDER_BY' => 'DOC_NUM DESC'
    );

    $sql = $querries->selectQuery($data);
    // echo $sql;
    $result = mysqli_query($conn, $sql);

    $doc_num = 0;
    if ($result) {
        $valid = true;
        $row = $result->fetch_assoc();
        $doc_num = $row['DOC_NUM'];
        $doc_num = intval($doc_num) + 1;
        // var_dump($result);
    }

    echo json_encode(
        array(
            'VALID' => $valid,
            'RESULT' => $doc_num
        )
    );
}
function getOptions($tableName, $columnName, $conn)
{
    $querries = new Queries();

    $valid = false;
    $data = array(
        'TABLE' => $tableName,
        'COLUMNS' => array(
            'ID',
            $columnName,
        ),
    );

    $sql = $querries->selectQuery($data);
    // echo $sql;
    $result = mysqli_query($conn, $sql);

    $options = "<option value='' selected disabled>Please Select " . ucwords(str_replace('_', ' ', $columnName)) . "</option>";
    if ($result) {
        $valid = true;
        while ($row = $result->fetch_assoc()) {
            $options .= '<option value="' . $row['ID'] . '">' . $row[$columnName] . '</option>';
        }
    }
    echo json_encode(
        array(
            'VALID' => $valid,
            'RESULT' => $options
        )
    );
}
function getAddressee($inputs, $conn)
{
    $querries = new Queries();

    $valid = false;
    $data = array(
        'TABLE' => 'DOTS_ACCOUNT_INFO',
        'COLUMNS' => array(
            'HRIS_ID',
            'FULL_NAME',
        ),
        'WHERE' => [
            'AND' => ['DEPT_ID' => $inputs['DEPT_ID']],
        ]
    );

    $sql = $querries->selectQuery($data);
    // echo $sql;
    $result = mysqli_query($conn, $sql);


    $options = "<option value='' selected disabled>Please Select Department</option>";
    if ($result) {
        $valid = true;
        while ($row = $result->fetch_assoc()) {
            $options .= '<option value="' . $row['HRIS_ID'] . '">' . $row['FULL_NAME'] . '</option>';
        }
    }

    echo json_encode(
        array(
            'VALID' => $valid,
            'RESULT' => $options
        )
    );
}

function sendDocMain($inputs, $conn)
{
    $querries = new Queries();
    $valid = false;


}
?>