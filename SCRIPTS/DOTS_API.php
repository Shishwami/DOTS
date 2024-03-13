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
        case 'CANCEL_SEND':
            cancelSend($inputs, $conn);
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
    $valid = false;
    $message = "";

    $username = $inputs['WHERE']['USERNAME'];
    $password = $inputs['WHERE']['PASSWORD'];

    $selectUserData = array(
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

    $selectUserRow = selectSingleRow($selectUserData);
    if (empty($selectUserRow)) {
        $message = "Invalid Username or Password.";
    } else {
        $valid = true;
        $message = "Redirecting";
        foreach ($selectUserRow as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }

    echo json_encode([
        'VALID' => $valid,
        'MESSAGE' => $message,
    ]);

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
    $message = "";
    $valid = false;
    $results = [];
    $requiredInputs = [
        "ACTION_ID",
        "DATE_TIME_RECEIVED",
        "DOC_SUBJECT",
        "DOC_TYPE_ID",
        "ID",
        "LETTER_DATE",
        "S_OFFICE_ID",
    ];

    if (!validateInputs($requiredInputs, $inputs)) {
        echo json_encode(
            array(
                'VALID' => $valid,
                'MESSAGE' => "Please Fill up required Fields",
            )
        );
        exit;
    }
    if ($_SESSION['DOTS_PRIV'] < 3) {
        echo json_encode(
            array(
                'VALID' => $valid,
                'MESSAGE' => "Not enough privilege to perform this action",
            )
        );
        exit;
    }

    $conn->begin_transaction();

    $updateDocData = [
        'TABLE' => 'DOTS_DOCUMENT',
        'DATA' => $inputs['DATA'],
        'WHERE' => [
            'ID' => $inputs['DATA']['ID']
        ]
    ];

    $selectDocData = [
        'TABLE' => 'DOTS_DOCUMENT',
        'WHERE' => [
            'AND' => [
                ["ID" => $inputs['DATA']['ID']]
            ]
        ]
    ];
    $selectDocResult = selectSingleRow($selectDocData);

    if ($selectDocResult['ROUTE_NUM'] == 0) {
        $message = "Document $selectDocResult[DOC_NUM] Updated";
    } else {
        $message = "Document $selectDocResult[DOC_NUM]-$selectDocResult[ROUTE_NUM] Updated";
    }

    $insertDocLogData = [
        'TABLE' => 'DOTS_TRACKING',
        'DATA' => [
            'DOC_NUM' => $selectDocResult["DOC_NUM"],
            'ROUTE_NUM' => $selectDocResult["ROUTE_NUM"],
            'HRIS_ID' => $_SESSION['HRIS_ID'],
            'ACTION_ID' => 6,//ACTION_ID EDIT
            'DATE_TIME_ACTION' => $selectDocResult['DATE_TIME_RECEIVED'],
            'DATE_TIME_SERVER' => date("Y-m-d\TH:i"),
            // 'NOTE_USER' => $inputs['DATA']['CANCEL_R_NOTES'],
            'NOTE_SERVER' => "Receiving canceled by user",
        ]
    ];
    $insertDocLogResult = insert($insertDocLogData);

    unset($inputs['DATA']['ID']);
    $updateDocSql = $queries->updateQuery($updateDocData);
    $updateDocResult = $conn->query($updateDocSql);

    $results[] = !is_null($insertDocLogResult);
    $results[] = !is_null($updateDocResult);

    $valid = checkArray($results);
    if ($valid) {
        $conn->commit();
        echo json_encode(
            array(
                'VALID' => $updateDocResult,
                'MESSAGE' => $message
            )
        );
    } else {
        $conn->rollback();
        echo json_encode(
            array(
                'VALID' => $updateDocResult,
                'MESSAGE' => "SERVER ERROR"
            )
        );
    }
}

function cancelReceive($inputs, $conn)
{
    $queries = new Queries();
    $valid = false;
    $results = [];
    $requiredFields = [
        'CANCEL_R_NOTES'
    ];

    if (!validateInputs($requiredFields, $inputs)) {
        echo json_encode(
            [
                'VALID' => $valid,
                'MESSAGE' => "Please Fill up notes"
            ]
        );
        exit;
    }

    $conn->begin_transaction();

    //get outboundid for deletion
    $selectReceiveData = [
        'TABLE' => 'DOTS_DOCUMENT_INBOUND',
        'WHERE' => [
            'AND' => array(
                array('ID' => $inputs['DATA']['CANCEL_R_ID'])
            ),
        ]
    ];
    $selectReceiveRow = selectSingleRow($selectReceiveData);

    $selectInboundData = [
        'TABLE' => 'DOTS_DOCUMENT_OUTBOUND',
        'WHERE' => [
            "AND" => [
                ['ID' => $selectReceiveRow['OUTBOUND_ID']]
            ]
        ],
    ];
    $selectInboundRow = selectSingleRow($selectInboundData);

    if ($selectInboundRow['ROUTED'] == 1) {
        echo json_encode(
            [
                'VALID' => $valid,
                'MESSAGE' => "Document already sent; cancellation not possible"
            ]
        );
        exit;
    }

    //update to canceled the doc in outbound
    // $message = "Receiving of document cancellation successful.";
    $deleteDocData = [
        'TABLE' => 'DOTS_DOCUMENT_OUTBOUND',
        'DATA' => [
            'ACTION_ID' => 5//canclled
        ],
        'WHERE' => [
            'ID' => $selectReceiveRow['OUTBOUND_ID']
        ],
    ];

    $deleteDocSql = $queries->updateQuery($deleteDocData);
    $deleteDocResult = $conn->query($deleteDocSql);
    $results[] = !is_null($deleteDocResult);

    $updateReceiveData = [
        'TABLE' => 'DOTS_DOCUMENT_INBOUND',
        'DATA' => [
            'DATE_TIME_RECEIVED' => "NULL",
            'ACTION_ID' => 1//ACTION_ID SENT
        ],
        "WHERE" => [
            'ID' => $inputs['DATA']['CANCEL_R_ID']
        ]
    ];

    if (isset($inputs['DATA']['CANCEL_R_DEPT'])) {
        $updateReceiveData['DATA']['R_USER_ID'] = 0;
    }

    $updateReceiveSql = $queries->updateQuery($updateReceiveData);
    $updateReceiveResult = $conn->query($updateReceiveSql);
    $results[] = !is_null($updateReceiveResult);

    //add to logs
    $insertRCancelToLogsData = [
        'TABLE' => 'DOTS_TRACKING',
        'DATA' => [
            'DOC_NUM' => $selectReceiveRow["DOC_NUM"],
            'ROUTE_NUM' => $selectReceiveRow["ROUTE_NUM"],
            'ACTION_ID' => 5,//ACTION_ID RECEIVE
            'HRIS_ID' => $_SESSION['HRIS_ID'],
            // 'DATE_TIME_ACTION' => $inputs['DATA']['DATE_TIME_RECEIVED'],
            'DATE_TIME_SERVER' => date("Y-m-d\TH:i"),
            'NOTE_USER' => $inputs['DATA']['CANCEL_R_NOTES'],
            'NOTE_SERVER' => "Receiving canceled by user",
        ]
    ];
    $insertRCancelToLogsResult = insert($insertRCancelToLogsData);
    $results[] = !is_null($insertRCancelToLogsResult);

    $valid = checkArray($results);
    if ($valid) {
        $conn->commit();
    } else {
        $conn->rollback();
        echo json_encode(
            array(
                "VALID" => $valid,
                "MESSAGE" => "SERVER ERROR"
            )
        );
        exit;
    }

    echo json_encode(
        array(
            "VALID" => $valid,
            "MESSAGE" => "Receiving of document cancellation successful."
        )
    );
}


function cancelSend($inputs, $conn)
{
    $queries = new Queries();
    $valid = false;
    $results = [];
    $requiredFields = [
        'CANCEL_R_NOTES'
    ];

    if (!validateInputs($requiredFields, $inputs)) {
        echo json_encode(
            [
                'VALID' => $valid,
                'MESSAGE' => "Please Fill up notes"
            ]
        );
        exit;
    }

    $conn->begin_transaction();

    //get outboundid for deletion
    $selectReceiveData = [
        'TABLE' => 'DOTS_DOCUMENT_OUTBOUND',
        'WHERE' => [
            'AND' => array(
                array('ID' => $inputs['DATA']['CANCEL_S_ID'])
            ),
        ]
    ];
    $selectReceiveRow = selectSingleRow($selectReceiveData);

    $selectOutboundData = [
        'TABLE' => 'DOTS_DOCUMENT_INBOUND',
        'WHERE' => [
            "AND" => [
                ['ID' => $selectReceiveRow['INBOUND_ID']],
            ]
        ],
    ];
    $selectOutboundRow = selectSingleRow($selectOutboundData);

    if ($selectOutboundRow['ACTION_ID'] == 2) {
        //routed and sent; and cannot be canceled 
        echo json_encode(
            [
                'VALID' => $valid,
                'MESSAGE' => "Sending cannot be canceled, Document Already Received by the other User"
            ]
        );
        exit;
    }

    //update the doc in inbound to be canceled
    //update to cancelled the doc in outbound

    $deleteDocData = [
        'TABLE' => 'DOTS_DOCUMENT_INBOUND',
        'DATA' => [
            'ACTION_ID' => 5//canclled
        ],
        'WHERE' => [
            'ID' => $selectReceiveRow['INBOUND_ID']
        ],
    ];
    $deleteDocSql = $queries->updateQuery($deleteDocData);
    $deleteDocResult = $conn->query($deleteDocSql);
    $results[] = !is_null($deleteDocResult);

    //update the doc in outbound to have no send data
    $updateReceiveData = [
        'TABLE' => 'DOTS_DOCUMENT_OUTBOUND',
        'DATA' => [
            'DATE_TIME_SEND' => "NULL",
            'R_DEPT_ID' => 0,
            'R_USER_ID' => 0,
            'PRPS_ID' => 0,
            'ROUTED' => 0,
            'ACTION_ID' => 2//ACTION_ID RECEIVED
        ],
        "WHERE" => [
            'ID' => $inputs['DATA']['CANCEL_S_ID']
        ]
    ];
    $updateReceiveSql = $queries->updateQuery($updateReceiveData);
    $updateReceiveResult = $conn->query($updateReceiveSql);
    $results[] = !is_null($updateReceiveResult);

    // add to logs

    $insertSCancelToLogsData = [
        'TABLE' => 'DOTS_TRACKING',
        'DATA' => [
            'DOC_NUM' => $selectReceiveRow["DOC_NUM"],
            'ROUTE_NUM' => $selectReceiveRow["ROUTE_NUM"],
            'ACTION_ID' => 5,//ACTION_ID RECEIVE
            'HRIS_ID' => $_SESSION['HRIS_ID'],
            // 'DATE_TIME_ACTION' => $inputs['DATA']['DATE_TIME_RECEIVED'],
            'DATE_TIME_SERVER' => date("Y-m-d\TH:i"),
            'NOTE_USER' => $inputs['DATA']['CANCEL_S_NOTES'],
            'NOTE_SERVER' => "Sending Document canceled by sender",
        ]
    ];
    $insertSCancelToLogsResult = insert($insertSCancelToLogsData);
    $results[] = !is_null($insertSCancelToLogsResult);

    $valid = checkArray($results);
    if ($valid) {
        $conn->commit();
        echo json_encode(
            array(
                'VALID' => $valid,
                'MESSAGE' => "Sending has been canceled."
            )
        );
    } else {
        $conn->rollback();
        echo json_encode(
            array(
                'VALID' => $valid,
                'MESSAGE' => "SERVER ERROR"
            )
        );
    }
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
    $lastInboundId = 0;
    $results = [];

    $requiredFields = [
        'DOC_NUM',
        'ROUTE_NUM',
        'DATE_TIME_SEND',
        'PRPS_ID',
        'R_DEPT_ID',
        'DOC_NOTES',
        'ACTION_ID',
        'S_DEPT_ID',
        'S_USER_ID',
    ];

    if (!validateInputs($requiredFields, $inputs)) {
        echo json_encode(
            [
                'VALID' => $valid,
                'MESSAGE' => "Please Fill up Required Fields"
            ]
        );
        exit;
    }


    $conn->begin_transaction();

    $insertInboundData = [
        'TABLE' => 'DOTS_DOCUMENT_INBOUND',
        'DATA' => $inputs['DATA'],
    ];
    $insertOutboundData = [
        'TABLE' => 'DOTS_DOCUMENT_OUTBOUND',
        'DATA' => $inputs['DATA'],
    ];

    $checkRoutedData = [
        'TABLE' => 'DOTS_DOCUMENT',
        'COLUMNS' => [
            'ID',
            'DOC_NUM',
            'ROUTE_NUM',
            'ROUTED',
        ],
        'WHERE' => [
            'AND' => [
                ['DOC_NUM' => $inputs['DATA']['DOC_NUM']],
                ['ROUTE_NUM' => $inputs['DATA']['ROUTE_NUM']],
            ]
        ],
    ];
    $checkRoutedRow = selectSingleRow($checkRoutedData);

    $updateDocumentData = [
        'TABLE' => 'DOTS_DOCUMENT',
        'DATA' => [
            'ROUTED' => 1,//set to routed
            'DOC_STATUS' => 1,//set on hand to pending
        ],
        'WHERE' => [
            'ID' => $checkRoutedRow['ID']
        ],
    ];

    $selectReceiverData = [
        'TABLE' => 'DOTS_ACCOUNT_INFO',
        'COLUMNS' => [
            "DOTS_ACCOUNT_INFO.FULL_NAME",
            "DOTS_DOC_DEPT.DOC_DEPT"
        ],
        'JOIN' => [
            [
                'table' => 'DOTS_DOC_DEPT',
                'ON' => ['DOTS_DOC_DEPT.ID = DOTS_ACCOUNT_INFO.DEPT_ID'],
                'TYPE' => 'LEFT',
            ],
        ],
        'WHERE' => [
            'AND' => [
                ['HRIS_ID' => $inputs['DATA']['R_USER_ID']],
                ['DEPT_ID' => $inputs['DATA']['R_DEPT_ID']],
            ]
        ],
    ];
    $selectReceiverRow = selectSingleRow($selectReceiverData);

    if ($checkRoutedRow['ROUTED'] == 1) {
        $selectDocumentData = [
            'TABLE' => 'DOTS_DOCUMENT',
            'WHERE' => [
                'AND' => [
                    ['DOC_NUM' => $checkRoutedRow['DOC_NUM']]
                ],
            ],
            'ORDER_BY' => 'ROUTE_NUM DESC'
        ];
        $selectDocumentRow = selectSingleRow($selectDocumentData);
        unset($selectDocumentRow['ID']);

        $newRoutingNumber = intval($selectDocumentRow['ROUTE_NUM']) + 1;
        $selectDocumentRow['ROUTE_NUM'] = $newRoutingNumber;
        $insertInboundData['DATA']["ROUTE_NUM"] = $newRoutingNumber;
        $insertOutboundData['DATA']["ROUTE_NUM"] = $newRoutingNumber;

        $insertDocumentData = [
            'TABLE' => 'DOTS_DOCUMENT',
            'DATA' => $selectDocumentRow,
        ];
        $results[] = insert($insertDocumentData);

        $insertDocumentLogData = [
            'TABLE' => 'DOTS_TRACKING',
            'DATA' => [
                'HRIS_ID' => $_SESSION['HRIS_ID'],
                'DOC_NUM' => $checkRoutedRow['DOC_NUM'],
                'ROUTE_NUM' => $newRoutingNumber,
                'ACTION_ID' => 4,//Duplicate action_id
                'DATE_TIME_SERVER' => date("Y-m-d\TH:i"),
                'DATE_TIME_ACTION' => $inputs['DATA']['DATE_TIME_SEND'],
                'NOTE_SERVER' => 'Document already routed, Document has been duplicated',
            ]
        ];
        if (isset($inputs['DATA']['DOC_NOTES'])) {
            $insertDocumentLogData['DATA']['NOTE_USER'] = $inputs['DATA']['DOC_NOTES'];
        }
        $results[] = insert($insertDocumentLogData);

    } else if ($checkRoutedRow['ROUTED'] == 0) {
        $results[] = update($updateDocumentData);
    }

    $results[] = insert($insertInboundData);
    $lastInboundId = $conn->insert_id;

    $insertInboundLogData = [
        'TABLE' => 'DOTS_TRACKING',
        'DATA' => [
            'HRIS_ID' => $_SESSION['HRIS_ID'],
            'DOC_NUM' => $checkRoutedRow['DOC_NUM'],
            'ROUTE_NUM' => $newRoutingNumber,
            'ACTION_ID' => 1,//sent action_id
            'DATE_TIME_SERVER' => date("Y-m-d\TH:i"),
            'DATE_TIME_ACTION' => $inputs['DATA']['DATE_TIME_SEND'],
            'NOTE_SERVER' => "Document Sent to $selectReceiverRow[DOC_DEPT]-$selectReceiverRow[FULL_NAME]",
        ]
    ];

    if (isset($inputs['DATA']['DOC_NOTES'])) {
        $insertInboundLogData['DATA']['NOTE_USER'] = $inputs['DATA']['DOC_NOTES'];
    }
    
    $insertOutboundData['DATA']['INBOUND_ID'] = $lastInboundId;
    $results[] = insert($insertOutboundData);
    $results[] = insert($insertInboundLogData);

    $valid = checkArray($results);
    if ($valid) {
        $conn->commit();
        $formattedDocumentNumber = formatDocumentNumber($checkRoutedRow['DOC_NUM'], $newRoutingNumber);
        echo json_encode([
            'VALID' => $valid,
            "MESSAGE" => "$formattedDocumentNumber Sent to $selectReceiverRow[DOC_DEPT]-$selectReceiverRow[FULL_NAME]",
        ]);
    } else {
        $conn->rollback();
        echo json_encode([
            'VALID' => $valid,
            "MESSAGE" => "SERVER ERROR",
        ]);
    }
}

function receiveDoc($inputs, $conn)
{
    $valid = false;
    $results = [];

    $requiredFields = [
        'ACTION_ID',
        'DATE_TIME_RECEIVED',
        'LETTER_DATE',
        'DOC_TYPE_ID',
        'S_OFFICE_ID',
        'DOC_SUBJECT',
        'DOC_STATUS',
        'R_USER_ID',
        'R_DEPT_ID',
        'DOC_SUBJECT'
    ];

    if (!validateInputs($requiredFields, $inputs)) {
        //notify user that a inputs is blank or not set
        echo json_encode(
            [
                'VALID' => $valid,
                'MESSAGE' => "Please ensure all required fields are filled out."
            ]
        );
        exit;
    }
    $conn->begin_transaction();

    $insertDocumentData = array(
        'TABLE' => 'DOTS_DOCUMENT',
        'DATA' => $inputs['DATA'],
    );
    $results[] = insert($insertDocumentData);
    $lastId = $conn->insert_id; //id of the last inserted row

    //get doc_num, route_num and actionid
    $selectDocumentData = [
        'TABLE' => 'DOTS_DOCUMENT',
        'WHERE' => [
            'AND' => [
                ['ID' => $lastId]
            ]
        ]
    ];
    $selectDocumentRow = selectSingleRow($selectDocumentData);

    //add log create/ receive doc
    $insertLogData = [
        'TABLE' => 'DOTS_TRACKING',
        'DATA' => [
            'DOC_NUM' => $selectDocumentRow['DOC_NUM'],
            'ROUTE_NUM' => $selectDocumentRow['ROUTE_NUM'],
            'ACTION_ID' => $selectDocumentRow['ACTION_ID'],
            'HRIS_ID' => $_SESSION['HRIS_ID'],
            'DATE_TIME_SERVER' => date("Y-m-d\TH:i"),
            'NOTE_SERVER' => "Document Created/Received at the receiving station",
            'DATE_TIME_ACTION' => $selectDocumentRow['DATE_TIME_RECEIVED'],
        ],
    ];
    $results[] = insert($insertLogData);

    $formattedDocumentNumber = formatDocumentNumber($selectDocumentRow['DOC_NUM'],$selectDocumentRow['ROUTE_NUM']);
    $formattedMessage = "";
    if ($inputs['DATA']['ACTION_ID'] == 2) {
        $formattedMessage = "Document $formattedDocumentNumber Received";
    }
    if ($inputs['DATA']['ACTION_ID'] == 3) {
        $formattedMessage = "Document $formattedDocumentNumber Created";
    }

    $valid = checkArray($results);
    if ($valid) {
        $conn->commit();
        echo json_encode(
            array(
                'VALID' => $valid,
                'MESSAGE' => $formattedMessage,
            )
        );
    } else {
        $conn->rollback();
        echo json_encode(
            array(
                'VALID' => $valid,
                'MESSAGE' => "SERVER ERROR",
            )
        );
    }
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
    $result = $conn->query($selectTableSql);

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
        ],
        [
            "className" => "btnT",
            "label" => "T"
        ]
    );
    setupTable($result, $buttons, $tableName);
}

