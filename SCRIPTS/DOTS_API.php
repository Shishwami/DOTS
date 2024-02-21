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

        case 'RECEIVE_DOC':
            receiveDoc($inputs, $conn);
            break;
        case 'SEND_DOC_FORM':
            sendDocForm($inputs, $conn);
            break;

        case 'GET_TABLE_MAIN':
            getTableMain($inputs, $conn);
            break;
    }
    $conn->close();


} catch (mysqli_sql_exception $th) {
    // throw $th;
    echo '' . $th->getMessage() . '\r\n asd' . $sql;
}

function INSERT_($inputs, $conn)
{
    $queries = new Queries();
    $valid = false;

    $sql = $queries->insertQuery($inputs);
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
    $queries = new Queries();
    $valid = false;

    $sql = $queries->selectQuery($inputs);
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
    $queries = new Queries();
    $valid = false;

    $sql = $queries->updateQuery($inputs);
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
    $queries = new Queries();
    $valid = false;

    $sql = $queries->deleteQuery($inputs);
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
    $queries = new Queries();

    $valid = false;
    $data = array(
        'TABLE' => 'DOTS_NUM_SEQUENCE',
        'COLUMNS' => array(
            'CURRENT_VALUE',
        ),
        // 'ORDER_BY' => 'DOC_NUM DESC'
    );

    $sql = $queries->selectQuery($data);
    // echo $sql;
    $result = mysqli_query($conn, $sql);

    $doc_num = 0;
    if ($result) {
        $valid = true;
        $row = $result->fetch_assoc();
        $doc_num = 0;
        if (isset($row['CURRENT_VALUE'])) {
            $doc_num = $row['CURRENT_VALUE'];
        }
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
    $queries = new Queries();

    $valid = false;
    $data = array(
        'TABLE' => $tableName,
        'COLUMNS' => array(
            'ID',
            $columnName,
        ),
    );

    $sql = $queries->selectQuery($data);
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
    $queries = new Queries();

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

    $sql = $queries->selectQuery($data);
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

function sendDocForm($inputs, $conn)
{
    $queries = new Queries();
    $valid = false;

    $doc_num = $inputs['DATA']['DOC_NUM'];
    $route_num = $inputs['DATA']['ROUTE_NUM'];

    $insertData = array(
        'TABLE' => 'DOTS_DOCUMENT_INBOUND',
        'DATA' => $inputs['DATA'],
    );
    //chheck if routed

    $checkRouted = array(
        'TABLE' => 'DOTS_DOCUMENT',
        'COLUMNS' => [
            'ID',
            'DOC_NUM',
            'ROUTE_NUM',
            'ROUTED',
        ],
        'WHERE' => array(
            'AND' => array(
                'DOC_NUM' => $doc_num,
                'ROUTE_NUM' => $route_num,
            )
        ),
    );

    $sqlCheckRouted = $queries->selectQuery($checkRouted);

    $result = mysqli_query($conn, $sqlCheckRouted);
    if ($result) {
        $row = $result->fetch_assoc();
        // echo"ashhdshioadhiosad";
        if ($row['ROUTED'] == 0) {
            //send
            $valid = sendDoc($insertData, $conn);
        } else if ($row['ROUTED'] == 1) {
            //resend
            $valid = resendDoc($insertData, $conn);

        }
    }

    echo json_encode(
        array(
            'VALID' => $valid
        )
    );
}

function sendDoc($insertData, $conn)
{
    $queries = new Queries();
    $updateData = array(
        'TABLE' => 'DOTS_DOCUMENT',
        'DATA' => array(
            'DOC_STATUS' => 1,//pending to onhand
            'ROUTED' => 1//routed
        ),
        'WHERE' => array(
            'DOC_NUM' => $insertData['DATA']['DOC_NUM'],
            'ROUTE_NUM' => $insertData['DATA']['ROUTE_NUM'],
        )
    );
    $insertDataSql = $queries->insertQuery($insertData);
    $updateDataSql = $queries->updateQuery($updateData);

    $conn->begin_transaction();

    $resultInsert = $conn->query($insertDataSql);
    $resultUpdate = $conn->query($updateDataSql);

    if ($resultInsert && $resultUpdate) {
        $conn->commit();
        return true;
    } else {
        $conn->rollback();
        return false;
    }
}
function resendDoc($insertData, $conn)
{
    $queries = new Queries();
    $doc_num = $insertData['DATA']['DOC_NUM'];
    //get last route num then add one

    $getRouteNum = array(
        'TABLE' => 'DOTS_DOCUMENT',
        'WHERE' => array(
            'AND' => array(
                'DOC_NUM' => $doc_num
            )
        ),
        'ORDER_BY' => 'ROUTE_NUM DESC'
    );

    $getRouteNumSql = $queries->selectQuery($getRouteNum);
    $result = mysqli_query($conn, $getRouteNumSql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);

        $associativeRow = [];
        foreach ($row as $key => $value) {
            $associativeRow[$key] = $value;
        }
        unset($associativeRow['ID']);

        $routeNum = $associativeRow['ROUTE_NUM'];
        $routeNum = intval($routeNum) + 1;
        $associativeRow['ROUTE_NUM'] = $routeNum;
        // insert it to new doc
        $createData = array(
            'TABLE' => 'DOTS_DOCUMENT',
            'DATA' => $associativeRow,
        );
        $valid = createDoc($createData, $conn);

        //send the new doc
        $insertData['DATA']['ROUTE_NUM'] = $routeNum + 1;
        $insertData2 = array(
            'TABLE' => 'DOTS_DOCUMENT_INBOUND',
            'DATA' => $insertData['DATA']
        );
        $valid = sendDoc($insertData2, $conn);
    }

    return $valid;
}
function receiveDoc($inputs, $conn)
{
    $valid = false;
    $data = $inputs['DATA'];
    $createData = array(
        'TABLE' => 'DOTS_DOCUMENT',
        'DATA' => $data,
    );
    $valid = createDoc($createData, $conn);

    echo json_encode(
        array(
            'VALID' => $valid
        )
    );
}
function createDoc($createData, $conn)
{
    $queries = new Queries();
    $sql = $queries->insertQuery($createData);
    // echo $sql;

    // var_dump($createData);
    if (mysqli_query($conn, $sql)) {
        return true;
    }


}
function getTableMain($inputs, $conn)
{
    $queries = new Queries();
    $data = array(
        'TABLE' => 'DOTS_DOCUMENT',
        'COLUMNS' => [
            'DOTS_DOCUMENT.ID',

            'CASE WHEN ROUTE_NUM = 0 THEN DOTS_DOCUMENT.DOC_NUM 
             ELSE CONCAT(DOTS_DOCUMENT.DOC_NUM,\' - \',ROUTE_NUM) 
             END AS `No.`',

            'DOC_NUM',
            'ROUTE_NUM',
            'DOC_SUBJECT as `Subject`',
            'DOC_NOTES `Notes`',
            'DOC_TYPE `Type`',
            'LETTER_DATE `Letter Date`',

            "CONCAT(
             IF(S_OFFICE.DOC_OFFICE IS NOT NULL,CONCAT(S_OFFICE.DOC_OFFICE,'-'), ' '),' ', 
             IF(S_DEPT.DOC_DEPT IS NOT NULL,CONCAT(S_DEPT.DOC_DEPT,'-'), ' '), 
             IFNULL(S_FULL_NAME.FULL_NAME, ' ')) as 'Sent By'",

            "CONCAT(
            IF(R_OFFICE.DOC_OFFICE IS NOT NULL,CONCAT(R_OFFICE.DOC_OFFICE,'-'), ' '),' ',
            IF(R_DEPT.DOC_DEPT IS NOT NULL,CONCAT(R_DEPT.DOC_DEPT,'-'), ' '), 
            IFNULL(R_FULL_NAME.FULL_NAME, ' ')) as 'Received By'",

            'DATE_TIME_RECEIVED `Date Received`',
            'DOTS_DOC_STATUS.DOC_STATUS `Status`',
            'DOTS_DOC_ACTION.DOC_ACTION `Action`'
        ],
        'JOIN' => [
            array(
                'table' => 'DOTS_DOC_TYPE',
                'ON' => ['DOTS_DOCUMENT.DOC_TYPE_ID = DOTS_DOC_TYPE.ID'],
                'TYPE' => 'LEFT'
            ),
            array(
                'table' => 'DOTS_DOC_OFFICE S_OFFICE',
                'ON' => ['DOTS_DOCUMENT.S_OFFICE_ID = S_OFFICE.ID'],
                'TYPE' => 'LEFT'
            ),
            array(
                'table' => 'DOTS_DOC_DEPT S_DEPT',
                'ON' => ['DOTS_DOCUMENT.S_DEPT_ID = S_DEPT.ID'],
                'TYPE' => 'LEFT'
            ),
            array(
                'table' => 'DOTS_ACCOUNT_INFO S_FULL_NAME',
                'ON' => ['DOTS_DOCUMENT.S_USER_ID = S_FULL_NAME.HRIS_ID'],
                'TYPE' => 'LEFT'
            ),
            array(
                'table' => 'DOTS_DOC_OFFICE R_OFFICE',
                'ON' => ['DOTS_DOCUMENT.R_OFFICE_ID = R_OFFICE.ID'],
                'TYPE' => 'LEFT'
            ),
            array(
                'table' => 'DOTS_DOC_DEPT R_DEPT',
                'ON' => ['DOTS_DOCUMENT.R_DEPT_ID = R_DEPT.ID'],
                'TYPE' => 'LEFT'
            ),
            array(
                'table' => 'DOTS_ACCOUNT_INFO R_FULL_NAME',
                'ON' => ['DOTS_DOCUMENT.R_USER_ID = R_FULL_NAME.HRIS_ID'],
                'TYPE' => 'LEFT'
            ),
            array(
                'table' => 'DOTS_DOC_STATUS',
                'ON' => ['DOTS_DOCUMENT.DOC_STATUS = DOTS_DOC_STATUS.ID'],
                'TYPE' => 'LEFT'
            ),
            array(
                'table' => 'DOTS_DOC_ACTION',
                'ON' => ['DOTS_DOCUMENT.ACTION_ID = DOTS_DOC_ACTION.ID'],
                'TYPE' => 'LEFT'
            ),
        ],
        'ORDER_BY' => 'DOTS_DOCUMENT.DOC_NUM DESC'
    );
    // var_dump($data);
    $selectTableSql = $queries->selectQuery($data);
    $result = mysqli_query($conn, $selectTableSql);
    $resultAsArray = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $resultAsArray[] = $row;
    }

    // echo $selectTableSql;

    // echo json_encode($selectTableSql);
    setupTable($resultAsArray);
}

