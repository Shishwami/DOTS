<?php
// Include necessary PHP files for database connection and queries
include "DB_Connect.php";
include "Queries.php";

// Start a PHP session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    // Retrieve JSON input data and sanitize it
    $inputs = json_decode(file_get_contents("php://input"), true);
    $inputs = sanitizeInputs($inputs);

    // Set the default timezone
    date_default_timezone_set("Asia/Manila");

    // Determine the action based on the value of REQUEST
    switch ($inputs['REQUEST']) {
        // Handle user login
        case 'USER_LOGIN':
            userLogin($inputs, $conn);
            break;

        // Get current date
        case 'GET_DATE':
            get_Date($inputs);
            break;

        // Get session value for full name
        case 'GET_SESSION_NAME':
            getSessionValue("FULL_NAME");
            break;
        // Get session value for initials
        case 'GET_SESSION_INITIAL':
            getSessionValue("INIITAL");
            break;
        // Get session value for HRIS ID
        case 'GET_SESSION_HRIS_ID':
            getSessionValue("HRIS_ID");
            break;
        // Get session value for department ID
        case 'GET_SESSION_DEPT_ID':
            getSessionValue("DEPT_ID");
            break;

        // Get document number
        case 'GET_DOC_NUM':
            getDocNum($inputs, $conn);
            break;
        // Get addressee information
        case 'GET_ADDRESSEE':
            getAddressee($inputs, $conn);
            break;

        // Get document details
        case "GET_DOCUMENT":
            getDocument($inputs, $conn);
            break;
        // Edit document
        case 'EDIT_DOCUMENT':
            editDocument($inputs, $conn);
            break;
        // Cancel document received
        case 'CANCEL_RECEIVE':
            cancelReceive($inputs, $conn);
            break;
        // Cancel document sending
        case 'CANCEL_SEND':
            cancelSend($inputs, $conn);
            break;
        // Get document type options
        case "GET_DOC_TYPE":
            getOptions('DOTS_DOC_TYPE', 'DOC_TYPE', $conn);
            break;
        // Get department options
        case 'GET_DEPT':
            getOptions('DOTS_DOC_DEPT', 'DOC_DEPT', $conn);
            break;
        // Get document office options
        case 'GET_DOC_OFFICE':
            getOptions('DOTS_DOC_OFFICE', 'DOC_OFFICE', $conn);
            break;
        // Get document purpose options
        case 'GET_DOC_PRPS':
            getOptions('DOTS_DOC_PRPS', 'DOC_PRPS', $conn);
            break;

        // Receive document
        case 'RECEIVE_DOC':
            receiveDoc($inputs, $conn);
            break;
        // Send document form
        case 'SEND_DOC_FORM':
            sendDocForm($inputs, $conn);
            break;

        // Get main table data
        case 'GET_TABLE_MAIN':
            getTableMain($inputs, $conn);
            break;
        // Get inbound table data
        case 'GET_TABLE_INBOUND':
            getTableUser($inputs, $conn, 'DOTS_DOCUMENT_INBOUND');
            break;
        // Get outbound table data
        case 'GET_TABLE_OUTBOUND':
            getTableUser($inputs, $conn, 'DOTS_DOCUMENT_OUTBOUND');
            break;
        // Get attachment table data
        case 'GET_TABLE_ATTACHMENT':
            getTableAttachment($inputs, $conn);
            break;
        // Get tracking table data
        case 'GET_TABLE_TRACKING':
            getTableTracking($inputs, $conn);
            break;

        // Receive document for user
        case 'RECEIVE_DOC_USER':
            receiveDocUser($inputs, $conn);
            break;
        // Send document form for user
        case 'SEND_DOC_USER':
            sendDocFormUser($inputs, $conn);
            break;

        // Get attachment file location
        case 'GET_ATTACHMENT':
            returnFileLocation($inputs['ID']);
            break;
        // Get routing slip table row
        case 'GET_ROUTING_SLIP':
            getTableRow($inputs['ID']);
            break;
    }
    // Close the database connection
    $conn->close();

} catch (mysqli_sql_exception $th) {
    // Handle MySQLi exceptions
    echo '' . $th->getMessage() . '\r\n asd';
} catch (Exception $th) {
    // Handle general exceptions
    echo '' . $th->getMessage() . '\r\n asd';
}

/**
 * Function to handle user login.
 *
 * This function takes user credentials (username and password),
 * verifies them against the database, and sets session variables
 * if the credentials are valid.
 *
 * @param array $inputs User input data containing username and password.
 * @param mysqli $conn MySQLi database connection object.
 * @return void This function echoes JSON-encoded response indicating login status.
 */