function getTableUser($inputs, $conn, $tableName)
{
    $queries = new Queries();
    $buttons = [];
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
            ],
            [
                "className" => "btnA",
                "label" => "A"
            ],
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
                "className" => "btnCS",
                "label" => "C"
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
    // var_dump($_SESSION);
    if ($_SESSION['DOTS_PRIV'] == 0) {
        $buttons = [];
    } else if ($_SESSION['DOTS_PRIV'] == 1) {
        $buttons = [];
        $buttons[] = [
            'className' => 'btnT',
            'label' => 'T'
        ];
    } else {
        $buttons[] = [
            'className' => 'btnT',
            'label' => 'T'
        ];
    }
    setupTable($resultAsArray, $buttons, $tableName);
}
function setupTable($result, $buttons, $tableName)
{
    $valid = false;
    $formattedResult = [];
    if ($result != "")
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
                } else if ($key == "Date of Server" && $value != null) {
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
    $results = [];

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

    //select the doc on inbound and check if it is already recieived
    //setup the data for select on inbound
    $selectinboundData = [
        'TABLE' => 'DOTS_DOCUMENT_INBOUND',
        'WHERE' => [
            'AND' => [
                ['ID' => $inputs['DATA']['ID']]
            ]
        ]
    ];
    $selectinboundRow = selectSingleRow($selectinboundData);
    if ($selectinboundRow['ACTION_ID'] == 2) {
        echo json_encode(
            [
                'VALID' => $valid,
                'MESSAGE' => "Document Already Received",
            ]
        );
        exit;
    }

    $conn->begin_transaction();

    //add log recieve by user
    $insertLogData = [
        'TABLE' => 'DOTS_TRACKING',
        'DATA' => [
            'DOC_NUM' => $inputs['DATA']["DOC_NUM"],
            'ROUTE_NUM' => $inputs['DATA']["ROUTE_NUM"],
            'ACTION_ID' => 2,//ACTION_ID RECEIVE
            'HRIS_ID' => $_SESSION['HRIS_ID'],
            'DATE_TIME_ACTION' => $inputs['DATA']['DATE_TIME_RECEIVED'],
            'DATE_TIME_SERVER' => date("Y-m-d\TH:i"),
            'NOTE_SERVER' => "Document Received by the user",
        ]
    ];

    $results[] = insert($insertLogData);
    $results[] = insert($insertData);
    $lastId = $conn->insert_id;

    $updateData['DATA']['OUTBOUND_ID'] = $lastId;
    $results[] = update($updateData);

    $valid = checkArray($results);
    if ($valid) {
        $conn->commit();
        $formattedDocumentNumber = formatDocumentNumber($inputs['DATA']["DOC_NUM"], $inputs['DATA']["ROUTE_NUM"]);
        echo json_encode(
            array(
                'VALID' => $valid,
                'MESSAGE' => "Document $formattedDocumentNumber Received",
            )
        );
    } else {
        $conn->rollback();
        echo json_encode(
            array(
                'VALID' => $valid,
                'MESSAGE' => "SERVER ERROR",
            )
        );
    }

}
function sendDocFormUser($inputs, $conn)
{
    $queries = new Queries();
    $newRouteNumber = 0;
    $insertOutboundData = [];
    $message = "";
    $valid = false;

    $requiredInputs = [
        'DOC_NUM',
        'ROUTE_NUM',
        'DATE_TIME_SEND',
        'PRPS_ID',
        'R_DEPT_ID',
        'R_USER_ID',
        'DOC_NOTES',
        'ID',
        'ACTION_ID',
        'S_DEPT_ID',
        'S_USER_ID',
    ];

    $validated = validateInputs($requiredInputs, $inputs);
    if (!$validated) {
        $message = "Please Fill Required Inputs";
    } else {
        $valid = true;
        $message = "Document Sent";

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

        $selectReceiverData = [
            'TABLE' => 'DOTS_ACCOUNT_INFO',
            'COLUMNS' => [
                "DOTS_ACCOUNT_INFO.FULL_NAME",
                "DOTS_DOC_DEPT.DOC_DEPT"
            ],
            'JOIN' => [
                [
                    'table' => 'DOTS_DOC_DEPT',
                    'ON' => ['DOTS_DOC_DEPT.ID = DOTS_ACCOUNT_INFO.DEPT_ID'],
                    'TYPE' => 'LEFT',
                ],
            ],
            'WHERE' => [
                'AND' => [
                    ['HRIS_ID' => $inputs['DATA']['R_USER_ID']],
                    ['DEPT_ID' => $inputs['DATA']['R_DEPT_ID']],
                ]
            ],
        ];
        $selectReceiverRow = selectSingleRow($selectReceiverData);

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

            $insertInboundSql = $queries->insertQuery($insertInboundData);
            $insertInboundResult = $conn->query($insertInboundSql);

            $last_id = $conn->insert_id;

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
                    'NOTE_USER' => $inputs['DATA']['DOC_NOTES'],
                    'NOTE_SERVER' => "Document already routed, Document has been duplicated",
                    'DATE_TIME_ACTION' => $inputs['DATA']['DATE_TIME_SEND'],
                    'DATE_TIME_SERVER' => date("Y-m-d\TH:i"),
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
            $insertOutboundData['DATA']["INBOUND_ID"] = $last_id;

            $insertOutboundSql = $queries->insertQuery($insertOutboundData);
            $insertOutboundResult = $conn->query($insertOutboundSql);

        } else if ($selectOutboundRow['ROUTED'] == 0) {


            $insertInboundSql = $queries->insertQuery($insertInboundData);
            $insertInboundResult = $conn->query($insertInboundSql);

            $last_id = $conn->insert_id;

            $updateOutboundData['DATA']['INBOUND_ID'] = $last_id;
            $updateOutboundSql = $queries->updateQuery($updateOutboundData);
            $updateOutboundResult = $conn->query($updateOutboundSql);
        }

        //add log outbound send
        $insertMainLogData = [
            'TABLE' => 'DOTS_TRACKING',
            'DATA' => [
                'DOC_NUM' => $selectOutboundRow["DOC_NUM"],
                'ROUTE_NUM' => $selectOutboundRow["ROUTE_NUM"],
                'ACTION_ID' => 1,//ACTION_ID SEND
                'HRIS_ID' => $_SESSION['HRIS_ID'],
                'NOTE_USER' => $inputs['DATA']['DOC_NOTES'],
                'NOTE_SERVER' => "Document Sent to $selectReceiverRow[DOC_DEPT]-$selectReceiverRow[FULL_NAME]",
                'DATE_TIME_ACTION' => $inputs['DATA']['DATE_TIME_SEND'],
                'DATE_TIME_SERVER' => date("Y-m-d\TH:i"),
            ],
        ];

        $insertMainLogSql = $queries->insertQuery($insertMainLogData);
        $insertMainLogResult = $conn->query($insertMainLogSql);

    }
    echo json_encode(
        array(
            'VALID' => $valid,
            'MESSAGE' => $message,
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

            'NOTE_USER as `User notes`',
            'NOTE_SERVER as `Server Notes`',

            'DATE_TIME_ACTION as `Date of Action`',
            'DATE_TIME_SERVER as `Date of Server`',
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
        "WHERE" => [
            'AND' => [
                ["DOC_NUM" => $inputs['DATA']['DOC_NUM']],
                ["ROUTE_NUM" => $inputs['DATA']['ROUTE_NUM']],
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
            'DESCRIPTION',
            'FILE_PATH',
            'FILE_NAME',
        ],
        'WHERE' => $inputs['WHERE']
    ];
    $selectTableSql = $queries->selectQuery($data);
    // echo $selectTableSql;
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
    return $date->format('D, m/j/Y') . "  " . $strTime;
}

function formatDate($dateString)
{
    $date = new DateTime($dateString);
    return($date->format('n')) . "/" . $date->format('j') . "/" . $date->format('Y');
}
function formatDocumentNumber($doc_num, $route_num)
{
    $formattedDocumentNumber = "$doc_num-$route_num";
    if ($route_num == 0) {
        $formattedDocumentNumber = "$doc_num";
    }
    return $formattedDocumentNumber;
}
function checkArray($array)
{
    if (in_array(false, $array, true)) {
        return false;
    } else {
        return true;
    }
}
function validateInputs($requiredFields, $inputs)
{
    foreach ($requiredFields as $field) {
        if (!isset($inputs['DATA'][$field]) || $inputs['DATA'][$field] == "") {
            return false;
        }
    }
    return true;
}

function insert($insertData)
{
    $queries = new Queries();
    global $conn;

    $insertSql = $queries->insertQuery($insertData);
    $insertResult = $conn->query($insertSql);

    return $insertResult;
}
function update($updateData)
{
    $queries = new Queries();
    global $conn;

    $updateSql = $queries->updateQuery($updateData);
    $updateResult = $conn->query($updateSql);

    return $updateResult;
}

function selectSingleRow($selectData)
{
    $queries = new Queries();
    global $conn;

    $selectSql = $queries->selectQuery($selectData);
    $selectResult = $conn->query($selectSql);
    $selectRow = $selectResult->fetch_assoc();

    return $selectRow;

}
?>