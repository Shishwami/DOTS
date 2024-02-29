<?php
include "DB_Connect.php";
include "Queries.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$sql = '';

try {
    $inputs = json_decode(file_get_contents("php://input"), true);
    // $inputs = sanitizeInputs($inputs);
    // var_dump($inputs);

    $REQUEST = $inputs['REQUEST'];
    // if (!isset($inputs['REQUEST'])) {
    //     var_dump($inputs);
    // }

    switch ($REQUEST) {
        case 'USER_LOGIN':
            userLogin($inputs, $conn);
            break;
        case 'GET_DATE':
            get_Date($inputs);
            break;

        //REMAKE

        case 'GET_SESSION_NAME':
            getSessionValue("FULL_NAME");
            break;
        case 'GET_SESSION_INITIAL':
            getSessionValue("INIITAL");
            break;
        case 'GET_SESSION_HRIS_ID':
            getSessionValue("HRIS_ID");
            break;
        case 'GET_SESSION_DEPT_ID':
            getSessionValue("DEPT_ID");
            break;

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
        case 'GET_TABLE_INBOUND':
            getTableUser($inputs, $conn, 'DOTS_DOCUMENT_INBOUND');
            break;
        case 'GET_TABLE_OUTBOUND':
            getTableUser($inputs, $conn, 'DOTS_DOCUMENT_OUTBOUND');
            break;
        case 'GET_TABLE_ATTACHMENT':
            getTableAttachment($inputs, $conn);
            break;
        case 'RECEIVE_DOC_USER':
            receiveDocUser($inputs, $conn);
            break;
        case 'SEND_DOC_USER':
            sendDocFormUser($inputs, $conn);
            break;


    }
    $conn->close();


} catch (mysqli_sql_exception $th) {
    // throw $th;
    echo '' . $th->getMessage() . '\r\n asd' . $sql;
} catch (Exception $th) {
    // throw $th;
    echo '' . $th->getMessage() . '\r\n asd' . $sql;
}
function userLogin($inputs, $conn)
{
    $queries = new Queries();
    $valid = false;

    $response = [];

    $whereData = $inputs['WHERE'];
    $username = $whereData['USERNAME'];
    $password = $whereData['PASSWORD'];

    $data = array(
        'TABLE' => 'DOTS_ACCOUNT_INFO',
        'COLUMNS' => array(
            'HRIS_ID',
            'FULL_NAME',
            'INITIAL',
            'DEPT_ID',
            'DOTS_PRIV'
        ),
        'WHERE' => array(
            'AND' => array(
                array(
                    'USERNAME' => "$username",
                    'PASSWORD' => "$password"
                )
            ),
        ),
    );

    $selectSql = $queries->selectQuery($data);
    $result = mysqli_query($conn, $selectSql);

    if (mysqli_num_rows($result) == 1) {
        $valid = true;
        $row = mysqli_fetch_assoc($result);

        foreach ($row as $key => $value) {
            $_SESSION[$key] = $value;
        }

        // if($_SESSION['DOTS_PRIV'] == 0){
        //     //
        // }

        // if($_SESSION['DOTS_PRIV'] == 1){
        //     //
        // }

        // if($_SESSION['DOTS_PRIV'] == 2){
        //     //
        // }

    } else {
        $response['MESSAGE'] = 'Invalid Username or Password';
    }

    $response["VALID"] = $valid;
    echo json_encode($response);
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
    }

    echo json_encode(
        array(
            'VALID' => $valid,
            'TIME' => $time,
        )
    );
}