function setupTable($result)
{

    $thead = "<th></th>";
    $tbody = "";


    if (isset($result[0])) {
        $theadKeys = array_keys($result[0]);

        foreach ($theadKeys as $key) {
            if (
                $key == 'ID' ||
                $key == 'ROUTE_NUM' ||
                $key == 'DOC_NUM'
            ) {
                $remove = true;
            } else {
                $thead .= "<th>$key</th> ";
            }

        }

        foreach ($result as $rows) {
            $tbody .= "<tr>";
            $tbody .= "<td>" .
                "<button class=btnS type='button' data-i=$rows[ID] data-d=$rows[DOC_NUM] data-r=$rows[ROUTE_NUM]>S</button>" .
                // "<button class=btnE type='button' data-i=$rows[ID] data-d=$rows[DOC_NUM] data-r=$rows[ROUTE_NUM]>E</button>" .
                // "<button class=btnA type='button' data-i=$rows[ID] data-d=$rows[DOC_NUM] data-r=$rows[ROUTE_NUM]>A</button>" .
                "</td>";
            foreach ($rows as $key => $value) {

                if (
                    $key == 'ID' ||
                    $key == 'ROUTE_NUM' ||
                    $key == 'DOC_NUM'
                ) {
                    $remove = true;
                } else {
                    if ($key == "Date Received") {
                        $tbody .= "<td>" . formatDateTime($value) . "</td>";
                    } else if ($key == "Letter Date") {
                        $tbody .= "<td>" . formatDate($value) . "</td>";
                    } else {
                        $tbody .= "<td>$value</td>";
                    }
                }

            }
            $tbody .= "</tr>";
        }
    } else {
        $thead = "";
        $tbody = "";
    }




    echo json_encode(
        array(
            'VALID' => true,
            'THEAD' => $thead,
            'TBODY' => $tbody
        )
    );
}

function formatDateTime($dateString)
{
    $date = new DateTime($dateString);
    $hours = $date->format('H');
    $minutes = $date->format('i');
    $ampm = $hours >= 12 ? 'pm' : 'am';
    $hours = $hours % 12;
    $hours = $hours ? $hours : 12; // the hour '0' should be '12'
    $minutes = $minutes < 10 ? '0' . $minutes : $minutes;
    $strTime = $hours . ':' . $minutes . ' ' . $ampm;
    return ($date->format('n')) . "/" . $date->format('j') . "/" . $date->format('Y') . "  " . $strTime;
}

function formatDate($dateString)
{
    $date = new DateTime($dateString);
    return ($date->format('n')) . "/" . $date->format('j') . "/" . $date->format('Y');
}

?>