function userLogin($inputs, $conn)
{
    // Initialize variables for login status
    $valid = false;
    // Extract username and password from input data
    $username = $inputs['WHERE']['USERNAME'];
    $password = $inputs['WHERE']['PASSWORD'];

    // Construct query to select user data from the database
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

    // Execute query to select user data
    $selectUserRow = selectSingleRow($selectUserData);

    // Check if user data is empty (indicating invalid credentials)
    if (empty ($selectUserRow)) {
        echo json_encode([
            'VALID' => $valid,
            'MESSAGE' => "Invalid Username or Password.",
        ]);
        exit;
    }

    // If credentials are valid, set login status to true
    $valid = true;
    // Set session variables
    foreach ($selectUserRow as $key => $value) {
        $_SESSION[$key] = $value;
    }

    // Echo JSON-encoded response indicating login status and message
    echo json_encode([
        'VALID' => $valid,
        'MESSAGE' => "Log in Successfull, Redirecting",
    ]);
}


/**
 * Function to retrieve current date or time based on input.
 *
 * This function returns the current date or time based on the value of the input parameter 'DATE'.
 * Possible values for 'DATE' parameter: "DATE", "TIME", "DATE_TIME".
 * 
 * @param array $inputs Input data containing the key 'DATE' specifying the type of time to retrieve.
 *                     Expected format: ['DATE' => 'string'].
 * @return string Current date or time based on the input parameter.
 */
function get_Date($inputs)
{
    $time = ""; // Initialize variable to store the current date or time
    $valid = false; // Initialize variable to indicate if the operation was successful

    // Retrieve current date or time based on the value of the 'DATE' parameter
    if ($inputs['DATE'] == "DATE") {
        $time = date("Y-m-d"); // Format: YYYY-MM-DD
        $valid = true; // Set validity flag to true
    }

    if ($inputs['DATE'] == "TIME") {
        $time = date('h:i'); // Format: HH:MM (12-hour format)
        $valid = true; // Set validity flag to true
    }

    if ($inputs['DATE'] == "DATE_TIME") {
        $time = date("Y-m-d\TH:i"); // Format: YYYY-MM-DDTHH:MM (ISO 8601 format)
        $valid = true; // Set validity flag to true
    }

    // Prepare and echo JSON-encoded response including validity status and time
    echo json_encode(
        array(
            'VALID' => $valid,
            'TIME' => $time,
        )
    );

    // Return the current date or time
    return $time;
}


/**
 * Function to retrieve a value from the session.
 *
 * This function retrieves the value associated with the specified key from the session.
 * If the key exists in the session, the function sets the validity flag to true and returns the value.
 * If the key does not exist, the function sets the validity flag to false.
 * 
 * @param string $key The key whose value needs to be retrieved from the session.
 * @return void This function echoes JSON-encoded response indicating the validity and the session value.
 */
function getSessionValue($key)
{
    $valid = false; // Initialize variable to indicate if the session value exists
    $sessionValue = ''; // Initialize variable to store the session value

    // Check if the specified key exists in the session
    if (isset($_SESSION[$key])) {
        $valid = true; // Set validity flag to true
        $sessionValue = $_SESSION[$key]; // Retrieve session value associated with the key
    }

    // Prepare and echo JSON-encoded response including validity status and session value
    echo json_encode(
        array(
            'VALID' => $valid,
            'RESULT' => $sessionValue,
        )
    );
}

/**
 * Function to sanitize input data recursively.
 *
 * This function sanitizes input data recursively. If the input is an array,
 * it iterates through each element and sanitizes them recursively.
 * If the input is a string, it sanitizes it using FILTER_SANITIZE_STRING filter.
 * 
 * @param mixed $input The input data to be sanitized.
 * @return mixed The sanitized input data.
 */
function sanitizeInputs($input)
{
    // Check if the input is an array
    if (is_array($input)) {
        // Iterate through each element of the array
        foreach ($input as $key => $value) {
            // Recursively sanitize each element of the array
            $input[$key] = sanitizeInputs($value);
        }
    } else {
        // If the input is not an array (i.e., it's a string), sanitize it using FILTER_SANITIZE_STRING filter
        $input = filter_var($input, FILTER_SANITIZE_STRING);
    }
    
    // Return the sanitized input data
    return $input;
}

/**
 * Function to retrieve the current document number from the database.
 *
 * This function retrieves the current document number from the database table DOTS_NUM_SEQUENCE.
 * It executes a select query to fetch the current value from the table.
 * 
 * @param array $inputs Input data (not used in this function).
 * @param mysqli $conn MySQLi database connection object.
 * @return void This function echoes JSON-encoded response indicating the validity and the current document number.
 */