function getSessionValue($key)
{
    $valid = false;
    $sessionValue = '';

    if (isset($_SESSION[$key])) {
        $valid = true;
        $sessionValue = $_SESSION[$key];

    }

    echo json_encode(
        array(
            'VALID' => $valid,
            'RESULT' => $sessionValue,
        )
    );
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
    $result = mysqli_query($conn, $sql);

    $doc_num = 0;
    if ($result) {
        $valid = true;
        $row = $result->fetch_assoc();
        if (isset($row['CURRENT_VALUE'])) {
            $doc_num = $row['CURRENT_VALUE'];
        }
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
    $result = mysqli_query($conn, $sql);
    $formattedOptions = [];
    if ($result) {
        $valid = true;
        foreach ($result as $key => $value) {
            foreach ($value as $key2 => $value2) {
                // $formattedOptions[$key] = $value;
                $value3 = array_values($value);
                $formattedOptions[$value3[0]] = $value3[1];
            }
        }
    }

    echo json_encode(
        array(
            'VALID' => $valid,
            'RESULT' => $formattedOptions
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
            'AND' => array(
                array('DEPT_ID' => $inputs['DEPT_ID'])
            ),
        ]
    );

    $sql = $queries->selectQuery($data);
    // echo $sql;
    $result = mysqli_query($conn, $sql);

    $formattedOptions = [];
    if ($result) {
        $valid = true;
        foreach ($result as $key => $value) {
            foreach ($value as $key2 => $value2) {
                // $formattedOptions[$key] = $value;
                $value3 = array_values($value);
                $formattedOptions[$value3[0]] = $value3[1];
            }
        }
    }

    echo json_encode(
        array(
            'VALID' => $valid,
            'RESULT' => $formattedOptions
        )
    );
}

function sendDocForm($inputs, $conn)
{
    $queries = new Queries();
    $valid = false;
    //check if routed

    //send to inbound
    //update document

    var_dump($inputs);

    $insertData = array(
        'TABLE' => 'DOTS_DOCUMENT_INBOUND',
        'DATA' => $inputs['DATA'],
    );

    $checkRoutedData = array(
        'TABLE' => 'DOTS_DOCUMENT',
        'COLUMNS' => [
            'ID',
            'DOC_NUM',
            'ROUTE_NUM',
            'ROUTED',
        ],
        'WHERE' => array(
            'AND' => array(
                array('DOC_NUM' => $inputs['DATA']['DOC_NUM']),
                array('ROUTE_NUM' => $inputs['DATA']['ROUTE_NUM']),
            )
        ),
    );

    $checkRoutedSql = $queries->selectQuery($checkRoutedData);
    $result = mysqli_query($conn, $checkRoutedSql);
    $row = $result->fetch_assoc();
    if ($row['ROUTED'] == 0) {

    } else if ($row['ROUTED'] == 1) {

    }

    echo json_encode(
        array(
            'VALID' => $valid
        )
    );
}

// function sendDoc($insertData, $conn)
// {
//     $queries = new Queries();
//     $updateData = array(
//         'TABLE' => 'DOTS_DOCUMENT',
//         'DATA' => array(
//             'DOC_STATUS' => 1,//pending to onhand
//             'ROUTED' => 1//routed
//         ),
//         'WHERE' => array(
//             'DOC_NUM' => $insertData['DATA']['DOC_NUM'],
//             'ROUTE_NUM' => $insertData['DATA']['ROUTE_NUM'],
//         )
//     );
//     $insertDataSql = $queries->insertQuery($insertData);
//     $updateDataSql = $queries->updateQuery($updateData);

//     $conn->begin_transaction();

//     $resultInsert = $conn->query($insertDataSql);
//     $resultUpdate = $conn->query($updateDataSql);

//     if ($resultInsert && $resultUpdate) {
//         $conn->commit();
//         return true;
//     } else {
//         $conn->rollback();
//         return false;
//     }
// }
// function resendDoc($insertData, $conn)
// {
//     $queries = new Queries();
//     $doc_num = $insertData['DATA']['DOC_NUM'];
//     //get last route num then add one

//     $getRouteNum = array(
//         'TABLE' => 'DOTS_DOCUMENT',
//         'WHERE' => array(
//             'AND' => array(
//                 array('DOC_NUM' => $doc_num),
//             )
//         ),
//         'ORDER_BY' => 'ROUTE_NUM DESC'
//     );

//     $getRouteNumSql = $queries->selectQuery($getRouteNum);
//     $result = mysqli_query($conn, $getRouteNumSql);
//     if ($result) {
//         $row = mysqli_fetch_assoc($result);

//         $associativeRow = [];
//         foreach ($row as $key => $value) {
//             $associativeRow[$key] = $value;
//         }
//         unset($associativeRow['ID']);

//         $routeNum = $associativeRow['ROUTE_NUM'];
//         $routeNum = intval($routeNum) + 1;
//         $associativeRow['ROUTE_NUM'] = $routeNum;
//         // insert it to new doc
//         $createData = array(
//             'TABLE' => 'DOTS_DOCUMENT',
//             'DATA' => $associativeRow,
//         );
//         $valid = createDoc($createData, $conn);

//         //send the new doc
//         $insertData['DATA']['ROUTE_NUM'] = $routeNum;
//         $insertData2 = array(
//             'TABLE' => 'DOTS_DOCUMENT_INBOUND',
//             'DATA' => $insertData['DATA']
//         );
//         $valid = sendDoc($insertData2, $conn);
//     }

//     return $valid;
// }
function receiveDoc($inputs, $conn)
{
    $queries = new Queries();

    $valid = false;
    $data = $inputs['DATA'];
    $createData = array(
        'TABLE' => 'DOTS_DOCUMENT',
        'DATA' => $data,
    );
    $sql = $queries->insertQuery($createData);
    if (mysqli_query($conn, $sql)) {
        $valid = true;
    }
    echo json_encode(
        array(
            'VALID' => $valid
        )
    );
}
// function createDoc($createData, $conn)
// {
//     $queries = new Queries();
//     $sql = $queries->insertQuery($createData);
//     // echo $sql;

//     // var_dump($createData);
//     if (mysqli_query($conn, $sql)) {
//         return true;
//     }


// }
function getTableMain($inputs, $conn)
{
    $queries = new Queries();
    $tableName = 'DOTS_DOCUMENT';
    $data = array(
        'TABLE' => 'DOTS_DOCUMENT',
        'COLUMNS' => [
            'DOTS_DOCUMENT.ID',

            "CASE WHEN ROUTE_NUM = 0 THEN DOTS_DOCUMENT.DOC_NUM 
             ELSE CONCAT(DOTS_DOCUMENT.DOC_NUM,\"-\",ROUTE_NUM) 
             END AS `No.`",

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
    $selectTableSql = $queries->selectQuery($data);
    $result = mysqli_query($conn, $selectTableSql);

    $buttons = array(
        [
            "className" => "btnS",
            "label" => "S"
        ],
        [
            "className" => "btnA",
            "label" => "A"
        ]
    );
    setupTable($result, $buttons, $tableName);
}

function getTableUser($inputs, $conn, $tableName)
{
    $queries = new Queries();


    $buttons = array(
        [
            "className" => "btnR",
            "label" => "S"
        ]
    );

    $WHERE = [];
    if ($tableName == "DOTS_DOCUMENT_INBOUND") {
        $WHERE[] = [
            "AND" => array(
                array("$tableName.R_DEPT_ID" => $_SESSION["DEPT_ID"]),
            ),
            "OR" => array(
                array("$tableName.R_USER_ID" => $_SESSION["HRIS_ID"]),
                array("$tableName.R_USER_ID" => '0'),
            ),
        ];
        $buttons = array(
            [
                "className" => "btnR",
                "label" => "R"
            ]
        );
    }
    if ($tableName == "DOTS_DOCUMENT_OUTBOUND") {
        $WHERE[] = [
            "AND" => array(
                array("$tableName.S_DEPT_ID" => $_SESSION["DEPT_ID"]),
            ),
            "OR" => array(
                array("$tableName.S_USER_ID" => $_SESSION["HRIS_ID"]),
                array("$tableName.S_USER_ID" => '0'),
            ),
        ];
        $buttons = array(
            [
                "className" => "btnS",
                "label" => "S"
            ],
            [
                "className" => "btnA",
                "label" => "A"
            ]
        );
    }

    $data = array(
        'TABLE' => "$tableName",
        'COLUMNS' => array(
            "$tableName.ID",

            "CASE WHEN ROUTE_NUM = 0 THEN $tableName.DOC_NUM 
             ELSE CONCAT($tableName.DOC_NUM,\"-\",ROUTE_NUM) 
             END AS `No.`",

            "DOC_NUM",
            "ROUTE_NUM",
            "DOC_NOTES as `Notes`",
            "DOTS_DOC_PRPS.DOC_PRPS `Purpose`",

            "CONCAT(" .
            "IF(S_OFFICE.DOC_OFFICE IS NOT NULL,CONCAT(S_OFFICE.DOC_OFFICE,'-'), ' '),' ', " .
            "IF(S_DEPT.DOC_DEPT IS NOT NULL,CONCAT(S_DEPT.DOC_DEPT,'-'), ' '), " .
            "IFNULL(S_FULL_NAME.FULL_NAME, ' ')) as 'Sender'",

            "CONCAT(" .
            "IF(R_OFFICE.DOC_OFFICE IS NOT NULL,CONCAT(R_OFFICE.DOC_OFFICE,'-'), ' '),' ', " .
            "IF(R_DEPT.DOC_DEPT IS NOT NULL,CONCAT(R_DEPT.DOC_DEPT,'-'), ' '), " .
            "IFNULL(R_FULL_NAME.FULL_NAME, ' ')) as 'Receiver'",

            "DATE_TIME_RECEIVED as `Date Received`",
            "DATE_TIME_SEND as `Date Sent`",
            "DOTS_DOC_ACTION.DOC_ACTION as `Action`",
        ),
        "JOIN" => array(
            array(
                "table" => "DOTS_DOC_PRPS",
                "ON" => ["$tableName.PRPS_ID = DOTS_DOC_PRPS.ID"],
                "TYPE" => "LEFT",
            ),
            array(
                "table" => "DOTS_DOC_OFFICE S_OFFICE",
                "ON" => ["$tableName.S_OFFICE_ID = S_OFFICE.ID"],
                "TYPE" => "LEFT",
            ),
            array(
                "table" => "DOTS_DOC_DEPT S_DEPT",
                "ON" => ["$tableName.S_DEPT_ID = S_DEPT.ID"],
                "TYPE" => "LEFT",
            ),
            array(
                "table" => "DOTS_ACCOUNT_INFO S_FULL_NAME",
                "ON" => ["$tableName.S_USER_ID = S_FULL_NAME.HRIS_ID"],
                "TYPE" => "LEFT",
            ),
            array(
                "table" => "DOTS_DOC_OFFICE R_OFFICE",
                "ON" => ["$tableName.R_OFFICE_ID = R_OFFICE.ID"],
                "TYPE" => "LEFT",
            ),
            array(
                "table" => "DOTS_DOC_DEPT R_DEPT",
                "ON" => ["$tableName.R_DEPT_ID = R_DEPT.ID"],
                "TYPE" => "LEFT",
            ),
            array(
                "table" => "DOTS_ACCOUNT_INFO R_FULL_NAME",
                "ON" => ["$tableName.R_USER_ID = R_FULL_NAME.HRIS_ID"],
                "TYPE" => "LEFT",
            ),
            array(
                "table" => "DOTS_DOC_ACTION",
                "ON" => ["$tableName.ACTION_ID = DOTS_DOC_ACTION.ID"],
                "TYPE" => "LEFT",
            ),
        ),
        'ORDER_BY' => "$tableName.DOC_NUM DESC",
    );
    $data['WHERE'] = $WHERE[0];

    // var_dump ($data);

    $selectTableSql = $queries->selectQuery($data);
    $result = mysqli_query($conn, $selectTableSql);
    $resultAsArray = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $resultAsArray[] = $row;
    }


    setupTable($resultAsArray, $buttons, $tableName);
}
function setupTable($result, $buttons, $tableName)
{
    $valid = false;
    $formattedResult = [];
    foreach ($result as $row) {
        $formattedRow = [];
        foreach ($row as $key => $value) {

            $fValue = $value;

            if ($key == "Date Received" && $value != null) {
                $fValue = formatDateTime($value);
            } else if ($key == "Date Sent" && $value != null) {
                $fValue = formatDateTime($value);
            } else if ($key == "Letter Date") {
                $fValue = formatDate($value);
            }
            $valid = true;


            $formattedRow[$key] = $fValue;
        }
        $formattedResult[] = $formattedRow;
    }

    echo json_encode(
        array(
            'VALID' => $valid,
            'RESULT' => $formattedResult,
            'BUTTONS' => $buttons
        )
    );
}
function receiveDocUser($inputs, $conn)
{
    $queries = new Queries();
    $valid = false;

    $updateData = array(
        'TABLE' => 'DOTS_DOCUMENT_INBOUND',
        'DATA' => array(
            'DATE_TIME_RECEIVED' => $inputs['DATA']['DATE_TIME_RECEIVED'],
            'ACTION_ID' => $inputs['DATA']['ACTION_ID'],
            'R_USER_ID' => $inputs['DATA']['R_USER_ID'],
            'R_DEPT_ID' => $inputs['DATA']['R_DEPT_ID'],
        ),
        'WHERE' => array(
            'ID' => $inputs['DATA']['ID'],
        ),
    );

    $insertData = array(
        'TABLE' => 'DOTS_DOCUMENT_OUTBOUND',
        'DATA' => array(
            'DATE_TIME_RECEIVED' => $inputs['DATA']['DATE_TIME_RECEIVED'],
            'S_USER_ID' => $inputs['DATA']['R_USER_ID'],
            'S_DEPT_ID' => $inputs['DATA']['R_DEPT_ID'],
            'ACTION_ID' => $inputs['DATA']['ACTION_ID'],
            'DOC_NUM' => $inputs['DATA']['DOC_NUM'],
            'ROUTE_NUM' => $inputs['DATA']['ROUTE_NUM'],
            'ROUTED' => '0'
        ),
    );

    //TODO validate if received

    $updateDataSql = $queries->updateQuery($updateData);
    $insertDataSql = $queries->insertQuery($insertData);

    $resultUpdate = $conn->query($updateDataSql);
    $insertUpdate = $conn->query($insertDataSql);

    $conn->begin_transaction();

    if ($resultUpdate && $insertUpdate) {
        $valid = true;
        $conn->commit();
    } else {
        $conn->rollback();
    }

    //TODO update to logs

    echo json_encode(
        array(
            'VALID' => $valid,
        )
    );
}
function sendDocFormUser($inputs, $conn)
{
    $queries = new Queries();

    //update outbound 
    $updateOutboundData = [
        'TABLE' => 'DOTS_DOCUMENT_OUTBOUND',
        'DATA' => [
            'ROUTED' => '1',
            'PRPS_ID' => $inputs['DATA']['PRPS_ID'],
            'DOC_NOTES' => $inputs['DATA']['DOC_NOTES'],
            'R_USER_ID' => $inputs['DATA']['R_USER_ID'],
            'R_DEPT_ID' => $inputs['DATA']['R_DEPT_ID'],
            'S_USER_ID' => $inputs['DATA']['S_USER_ID'],
            'S_DEPT_ID' => $inputs['DATA']['S_DEPT_ID'],
            'ACTION_ID' => $inputs['DATA']['ACTION_ID'],
            'DATE_TIME_SEND' => $inputs['DATA']['DATE_TIME_SEND'],
        ],
        'WHERE' => [
            'ID' => $inputs["DATA"]["ID"],
        ]
    ];
    //insert to inbound /send
    $insertInboundData = [
        'TABLE' => 'DOTS_DOCUMENT_INBOUND',
        'DATA' => [
            'DOC_NUM' => $inputs['DATA']['DOC_NUM'],
            'PRPS_ID' => $inputs['DATA']['PRPS_ID'],
            'DOC_NOTES' => $inputs['DATA']['DOC_NOTES'],
            'R_USER_ID' => $inputs['DATA']['R_USER_ID'],
            'R_DEPT_ID' => $inputs['DATA']['R_DEPT_ID'],
            'S_USER_ID' => $inputs['DATA']['S_USER_ID'],
            'S_DEPT_ID' => $inputs['DATA']['S_DEPT_ID'],
            'DATE_TIME_SEND' => $inputs['DATA']['DATE_TIME_SEND'],
            'ACTION_ID' => "1",
        ],
    ];

    //check if routed
    $selectOutboundData = [
        'TABLE' => 'DOTS_DOCUMENT_OUTBOUND',
        'WHERE' => array(
            'AND' => array(
                array('ID' => $inputs['DATA']['ID']),
            ),
        ),
    ];
    $selectOutboundSql = $queries->selectQuery($selectOutboundData);
    $selectOutboundResult = $conn->query($selectOutboundSql);
    $selectOutboundRow = $selectOutboundResult->fetch_assoc();

    if ($selectOutboundRow['ROUTED'] == 1) {
        echo 'resend';
        //if routed duplicate in docmain & outbound
        $selectMainData = [
            'TABLE' => 'DOTS_DOCUMENT',
            'WHERE' => array(
                'AND' => array(
                    array('DOC_NUM' => $selectOutboundRow["DOC_NUM"]),
                ),
            ),
            'ORDER_BY' => 'ROUTE_NUM DESC'
        ];

        $selectMainDataSql = $queries->selectQuery($selectMainData);
        $selectMainDataResult = $conn->query($selectMainDataSql);
        $selectMainDataRow = $selectMainDataResult->fetch_assoc();

        //reassign route number
        $newRouteNumber = intval($selectMainDataRow['ROUTE_NUM']) + 1;
        $insertInboundData['DATA']['ROUTE_NUM'] = $newRouteNumber;
        $selectMainDataRow['ROUTE_NUM'] = $newRouteNumber;

        //addto doc main
        unset($selectMainDataRow['ID']);
        $insertMainData = [
            'TABLE' => 'DOTS_DOCUMENT',
            'DATA' => $selectMainDataRow,
        ];

        $insertMainSql = $queries->insertQuery($insertMainData);
        $insertMainResult = $conn->query($insertMainSql);

        //add to outbound
        $selectOutboundRow['ROUTE_NUM'] = $newRouteNumber;
        $insertOutboundData = [
            'TABLE' => 'DOTS_DOCUMENT_OUTBOUND',
            'DATA' => $selectOutboundRow
        ];
        unset($insertOutboundData['DATA']['ID']);
        createDoc($insertOutboundData, $conn);
        // var_dump($insertInboundData);
    } else {
        $updateOutboundSql = $queries->updateQuery($updateOutboundData);
        $updateOutboundResult = $conn->query($updateOutboundSql);
    }
    $insertInboundSql = $queries->insertQuery($insertInboundData);
    $insertInboundResult = $conn->query($insertInboundSql);
}
function getTableAttachment($inputs, $conn)
{
    $queries = new Queries();

    $tableName = 'DOTS_ATTACHMENTS';

    $data = [
        'TABLE' => $tableName,
        'COLUMNS' => [
            "CASE WHEN ROUTE_NUM = 0 THEN DOC_NUM 
            ELSE CONCAT(DOC_NUM,\"-\",ROUTE_NUM) 
            END AS `No.`",
            'FILE_PATH',
            'FILE_NAME',
        ],
        'WHERE' => $inputs['WHERE']
    ];
    $selectTableSql = $queries->selectQuery($data);
    $result = mysqli_query($conn, $selectTableSql);

    setupTable($result, null, $tableName);
}
function formatDateTime($dateString)
{
    $date = new DateTime($dateString);
    $hours = $date->format('H');
    $hours = $hours % 12;
    $minutes = $date->format('i');
    $ampm = $hours >= 12 ? 'pm' : 'am';
    $strTime = $hours . ':' . $minutes . ' ' . $ampm;
    return $date->format('n/j/Y') . "  " . $strTime;
}

function formatDate($dateString)
{
    $date = new DateTime($dateString);
    return($date->format('n')) . "/" . $date->format('j') . "/" . $date->format('Y');
}


?>