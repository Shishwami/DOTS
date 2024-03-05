<?php
include "DB_Connect.php";
include "Queries.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$sql = '';

try {
    $inputs = json_decode(file_get_contents("php://input"), true);
    $inputs = sanitizeInputs($inputs);
    // var_dump($inputs);

    $REQUEST = $inputs['REQUEST'];
    // if (!isset($inputs['REQUEST'])) {
    //     var_dump($inputs);
    // }

    date_default_timezone_set("Asia/Manila");


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

        case "GET_DOCUMENT":
            getDocument($inputs, $conn);
            break;
        case 'EDIT_DOCUMENT':
            editDocument($inputs, $conn);
            break;
        case 'CANCEL_RECEIVE':
            cancelReceive($inputs, $conn);
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
        case 'GET_TABLE_TRACKING':
            getTableTracking($inputs, $conn);
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
    return $time;
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
function getDocument($inputs, $conn)
{

    $queries = new Queries();

    $selectDocData = [
        'TABLE' => 'DOTS_DOCUMENT',
        "WHERE" => [
            'AND' => [
                ['ID' => $inputs['DATA']['ID']]
            ]
        ],
    ];

    $selectDocSql = $queries->selectQuery($selectDocData);
    $selectDocResult = $conn->query($selectDocSql);
    $selectDocRow = $selectDocResult->fetch_assoc();

    $php_timestamp = strtotime($selectDocRow['DATE_TIME_RECEIVED']);
    $html_datetime_string = date('Y-m-d\TH:i', $php_timestamp);

    $selectOutputData = [
        'ID' => $selectDocRow['ID'],
        'ACTION_ID' => $selectDocRow['ACTION_ID'],
        'DATE_TIME_RECEIVED' => $html_datetime_string,
        'LETTER_DATE' => $selectDocRow['LETTER_DATE'],
        'DOC_TYPE_ID' => $selectDocRow['DOC_TYPE_ID'],
        'S_OFFICE_ID' => $selectDocRow['S_OFFICE_ID'],
        'DOC_SUBJECT' => $selectDocRow['DOC_SUBJECT'],
    ];

    echo json_encode(
        $selectOutputData
    );

}

function editDocument($inputs, $conn)
{
    $queries = new Queries();

    $docId = $inputs['DATA']['ID'];
    $docNum = $inputs['DATA']['DOC_NUM'];
    $docRoute = $inputs['DATA']['DOC_ROUTE'];
    unset($inputs['DATA']['ID']);

    $updateDocData = [
        'TABLE' => 'DOTS_DOCUMENT',
        'DATA' => $inputs['DATA'],
        'WHERE' => [
            'ID' => $docId
        ]
    ];

    $updateDocSql = $queries->updateQuery($updateDocData);
    $updateDocResult = $conn->query($updateDocSql);






    echo json_encode(
        array(
            'VALID' => $updateDocResult
        )
    );

}

function cancelReceive($inputs, $conn)
{
    $docId = $inputs['DATA']['ID'];
    $docNum = $inputs['DATA']['DOC_NUM'];
    $routeNum = $inputs['DATA']['ROUTE_NUM'];
    $queries = new Queries();

    $updateReceiveData = [
        'TABLE' => 'DOTS_DOCUMENT_INBOUND',
        'DATA' => [
            'DATE_TIME_RECEIVED' => "NULL",
            'ACTION_ID' => 1//ACTION_ID SENT
        ],
        "WHERE" => [
            'ID' => $docId
        ]

    ];

    $updateReceiveSql = $queries->updateQuery($updateReceiveData);
    $updateReceiveResult = $conn->query($updateReceiveSql);


    //delete the canceled doc in outbound
    $deleteDocData = [
        'TABLE' => 'DOTS_DOCUMENT_OUTBOUND',
        'WHERE' => [
            'DOC_NUM' => $docNum,
            'ROUTE_NUM' => $routeNum,
        ],
    ];

    $deleteDocSql = $queries->deleteQuery($deleteDocData);
    $deleteDocResult = $conn->query($deleteDocSql);

    echo json_encode(
        array(

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
    $newRoutingNumber = 0;

    $insertInboundData = array(
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
    $checkRoutedResult = mysqli_query($conn, $checkRoutedSql);
    $checkRoutedRow = $checkRoutedResult->fetch_assoc();

    $updateDocumentData = array(
        'TABLE' => 'DOTS_DOCUMENT',
        'DATA' => [
            'ROUTED' => 1,//set to routed
            'DOC_STATUS' => 1,//set on hand to pending
        ],
        'WHERE' => array(
            'ID' => $checkRoutedRow['ID']
        ),
    );

    if ($checkRoutedRow['ROUTED'] == 1) {
        //select document with highest routing number to duplicate
        $selectDocumentData = [
            'TABLE' => 'DOTS_DOCUMENT',
            'WHERE' => [
                'AND' => [
                    ['DOC_NUM' => $checkRoutedRow['DOC_NUM']]
                ],
            ],
            'ORDER_BY' => 'ROUTE_NUM DESC'
        ];

        $selectDocumentSql = $queries->selectQuery($selectDocumentData);
        $selectDocumentResult = $conn->query($selectDocumentSql);
        $selectDocumentRow = $selectDocumentResult->fetch_assoc();

        // var_dump($selectDocumentRow);

        //increase the routing number
        $newRoutingNumber = intval($selectDocumentRow['ROUTE_NUM']) + 1;
        $selectDocumentRow['ROUTE_NUM'] = $newRoutingNumber;
        $insertInboundData['DATA']["ROUTE_NUM"] = $newRoutingNumber;

        //remove id for insert
        unset($selectDocumentRow['ID']);

        //duplicate to doc
        $insertDocumentData = [
            'TABLE' => 'DOTS_DOCUMENT',
            'DATA' => $selectDocumentRow,
        ];

        $insertDocumentSql = $queries->insertQuery($insertDocumentData);
        $insertDocumentResult = $conn->query($insertDocumentSql);

        //add log duplicate main doc
        $insertDocumentLogData = [
            'TABLE' => 'DOTS_TRACKING',
            'DATA' => [
                'HRIS_ID' => $_SESSION['HRIS_ID'],
                'DOC_NUM' => $checkRoutedRow['DOC_NUM'],
                'ROUTE_NUM' => $newRoutingNumber,
                'ACTION_ID' => 4,//Duplicate action_id
                'DATE_TIME_ACTION' => date("Y-m-d\TH:i"),
            ]
        ];

        $insertDocumentLogSql = $queries->insertQuery($insertDocumentLogData);
        $insertDocumentLogResult = $conn->query($insertDocumentLogSql);

    } else if ($checkRoutedRow['ROUTED'] == 0) {
        $updateDocumentSql = $queries->updateQuery(($updateDocumentData));
        $updateDocumentResult = $conn->query($updateDocumentSql);

    }
    //insert to inbound
    $insertInboundSql = $queries->insertQuery($insertInboundData);
    $insertInboundResult = $conn->query($insertInboundSql);

    //add log insert inbound 
    $insertInboundLogData = [
        'TABLE' => 'DOTS_TRACKING',
        'DATA' => [
            'HRIS_ID' => $_SESSION['HRIS_ID'],
            'DOC_NUM' => $checkRoutedRow['DOC_NUM'],
            'ROUTE_NUM' => $newRoutingNumber,
            'ACTION_ID' => 1,//sent action_id
            'DATE_TIME_ACTION' => date("Y-m-d\TH:i"),
        ]
    ];

    $insertInboundLogSql = $queries->insertQuery($insertInboundLogData);
    $insertInboundLogResult = $conn->query($insertInboundLogSql);


    echo json_encode(
        array(
            'VALID' => $valid
        )
    );
}
function receiveDoc($inputs, $conn)
{
    $queries = new Queries();
    $valid = false;

    $insertDocumentData = array(
        'TABLE' => 'DOTS_DOCUMENT',
        'DATA' => $inputs['DATA'],
    );
    $insertDocumentSql = $queries->insertQuery($insertDocumentData);
    $insertDocumentResult = $conn->query($insertDocumentSql);

    if ($insertDocumentResult) {
        $valid = true;

        $lastId = $conn->insert_id;

        //get doc_num, route_num and actionid
        $selectDocumentData = [
            'TABLE' => 'DOTS_DOCUMENT',
            'WHERE' => [
                'AND' => [
                    ['ID' => $lastId]
                ]
            ]
        ];

        $selectDocumentSql = $queries->selectQuery($selectDocumentData);
        $selectDocumentResult = $conn->query($selectDocumentSql);
        $selectDocumentRow = $selectDocumentResult->fetch_assoc();

        //add log create/ receive doc
        $insertLogData = [
            'TABLE' => 'DOTS_TRACKING',
            'DATA' => [
                'DOC_NUM' => $selectDocumentRow['DOC_NUM'],
                'ROUTE_NUM' => $selectDocumentRow['ROUTE_NUM'],
                'ACTION_ID' => $selectDocumentRow['ACTION_ID'],
                'HRIS_ID' => $_SESSION['HRIS_ID'],
                'DATE_TIME_ACTION' => date("Y-m-d\TH:i"),
                // 'DATE_TIME_ACTION'=>$selectDocumentRow['DATE_TIME_RECEIVED'],
            ],
        ];

        $insertLogSql = $queries->insertQuery($insertLogData);
        $insertLogResult = $conn->query($insertLogSql);

    }
    echo json_encode(
        array(
            'VALID' => $valid
        )
    );
}
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
            "className" => "btnE",
            "label" => "E"
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
            "className" => "btnS",
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
            ],
            [
                "className" => "btnCR",
                "label" => "C"
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
                "className" => "btnE",
                "label" => "E"
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
                if ($fValue == '0000-00-00 00:00:00') {
                    $fValue = '';
                } else {
                    $fValue = formatDateTime($value);
                }
            } else if ($key == "Date Sent" && $value != null) {
                if ($fValue == '0000-00-00 00:00:00') {
                    $fValue = '';
                } else {
                    $fValue = formatDateTime($value);
                }
            } else if ($key == "Letter Date") {
                $fValue = formatDate($value);
            } else if ($key == "Date of Action") {
                $fValue = formatDateTime($value);
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

    //add log recieve by user
    $insertLogData = [
        'TABLE' => 'DOTS_TRACKING',
        'DATA' => [
            'DOC_NUM' => $inputs['DATA']["DOC_NUM"],
            'ROUTE_NUM' => $inputs['DATA']["ROUTE_NUM"],
            'ACTION_ID' => 2,//ACTION_ID RECEIVE
            'HRIS_ID' => $_SESSION['HRIS_ID'],
            'DATE_TIME_ACTION' => date("Y-m-d\TH:i"),
        ]
    ];

    $insertLogSql = $queries->insertQuery($insertLogData);
    $insertLogResult = $conn->query($insertLogSql);

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

    //TODO insert to logs

    echo json_encode(
        array(
            'VALID' => $valid,
        )
    );
}
function sendDocFormUser($inputs, $conn)
{
    $queries = new Queries();
    $newRouteNumber = 0;
    $insertOutboundData = [];
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

        //add to doc main
        unset($selectMainDataRow['ID']);
        $insertMainData = [
            'TABLE' => 'DOTS_DOCUMENT',
            'DATA' => $selectMainDataRow,
        ];

        $insertMainSql = $queries->insertQuery($insertMainData);
        $insertMainResult = $conn->query($insertMainSql);

        //add log doc main duplicate
        $insertMainLogData = [
            'TABLE' => 'DOTS_TRACKING',
            'DATA' => [
                'DOC_NUM' => $insertMainData['DATA']["DOC_NUM"],
                'ROUTE_NUM' => $insertMainData['DATA']["ROUTE_NUM"],
                'ACTION_ID' => 4,//ACTION_ID DUPLICATE
                'HRIS_ID' => $_SESSION['HRIS_ID'],
                'DATE_TIME_ACTION' => date("Y-m-d\TH:i"),
            ],
        ];

        $insertMainLogSql = $queries->insertQuery($insertMainLogData);
        $insertMainLogResult = $conn->query($insertMainLogSql);

        //add to outbound
        $selectOutboundRow['ROUTE_NUM'] = $newRouteNumber;
        unset($selectOutboundRow['ID']);
        $insertOutboundData = [
            'TABLE' => 'DOTS_DOCUMENT_OUTBOUND',
            'DATA' => $selectOutboundRow
        ];
        $insertOutboundData["DATA"]['DATE_TIME_SEND'] = $inputs['DATA']['DATE_TIME_SEND'];

        $insertOutboundSql = $queries->insertQuery($insertOutboundData);
        $insertOutboundResult = $conn->query($insertOutboundSql);

    } else if ($selectOutboundRow['ROUTED'] == 0) {
        $updateOutboundSql = $queries->updateQuery($updateOutboundData);
        $updateOutboundResult = $conn->query($updateOutboundSql);
    }

    //add log outbound send
    $insertMainLogData = [
        'TABLE' => 'DOTS_TRACKING',
        'DATA' => [
            'DOC_NUM' => $selectOutboundRow['DATA']["DOC_NUM"],
            'ROUTE_NUM' => $selectOutboundRow['DATA']["ROUTE_NUM"],
            'ACTION_ID' => 1,//ACTION_ID SEND
            'HRIS_ID' => $_SESSION['HRIS_ID'],
            'DATE_TIME_ACTION' => date("Y-m-d\TH:i"),
        ],
    ];

    $insertMainLogSql = $queries->insertQuery($insertMainLogData);
    $insertMainLogResult = $conn->query($insertMainLogSql);

    //insert to inbound
    $insertInboundSql = $queries->insertQuery($insertInboundData);
    $insertInboundResult = $conn->query($insertInboundSql);

    echo json_encode(
        array(
            'VALID' => true,
        )
    );
}
function getTableTracking($inputs, $conn)
{
    $queries = new Queries();

    $selectTableData = [
        'TABLE' => 'DOTS_TRACKING',
        'COLUMNS' => [
            "CASE WHEN ROUTE_NUM = 0 THEN DOC_NUM 
            ELSE CONCAT(DOC_NUM,\"-\",ROUTE_NUM) 
            END AS `No.`",

            "CONCAT(
                IF(DOTS_ACCOUNT_INFO.OFFICE_ID IS NOT NULL,CONCAT(DOTS_ACCOUNT_INFO.OFFICE_ID,'-'), ' '),' ', 
                IF(DOTS_ACCOUNT_INFO.DEPT_ID IS NOT NULL,CONCAT(DOTS_DOC_DEPT.DOC_DEPT,'-'), ' '), 
                IFNULL(DOTS_ACCOUNT_INFO.FULL_NAME, ' ')) as 'Location'",


            'DATE_TIME_ACTION as `Date of Action`',
            'DOTS_DOC_ACTION.DOC_ACTION as `Action`',

        ],
        'JOIN' => [
            [
                'table' => 'DOTS_ACCOUNT_INFO',
                'ON' => ['DOTS_TRACKING.HRIS_ID = DOTS_ACCOUNT_INFO.HRIS_ID'],
                'TYPE' => 'LEFT'
            ],
            [
                'table' => 'DOTS_DOC_DEPT',
                'ON' => ['DOTS_ACCOUNT_INFO.DEPT_ID = DOTS_DOC_DEPT.ID'],
                'TYPE' => 'LEFT'
            ],
            [
                'table' => 'DOTS_DOC_ACTION',
                'ON' => ['DOTS_TRACKING.ACTION_ID = DOTS_DOC_ACTION.ID'],
                'TYPE' => 'LEFT'
            ]
        ],
        'SORT_BY' => 'DOC_NUM DESC'
    ];

    $selectTableSql = $queries->selectQuery($selectTableData);
    $selectTableResult = $conn->query($selectTableSql);
    setupTable($selectTableResult, null, 'DOTS_TRACKING');
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