function getDocNum($inputs, $conn)
{
    // Instantiate Queries class to access query methods
    $queries = new Queries();

    $valid = false; // Initialize variable to indicate if the operation was successful
    $doc_num = 0; // Initialize variable to store the current document number

    // Define data for the select query
    $data = array(
        'TABLE' => 'DOTS_NUM_SEQUENCE',
        'COLUMNS' => array(
            'CURRENT_VALUE',
        ),
    );

    // Generate SQL query using the selectQuery method from Queries class
    $sql = $queries->selectQuery($data);

    // Execute the SQL query
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        $valid = true; // Set validity flag to true
        // Fetch the result row as an associative array
        $row = $result->fetch_assoc();
        // Check if the 'CURRENT_VALUE' column exists in the result
        if (isset($row['CURRENT_VALUE'])) {
            $doc_num = $row['CURRENT_VALUE']; // Retrieve the current document number
        }
    }

    // Prepare and echo JSON-encoded response including validity status and the current document number
    echo json_encode(
        array(
            'VALID' => $valid,
            'RESULT' => $doc_num
        )
    );
}

/**
 * Function to retrieve document details from the database.
 *
 * This function retrieves document details from the database table DOTS_DOCUMENT based on the provided document ID.
 * It executes a select query to fetch the document details and converts the date-time format to HTML datetime string.
 * 
 * @param array $inputs Input data containing the document ID.
 *                     Expected format: ['DATA' => ['ID' => 'string']].
 * @param mysqli $conn MySQLi database connection object.
 * @return void This function echoes JSON-encoded response containing the document details.
 */
function getDocument($inputs, $conn)
{
    // Instantiate Queries class to access query methods
    $queries = new Queries();

    // Define data for the select query to retrieve document details
    $selectDocData = [
        'TABLE' => 'DOTS_DOCUMENT',
        "WHERE" => [
            'AND' => [
                ['ID' => $inputs['DATA']['ID']]
            ]
        ],
    ];

    // Generate SQL query using the selectQuery method from Queries class
    $selectDocSql = $queries->selectQuery($selectDocData);

    // Execute the SQL query
    $selectDocResult = $conn->query($selectDocSql);

    // Fetch the result row as an associative array
    $selectDocRow = $selectDocResult->fetch_assoc();

    // Convert the PHP timestamp to HTML datetime string
    $php_timestamp = strtotime($selectDocRow['DATE_TIME_RECEIVED']);
    $html_datetime_string = date('Y-m-d\TH:i', $php_timestamp);

    // Prepare data for JSON encoding
    $selectOutputData = [
        'ID' => $selectDocRow['ID'],
        'ACTION_ID' => $selectDocRow['ACTION_ID'],
        'DATE_TIME_RECEIVED' => $html_datetime_string,
        'LETTER_DATE' => $selectDocRow['LETTER_DATE'],
        'DOC_TYPE_ID' => $selectDocRow['DOC_TYPE_ID'],
        'S_OFFICE_ID' => $selectDocRow['S_OFFICE_ID'],
        'DOC_SUBJECT' => $selectDocRow['DOC_SUBJECT'],
    ];

    // Echo JSON-encoded response containing the document details
    echo json_encode($selectOutputData);
}


/**
 * Function to edit a document in the database.
 *
 * This function edits a document in the database based on the provided inputs.
 * It validates the inputs, checks user privileges, retrieves existing document data,
 * performs necessary conversions, compares old and new inputs, updates the document,
 * logs the edit action, and handles transaction commits or rollbacks.
 * 
 * @param array $inputs Input data containing the document details to be edited.
 * @param mysqli $conn MySQLi database connection object.
 * @return void This function echoes JSON-encoded response indicating the success of the operation and any messages.
 */
function editDocument($inputs, $conn)
{
    $queries = new Queries(); // Instantiate Queries class to access query methods
    $message = ""; // Initialize variable to store message
    $valid = false; // Initialize variable to indicate if the operation was successful
    $results = []; // Initialize array to store results
    $requiredInputs = [ // Define required input fields
        "ACTION_ID" => "Action",
        "DATE_TIME_RECEIVED" => 'Date Received',
        "DOC_SUBJECT" => 'Subject',
        "DOC_TYPE_ID" => 'Document Type',
        "ID" => "ID",
        "LETTER_DATE" => 'Letter Date',
        "S_OFFICE_ID" => "Office",
    ];

    // Validate input fields
    if (!validateInputsEdit($requiredInputs, $inputs)) {
        echo json_encode(
            array(
                'VALID' => $valid,
                'MESSAGE' => "Please Fill up required Fields",
            )
        );
        exit;
    }

    // Check user privileges
    if ($_SESSION['DOTS_PRIV'] < 3) {
        echo json_encode(
            array(
                'VALID' => $valid,
                'MESSAGE' => "Not enough privilege to perform this action",
            )
        );
        exit;
    }

    // Start transaction
    $conn->begin_transaction();

    // Select document data based on provided document ID
    $selectDocData = [
        'TABLE' => 'DOTS_DOCUMENT',
        'WHERE' => [
            'AND' => [
                ["ID" => $inputs['DATA']['ID']]
            ]
        ]
    ];
    $selectDocResult = selectSingleRow($selectDocData);

    // Select office data
    $selectDeptData = [
        'TABLE' => 'DOTS_DOC_OFFICE',
    ];
    $selectDeptSql = $queries->selectQuery($selectDeptData);
    $selectDeptResult = $conn->query($selectDeptSql);
    $selectDeptRows = resultsToArray($selectDeptResult);

    // Select document type data
    $selectDocTypeData = [
        'TABLE' => 'DOTS_DOC_TYPE',
    ];
    $selectDocTypeSql = $queries->selectQuery($selectDocTypeData);
    $selectDocTypeResult = $conn->query($selectDocTypeSql);
    $selectDocTypeRows = resultsToArray($selectDocTypeResult);

    $notEqualKeys = [];
    foreach ($requiredInputs as $key => $val) {
        $newInputs = $inputs['DATA'][$key];
        $oldInputs = $selectDocResult[$key];
        if ($key == "DATE_TIME_RECEIVED") {
            $timestampNew = strtotime($newInputs);
            $newInputs = date("d-m-y h:i A", $timestampNew);
            $timestampOld = strtotime($oldInputs);
            $oldInputs = date("d-m-y h:i A", $timestampOld);
        }
        if ($key == "DOC_TYPE_ID") {
            $newInputs = getValueFromId($newInputs, $selectDocTypeRows, "DOC_TYPE");
            $oldInputs = getValueFromId($oldInputs, $selectDocTypeRows, "DOC_TYPE");
        }
        if ($key == "S_OFFICE_ID") {
            $newInputs = getValueFromId($newInputs, $selectDeptRows, "DOC_OFFICE");
            $oldInputs = getValueFromId($oldInputs, $selectDeptRows, "DOC_OFFICE");
        }
        if ($key == "ACTION_ID") {
            if ($oldInputs == 2) {
                $oldInputs = "CREATE";
            } elseif ($oldInputs == 3) {
                $oldInputs = "RECEIVED";
            }

            if ($newInputs == 2) {
                $newInputs = "CREATE";
            } elseif ($newInputs == 3) {
                $newInputs = "RECEIVED";
            }

        }
        if ($newInputs !== $oldInputs) {
            $notEqualKeys[] = "$val($oldInputs = $newInputs)";
        }
    }
    $server_notes = implode(" , ", $notEqualKeys);

    // Check if any inputs were changed
    if ($server_notes == "") {
        echo json_encode(
            array(
                'VALID' => $valid,
                'MESSAGE' => "No inputs Changed",
            )
        );
        exit;
    }

    // Define data for updating the document
    $updateDocData = [
        'TABLE' => 'DOTS_DOCUMENT',
        'DATA' => $inputs['DATA'],
        'WHERE' => [
            'ID' => $inputs['DATA']['ID']
        ]
    ];

    // Determine the message based on the existence of route number
    if ($selectDocResult['ROUTE_NUM'] == 0) {
        $message = "Document $selectDocResult[DOC_NUM] Updated";
    } else {
        $message = "Document $selectDocResult[DOC_NUM]-$selectDocResult[ROUTE_NUM] Updated";
    }

    // Define data for inserting document log
    $insertDocLogData = [
        'TABLE' => 'DOTS_TRACKING',
        'DATA' => [
            'DOC_NUM' => $selectDocResult["DOC_NUM"],
            'ROUTE_NUM' => $selectDocResult["ROUTE_NUM"],
            'HRIS_ID' => $_SESSION['HRIS_ID'],
            'ACTION_ID' => 6, // ACTION_ID EDIT
            'DATE_TIME_SERVER' => date("Y-m-d\TH:i"),
            'NOTE_SERVER' => "$server_notes",
        ]
    ];
    $insertDocLogResult = insert($insertDocLogData);

    unset($inputs['DATA']['ID']);
    $updateDocSql = $queries->updateQuery($updateDocData);
    $updateDocResult = $conn->query($updateDocSql);

    // Store the results of insert and update operations
    $results[] = !is_null($insertDocLogResult);
    $results[] = !is_null($updateDocResult);

    // Check if all operations were successful
    $valid = checkArray($results);
    if ($valid) {
        $conn->commit(); // Commit the transaction
        echo json_encode(
            array(
                'VALID' => $updateDocResult,
                'MESSAGE' => $message
            )
        );
    } else {
        $conn->rollback(); // Rollback the transaction
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

    if ($_SESSION['DOTS_PRIV'] < 1) {
        echo json_encode(
            array(
                'VALID' => $valid,
                'MESSAGE' => "Not enough privilege to perform this action",
            )
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

    if (isset ($inputs['DATA']['CANCEL_R_DEPT'])) {
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
        'CANCEL_S_NOTES'
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
    if ($_SESSION['DOTS_PRIV'] < 1) {
        echo json_encode(
            array(
                'VALID' => $valid,
                'MESSAGE' => "Not enough privilege to perform this action",
            )
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
    $r_user_id = 0;

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

    if (isset ($inputs['DATA']['R_USER_ID'])) {
        $r_user_id = $inputs['DATA']['R_USER_ID'];
    }

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
        'WHERE' => [
            'AND' => [
                ['HRIS_ID' => $r_user_id],
            ]
        ],
    ];
    $selectReceiverRow = selectSingleRow($selectReceiverData);

    $selectDeptData = [
        'TABLE' => 'DOTS_DOC_DEPT',
        'WHERE' => [
            'AND' => [
                ['ID' => $inputs['DATA']['R_DEPT_ID']],
            ]
        ],
    ];
    $selectDeptRow = selectSingleRow($selectDeptData);

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
        if (isset ($inputs['DATA']['DOC_NOTES'])) {
            $insertDocumentLogData['DATA']['NOTE_USER'] = $inputs['DATA']['DOC_NOTES'];
        }
        $results[] = insert($insertDocumentLogData);

    } else if ($checkRoutedRow['ROUTED'] == 0) {
        $results[] = update($updateDocumentData);
    }

    $results[] = insert($insertInboundData);
    $lastInboundId = $conn->insert_id;

    $formattedDocumentNumber = formatDocumentNumber($checkRoutedRow['DOC_NUM'], $newRoutingNumber);
    $note_server = "Document $formattedDocumentNumber sent to ";
    if (!is_null($selectReceiverRow)) {
        $note_server .= "$selectDeptRow[DOC_DEPT]-$selectReceiverRow[FULL_NAME]";
    } else {
        $note_server .= "$selectDeptRow[DOC_DEPT]";
    }

    $insertInboundLogData = [
        'TABLE' => 'DOTS_TRACKING',
        'DATA' => [
            'HRIS_ID' => $_SESSION['HRIS_ID'],
            'DOC_NUM' => $checkRoutedRow['DOC_NUM'],
            'ROUTE_NUM' => $newRoutingNumber,
            'ACTION_ID' => 1,//sent action_id
            'DATE_TIME_SERVER' => date("Y-m-d\TH:i"),
            'DATE_TIME_ACTION' => $inputs['DATA']['DATE_TIME_SEND'],
            'NOTE_SERVER' => $note_server,
        ]
    ];

    if (isset ($inputs['DATA']['DOC_NOTES'])) {
        $insertInboundLogData['DATA']['NOTE_USER'] = $inputs['DATA']['DOC_NOTES'];
    }

    $insertOutboundData['DATA']['INBOUND_ID'] = $lastInboundId;
    $results[] = insert($insertOutboundData);
    $results[] = insert($insertInboundLogData);

    $valid = checkArray($results);
    if ($valid) {
        $conn->commit();
        echo json_encode([
            'VALID' => $valid,
            "MESSAGE" => $note_server,
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

    if ($_SESSION['DOTS_PRIV'] < 2) {
        echo json_encode(
            array(
                'VALID' => $valid,
                'MESSAGE' => "Not enough privilege to perform this action",
            )
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

    $formattedDocumentNumber = formatDocumentNumber($selectDocumentRow['DOC_NUM'], $selectDocumentRow['ROUTE_NUM']);
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
        ],
        [
            "className" => "btnP",
            "label" => "P"
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
        );
    }

    $data = array(
        'TABLE' => "$tableName",
        'COLUMNS' => array(
            "$tableName.ID",

            "CASE WHEN $tableName.ROUTE_NUM = 0 THEN $tableName.DOC_NUM 
             ELSE CONCAT($tableName.DOC_NUM,\"-\",$tableName.ROUTE_NUM) 
             END AS `No.`",

            "$tableName.DOC_NUM",
            "$tableName.ROUTE_NUM",
            "DOTS_DOCUMENT.DOC_SUBJECT as `Subject`",
            "$tableName.DOC_NOTES as `Notes`",
            "DOTS_DOC_PRPS.DOC_PRPS `Purpose`",

            "CONCAT(" .
            "IF(S_OFFICE.DOC_OFFICE IS NOT NULL,CONCAT(S_OFFICE.DOC_OFFICE,'-'), ' '),' ', " .
            "IF(S_DEPT.DOC_DEPT IS NOT NULL,CONCAT(S_DEPT.DOC_DEPT,'-'), ' '), " .
            "IFNULL(S_FULL_NAME.FULL_NAME, ' ')) as 'Sender'",

            "CONCAT(" .
            "IF(R_OFFICE.DOC_OFFICE IS NOT NULL,CONCAT(R_OFFICE.DOC_OFFICE,'-'), ' '),' ', " .
            "IF(R_DEPT.DOC_DEPT IS NOT NULL,CONCAT(R_DEPT.DOC_DEPT,'-'), ' '), " .
            "IFNULL(R_FULL_NAME.FULL_NAME, ' ')) as 'Receiver'",

            // "$tableName.DATE_TIME_RECEIVED as `Date Received`",
            "$tableName.DATE_TIME_SEND as `Date Sent`",
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
            array(
                "table" => "DOTS_DOCUMENT",
                "ON" => [
                    "DOTS_DOCUMENT.DOC_NUM = $tableName.DOC_NUM",
                    "DOTS_DOCUMENT.ROUTE_NUM = $tableName.ROUTE_NUM"
                ],
                "TYPE" => "LEFT",
            ),
        ),
        'ORDER_BY' => "$tableName.DOC_NUM DESC",
    );
    $data['WHERE'] = $WHERE[0];

    $selectTableSql = $queries->selectQuery($data);
    $result = mysqli_query($conn, $selectTableSql);
    $resultAsArray = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $resultAsArray[] = $row;
    }

    $buttons[] = [
        'className' => 'btnT',
        'label' => 'T'
    ];
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
    if ($_SESSION['DOTS_PRIV'] < 2) {
        echo json_encode(
            array(
                'VALID' => $valid,
                'MESSAGE' => "Not enough privilege to perform this action",
            )
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
    $valid = false;
    $results = [];

    $r_user_id = 0;
    if (isset ($inputs['DATA']['R_USER_ID'])) {
        $r_user_id = $inputs['DATA']['R_USER_ID'];
    }

    $requiredFields = [
        'DOC_NUM',
        'ROUTE_NUM',
        'DATE_TIME_SEND',
        'PRPS_ID',
        'R_DEPT_ID',
        'DOC_NOTES',
        'ID',
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
    if ($_SESSION['DOTS_PRIV'] < 2) {
        echo json_encode(
            array(
                'VALID' => $valid,
                'MESSAGE' => "Not enough privilege to perform this action",
            )
        );
        exit;
    }

    $conn->begin_transaction();

    //update outbound 
    $updateOutboundData = [
        'TABLE' => 'DOTS_DOCUMENT_OUTBOUND',
        'DATA' => [
            'ROUTED' => '1',
            'PRPS_ID' => $inputs['DATA']['PRPS_ID'],
            'DOC_NOTES' => $inputs['DATA']['DOC_NOTES'],
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
    if (isset ($inputs['DATA']['R_USER_ID'])) {
        $updateOutboundData['DATA']['R_USER_ID'] = $inputs['DATA']['R_USER_ID'];
    }

    //insert to inbound /send
    $insertInboundData = [
        'TABLE' => 'DOTS_DOCUMENT_INBOUND',
        'DATA' => [
            'DOC_NUM' => $inputs['DATA']['DOC_NUM'],
            'PRPS_ID' => $inputs['DATA']['PRPS_ID'],
            'DOC_NOTES' => $inputs['DATA']['DOC_NOTES'],
            'R_DEPT_ID' => $inputs['DATA']['R_DEPT_ID'],
            'S_USER_ID' => $inputs['DATA']['S_USER_ID'],
            'S_DEPT_ID' => $inputs['DATA']['S_DEPT_ID'],
            'DATE_TIME_SEND' => $inputs['DATA']['DATE_TIME_SEND'],
            'ACTION_ID' => "1",
        ],
    ];
    if (isset ($inputs['DATA']['R_USER_ID'])) {
        $insertInboundData['DATA']['R_USER_ID'] = $inputs['DATA']['R_USER_ID'];
    }

    //check if routed
    $selectOutboundData = [
        'TABLE' => 'DOTS_DOCUMENT_OUTBOUND',
        'WHERE' => array(
            'AND' => array(
                array('ID' => $inputs['DATA']['ID']),
            ),
        ),
    ];
    $selectOutboundRow = selectSingleRow($selectOutboundData);

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
                ['DEPT_ID' => $inputs['DATA']['R_DEPT_ID']],
            ]
        ],
    ];
    if (isset ($inputs['DATA']['R_USER_ID'])) {
        $selectReceiverData['WHERE']['AND'][]['HRIS_ID'] = $inputs['DATA']['R_USER_ID'];
    }

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
        $selectMainRow = selectSingleRow($selectMainData);

        //reassign route number
        $newRouteNumber = intval($selectMainRow['ROUTE_NUM']) + 1;
        $insertInboundData['DATA']['ROUTE_NUM'] = $newRouteNumber;
        $selectMainRow['ROUTE_NUM'] = $newRouteNumber;

        $results[] = insert($insertInboundData);
        $last_id = $conn->insert_id;

        //add to doc main
        unset($selectMainRow['ID']);
        $insertMainData = [
            'TABLE' => 'DOTS_DOCUMENT',
            'DATA' => $selectMainRow,
        ];
        $results[] = insert($insertMainData);

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
        $results[] = insert($insertMainLogData);

        //add to outbound
        $selectOutboundRow['ROUTE_NUM'] = $newRouteNumber;
        unset($selectOutboundRow['ID']);
        $insertOutboundData = [
            'TABLE' => 'DOTS_DOCUMENT_OUTBOUND',
            'DATA' => $selectOutboundRow
        ];
        $insertOutboundData["DATA"]['DATE_TIME_SEND'] = $inputs['DATA']['DATE_TIME_SEND'];
        $insertOutboundData['DATA']["INBOUND_ID"] = $last_id;

        $results[] = insert($insertOutboundData);

    } else if ($selectOutboundRow['ROUTED'] == 0) {
        $results[] = insert($insertInboundData);
        $last_id = $conn->insert_id;

        $updateOutboundData['DATA']['INBOUND_ID'] = $last_id;
        $results[] = update($updateOutboundData);
    }

    $selectReceiverData = [
        'TABLE' => 'DOTS_ACCOUNT_INFO',
        'WHERE' => [
            'AND' => [
                ['HRIS_ID' => $r_user_id],
            ]
        ],
    ];
    $selectReceiverRow = selectSingleRow($selectReceiverData);
    $selectDeptData = [
        'TABLE' => 'DOTS_DOC_DEPT',
        'WHERE' => [
            'AND' => [
                ['ID' => $inputs['DATA']['R_DEPT_ID']],
            ]
        ],
    ];
    $selectDeptRow = selectSingleRow($selectDeptData);

    $formattedDocumentNumber = formatDocumentNumber($selectOutboundRow['DOC_NUM'], $newRouteNumber);
    $note_server = "Document $formattedDocumentNumber sent to ";
    if (!is_null($selectReceiverRow)) {
        $note_server .= "$selectDeptRow[DOC_DEPT]-$selectReceiverRow[FULL_NAME]";
    } else {
        $note_server .= "$selectDeptRow[DOC_DEPT]";
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
            'NOTE_SERVER' => $note_server,
            'DATE_TIME_ACTION' => $inputs['DATA']['DATE_TIME_SEND'],
            'DATE_TIME_SERVER' => date("Y-m-d\TH:i"),
        ],
    ];
    $results[] = insert($insertMainLogData);

    $valid = checkArray($results);
    if ($valid) {
        $conn->commit();
        echo json_encode(
            array(
                'VALID' => $valid,
                'MESSAGE' => $note_server,
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
function getTableTracking($inputs, $conn)
{
    $queries = new Queries();


    if ($_SESSION['DOTS_PRIV'] < 1) {
        echo json_encode(
            array(
                'VALID' => false,
                'MESSAGE' => "Not enough privilege to perform this action",
            )
        );
        exit;
    }

    $selectTableData = [
        'TABLE' => 'DOTS_TRACKING',
        'COLUMNS' => [
            "CASE WHEN ROUTE_NUM = 0 THEN DOC_NUM 
            ELSE CONCAT(DOC_NUM,\"-\",ROUTE_NUM) 
            END AS `No.`",

            "CONCAT(
                IF(DOTS_ACCOUNT_INFO.OFFICE_ID IS NOT NULL,CONCAT(DOTS_ACCOUNT_INFO.OFFICE_ID,'-'), ' '),' ', 
                IF(DOTS_ACCOUNT_INFO.DEPT_ID IS NOT NULL,CONCAT(DOTS_DOC_DEPT.DOC_DEPT,'-'), ' '), 
                IFNULL(DOTS_ACCOUNT_INFO.FULL_NAME, ' ')) as 'Operator'",

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

    if ($_SESSION['DOTS_PRIV'] < 2) {
        echo json_encode(
            array(
                'VALID' => false,
                'MESSAGE' => "Not enough privilege to perform this action",
            )
        );
        exit;
    }

    $selectDocumentData = [
        'TABLE' => 'DOTS_DOCUMENT',
        'WHERE' => [
            'AND' => [
                ["ID" => $inputs['DATA']['ID']]
            ]
        ]
    ];
    $selectDocumentRow = selectSingleRow($selectDocumentData);
    // var_dump($selectDocumentRow);

    $tableName = 'DOTS_ATTACHMENTS';
    $data = [
        'TABLE' => $tableName,
        // 'COLUMNS' => [
        //     "CASE WHEN ROUTE_NUM = 0 THEN DOC_NUM 
        //     ELSE CONCAT(DOC_NUM,\"-\",ROUTE_NUM) 
        //     END AS `No.`",
        //     'DESCRIPTION',
        //     'FILE_PATH',
        //     'FILE_NAME',
        // ],
        'WHERE' => [
            'AND' => [
                ['DOC_NUM' => $selectDocumentRow['DOC_NUM']],
                ['ROUTE_NUM' => $selectDocumentRow['ROUTE_NUM']],
            ]
        ]
    ];
    if ($_SESSION['DOTS_PRIV'] < 3) {
        $data['WHERE']['AND'][] = ['HRIS_ID' => $_SESSION['HRIS_ID']];
    }

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
    return $date->format('D, m/j/Y') . "  " . $strTime;
}

function formatDate($dateString)
{
    $date = new DateTime($dateString);
    return ($date->format('n')) . "/" . $date->format('j') . "/" . $date->format('Y');
}
function resultsToArray($results)
{
    $rows = [];
    while ($row = mysqli_fetch_assoc($results)) {
        $rows[] = $row;
    }
    return $rows;
}
function getValueFromId($id, $array, $columnName)
{
    $value = "";
    foreach ($array as $item) {
        if ($item['ID'] == $id) {
            $value = $item[$columnName];
            break;
        }
    }
    return $value;
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
        if (!isset ($inputs['DATA'][$field]) || $inputs['DATA'][$field] == "") {
            return false;
        }
    }
    return true;
}
function validateInputsEdit($requiredFields, $inputs)
{
    foreach ($requiredFields as $field => $val) {
        if (!isset ($inputs['DATA'][$field]) || $inputs['DATA'][$field] == "") {
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
function returnFileLocation($id)
{

    $selectAttachmentData = [
        'TABLE' => 'DOTS_ATTACHMENTS',
        'WHERE' => [
            'AND' => [
                ['ID' => $id]
            ]
        ]
    ];
    $selectAttachmentRow = selectSingleRow($selectAttachmentData);

    $config = parse_ini_file('config.ini', true);
    $uploadDirectory = $config['ftp_credentials']['ftp_server'];

    $targetDir = "$uploadDirectory/$selectAttachmentRow[DOC_NUM]/$selectAttachmentRow[ROUTE_NUM]";
    $targetFile = "$targetDir/$selectAttachmentRow[DESCRIPTION].pdf";

    // Open the PDF file
    $fileHandle = fopen($targetFile, 'rb'); // 'rb' for reading binary mode
    $pdfContent = file_get_contents($targetFile);
    // Check if file opened successfully
    if ($fileHandle === false) {
        echo "Failed to open the PDF file.";
    } else {
        // Specify the directory where you want to store the temporary file on the server
        $tempDirectory = '../attachment_temp';

        if (!file_exists($tempDirectory)) {
            mkdir($tempDirectory, 0777, true);
        }

        // Create a temporary file in the specified directory
        $tmpFilePath = tempnam($tempDirectory, 'pdf_');
        $tmpFileName = basename($tmpFilePath);

        // Write the PDF content to the temporary file
        file_put_contents($tmpFilePath, $pdfContent);

        echo json_encode([
            'VALID' => true,
            'RESULS' => $tempDirectory . '/' . $tmpFileName
        ]);
    }

}

function getTableRow($id)
{

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
        'WHERE' => [
            'AND' => [
                ['DOTS_DOCUMENT.ID' => $id]
            ]
        ]
    );

    global $conn;
    $queries = new Queries();

    $selectPrpsData = [
        'TABLE' => 'DOTS_DOC_PRPS'
    ];

    $selectPrpsSql = $queries->selectQuery($selectPrpsData);
    $selectPrpsResults = $conn->query($selectPrpsSql);
    $selectPrpsArray = resultsToArray($selectPrpsResults);

    $selectDocumentRow = selectSingleRow($data);

    $selectDocumentRow['Date Received'] = formatDateTime($selectDocumentRow['Date Received']);
    $selectDocumentRow['Letter Date'] = formatDate($selectDocumentRow['Letter Date']);
    echo json_encode([
        'DOC' => $selectDocumentRow,
        'PRPS' => $selectPrpsArray
    ]);
}
?>