<?php
// Include necessary PHP files for database connection and queries
include "DB_Connect.php";
include "Queries.php";

$queries = new Queries($pdo);

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
            userLogin($inputs);
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
            getDocNum();
            break;
        // Get addressee information
        case 'GET_ADDRESSEE':
            getAddressee($inputs);
            break;

        // Get document details
        case "GET_DOCUMENT":
            getDocument($inputs);
            break;
        // Edit document
        case 'EDIT_DOCUMENT':
            editDocument($inputs);
            break;
        // Cancel document received
        case 'CANCEL_RECEIVE':
            cancelReceive($inputs);
            break;
        // Cancel document sending
        case 'CANCEL_SEND':
            cancelSend($inputs);
            break;
        // Get document type options
        case "GET_DOC_TYPE":
            getOptions('DOTS_DOC_TYPE', 'DOC_TYPE');
            break;
        // Get department options
        case 'GET_DEPT':
            getOptions('DOTS_DOC_DEPT', 'DOC_DEPT');
            break;
        // Get document office options
        case 'GET_DOC_OFFICE':
            getOptions('DOTS_DOC_OFFICE', 'DOC_OFFICE');
            break;
        // Get document purpose options
        case 'GET_DOC_PRPS':
            getOptions('DOTS_DOC_PRPS', 'DOC_PRPS');
            break;

        // Get year filter
        case 'GET_FILTER_YEAR':
            getOptions('DOTS_FILTER_YEAR', 'YEAR');
            break;

        // Receive document
        case 'RECEIVE_DOC':
            receiveDoc($inputs);
            break;
        // Send document form
        case 'SEND_DOC_FORM':
            sendDocForm($inputs);
            break;

        // Get main table data
        case 'GET_TABLE_MAIN':
            getTableMain($inputs);
            break;
        // Get inbound table data
        case 'GET_TABLE_INBOUND':
            getTableUser($inputs, 'DOTS_DOCUMENT_INBOUND');
            break;
        // Get outbound table data
        case 'GET_TABLE_OUTBOUND':
            getTableUser($inputs, 'DOTS_DOCUMENT_OUTBOUND');
            break;
        // Get attachment table data
        case 'GET_TABLE_ATTACHMENT':
            getTableAttachment($inputs);
            break;
        // Get tracking table data
        case 'GET_TABLE_TRACKING':
            getTableTracking($inputs);
            break;

        // Receive document for user
        case 'RECEIVE_DOC_USER':
            receiveDocUser($inputs);
            break;
        // Send document form for user
        case 'SEND_DOC_USER':
            sendDocFormUser($inputs);
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
    $pdo = null;

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
 * @return void This function echoes JSON-encoded response indicating login status.
 */
function userLogin($inputs)
{
    global $queries, $pdo;
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
    $selectUserRow = $queries->selectQuery($selectUserData);

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
    foreach ($selectUserRow[0] as $key => $value) {
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
    if (isset ($_SESSION[$key])) {
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
 * @return void This function echoes JSON-encoded response indicating the validity and the current document number.
 */
function getDocNum()
{
    // Instantiate Queries class to access query methods
    global $queries, $pdo;

    $valid = false; // Initialize variable to indicate if the operation was successful
    $doc_num = 0; // Initialize variable to store the current document number

    // Define data for the select query
    $data = array(
        'TABLE' => 'DOTS_NUM_SEQUENCE',
        'COLUMNS' => array(
            'CURRENT_VALUE',
        ),
    );
    $row = $queries->selectQuery($data)[0];

    if (isset ($row['CURRENT_VALUE'])) {
        $valid = true;
        $doc_num = $row['CURRENT_VALUE']; // Retrieve the current document number
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
 *                     Expected format: ['DATA' => ['ID' => 'ID of Document']].
 * @return void This function echoes JSON-encoded response containing the document details.
 */
function getDocument($inputs)
{
    // Instantiate Queries class to access query methods
    global $queries, $pdo;

    // Define data for the select query to retrieve document details
    $selectDocData = [
        'TABLE' => 'DOTS_DOCUMENT',
        "WHERE" => [
            'AND' => [
                ['ID' => $inputs['DATA']['ID']]
            ]
        ],
    ];

    // Fetch the result row as an associative array
    $selectDocRow = $queries->selectQuery($selectDocData)[0];

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
 * @return void This function echoes JSON-encoded response indicating the success of the operation and any messages.
 */
function editDocument($inputs)
{
    global $queries, $pdo;
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
    $pdo->beginTransaction();

    // Select document data based on provided document ID
    $selectDocData = [
        'TABLE' => 'DOTS_DOCUMENT',
        'WHERE' => [
            'AND' => [
                ["ID" => $inputs['DATA']['ID']]
            ]
        ]
    ];
    $selectDocResult = $queries->selectQuery($selectDocData)[0];

    // Select office data
    $selectDeptData = [
        'TABLE' => 'DOTS_DOC_OFFICE',
    ];
    $selectDeptRows = $queries->selectQuery($selectDeptData);

    // Select document type data
    $selectDocTypeData = [
        'TABLE' => 'DOTS_DOC_TYPE',
    ];
    $selectDocTypeRows = $queries->selectQuery($selectDocTypeData);

    // Initialize array to store keys of input fields that have been changed
    $notEqualKeys = [];

    // Iterate over required input fields to compare old and new values
    foreach ($requiredInputs as $key => $val) {
        $newInputs = $inputs['DATA'][$key];
        $oldInputs = $selectDocResult[$key];

        // Perform specific transformations for certain fields
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
        // Check if new value is different from old value, and add to the array of changed keys
        if ($newInputs != $oldInputs) {
            $notEqualKeys[] = "$val($oldInputs = $newInputs)";
        }
    }

    // Construct server notes based on the changes made
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
    $insertDocLogResult = $queries->insertQuery($insertDocLogData);

    unset($inputs['DATA']['ID']);
    $updateDocResult = $queries->updateQuery($updateDocData);

    // Store the results of insert and update operations
    $results[] = !is_null($insertDocLogResult);
    $results[] = !is_null($updateDocResult);

    // Check if all operations were successful
    $valid = checkArray($results);
    if ($valid) {
        $pdo->commit();// Commit the transaction
        echo json_encode(
            array(
                'VALID' => $updateDocResult,
                'MESSAGE' => $message
            )
        );
    } else {
        $pdo->rollBack(); // Rollback the transaction
        echo json_encode(
            array(
                'VALID' => $updateDocResult,
                'MESSAGE' => "SERVER ERROR"
            )
        );
    }
}

/**
 * Function to cancel the receiving of a document.
 *
 * This function cancels the receiving of a document by updating the related records in the database.
 * It validates inputs, checks user privileges, retrieves relevant document data, performs necessary updates,
 * and logs the cancellation action.
 * 
 * @param array $inputs Input data containing the necessary details for cancelling the document receiving.
 * @return void This function echoes JSON-encoded response indicating the success of the operation and any messages.
 */
function cancelReceive($inputs)
{
    global $queries, $pdo; // Access global variables $queries and $pdo

    $valid = false; // Initialize variable to indicate if the operation was successful
    $results = []; // Initialize array to store results

    $requiredFields = [ // Define required input fields
        'CANCEL_R_NOTES'
    ];

    // Validate input fields
    if (!validateInputs($requiredFields, $inputs)) {
        echo json_encode(
            [
                'VALID' => $valid,
                'MESSAGE' => "Please Fill up notes"
            ]
        );
        exit;
    }

    // Check user privileges
    if ($_SESSION['DOTS_PRIV'] < 1) {
        echo json_encode(
            array(
                'VALID' => $valid,
                'MESSAGE' => "Not enough privilege to perform this action",
            )
        );
        exit;
    }

    $pdo->beginTransaction(); // Begin transaction

    // Retrieve inbound document data
    $selectReceiveData = [
        'TABLE' => 'DOTS_DOCUMENT_INBOUND',
        'WHERE' => [
            'AND' => array(
                array('ID' => $inputs['DATA']['CANCEL_R_ID'])
            ),
        ]
    ];
    $selectReceiveRow = $queries->selectQuery($selectReceiveData)[0];

    // Check if the document has already been sent; cancellation not possible if already sent
    $selectInboundData = [
        'TABLE' => 'DOTS_DOCUMENT_OUTBOUND',
        'WHERE' => [
            "AND" => [
                ['ID' => $selectReceiveRow['OUTBOUND_ID']]
            ]
        ],
    ];
    $selectInboundRow = $queries->selectQuery($selectInboundData)[0];
    if ($selectInboundRow['ROUTED'] == 1) {
        echo json_encode(
            [
                'VALID' => $valid,
                'MESSAGE' => "Document already sent; cancellation not possible"
            ]
        );
        exit;
    }

    // Update the outbound document to cancelled status
    $deleteDocData = [
        'TABLE' => 'DOTS_DOCUMENT_OUTBOUND',
        'DATA' => [
            'ACTION_ID' => 5 // Cancelled
        ],
        'WHERE' => [
            'ID' => $selectReceiveRow['OUTBOUND_ID']
        ],
    ];
    $deleteDocResult = $queries->updateQuery($deleteDocData);
    $results[] = !is_null($deleteDocResult);

    // Update the inbound document to mark receiving as cancelled
    $updateReceiveData = [
        'TABLE' => 'DOTS_DOCUMENT_INBOUND',
        'DATA' => [
            'DATE_TIME_RECEIVED' => "NULL",
            'ACTION_ID' => 1 // ACTION_ID SENT
        ],
        "WHERE" => [
            'ID' => $inputs['DATA']['CANCEL_R_ID']
        ]
    ];

    if (isset ($inputs['DATA']['CANCEL_R_DEPT'])) {
        $updateReceiveData['DATA']['R_USER_ID'] = 0;
    }

    $updateReceiveResult = $queries->updateQuery($updateReceiveData);
    $results[] = !is_null($updateReceiveResult);

    // Add cancellation action to logs
    $insertRCancelToLogsData = [
        'TABLE' => 'DOTS_TRACKING',
        'DATA' => [
            'DOC_NUM' => $selectReceiveRow["DOC_NUM"],
            'ROUTE_NUM' => $selectReceiveRow["ROUTE_NUM"],
            'ACTION_ID' => 5, // ACTION_ID RECEIVE
            'HRIS_ID' => $_SESSION['HRIS_ID'],
            'DATE_TIME_SERVER' => date("Y-m-d\TH:i"),
            'NOTE_USER' => $inputs['DATA']['CANCEL_R_NOTES'],
            'NOTE_SERVER' => "Receiving canceled by user",
        ]
    ];
    $insertRCancelToLogsResult = $queries->insertQuery($insertRCancelToLogsData);
    $results[] = !is_null($insertRCancelToLogsResult);

    // Check if all operations were successful
    $valid = checkArray($results);
    if ($valid) {
        $pdo->commit(); // Commit the transaction
    } else {
        $pdo->rollBack(); // Rollback the transaction
        echo json_encode(
            array(
                "VALID" => $valid,
                "MESSAGE" => "SERVER ERROR"
            )
        );
        exit;
    }

    // Echo JSON-encoded response indicating the success of the operation and any messages
    echo json_encode(
        array(
            "VALID" => $valid,
            "MESSAGE" => "Receiving of document cancellation successful."
        )
    );
}

/**
 * Cancels the sending of a document.
 *
 * @param array $inputs Input data containing the necessary details for canceling the document sending.
 * @return void This function echoes JSON-encoded response indicating the success of the operation and any messages.
 */
function cancelSend($inputs)
{
    global $queries, $pdo; // Access global variables $queries and $pdo

    $valid = false; // Initialize variable to indicate if the operation was successful
    $results = []; // Initialize array to store results
    $requiredFields = ['CANCEL_S_NOTES']; // Define required input fields

    // Validate input fields
    if (!validateInputs($requiredFields, $inputs)) {
        echo json_encode(
            [
                'VALID' => $valid,
                'MESSAGE' => "Please Fill up notes"
            ]
        );
        exit;
    }

    // Check user privileges
    if ($_SESSION['DOTS_PRIV'] < 1) {
        echo json_encode(
            [
                'VALID' => $valid,
                'MESSAGE' => "Not enough privilege to perform this action",
            ]
        );
        exit;
    }

    $pdo->beginTransaction(); // Begin transaction

    // Get outbound document for deletion
    $selectReceiveData = [
        'TABLE' => 'DOTS_DOCUMENT_OUTBOUND',
        'WHERE' => [
            'AND' => [['ID' => $inputs['DATA']['CANCEL_S_ID']]]
        ]
    ];
    $selectReceiveRow = $queries->selectQuery($selectReceiveData)[0];

    // Get related inbound document
    $selectOutboundData = [
        'TABLE' => 'DOTS_DOCUMENT_INBOUND',
        'WHERE' => [
            'AND' => [['ID' => $selectReceiveRow['INBOUND_ID']]]
        ]
    ];
    $selectOutboundRow = $queries->selectQuery($selectOutboundData)[0];

    // Check if the document has been routed and received
    if ($selectOutboundRow['ACTION_ID'] == 2) {
        echo json_encode(
            [
                'VALID' => $valid,
                'MESSAGE' => "Sending cannot be canceled, Document Already Received by the other User"
            ]
        );
        exit;
    }

    // Update the inbound document to mark sending as canceled
    $deleteDocData = [
        'TABLE' => 'DOTS_DOCUMENT_INBOUND',
        'DATA' => ['ACTION_ID' => 5],
        'WHERE' => ['ID' => $selectReceiveRow['INBOUND_ID']]
    ];
    $deleteDocResult = $queries->updateQuery($deleteDocData);
    $results[] = !is_null($deleteDocResult);

    // Update the outbound document to remove sending data
    $updateReceiveData = [
        'TABLE' => 'DOTS_DOCUMENT_OUTBOUND',
        'DATA' => [
            'DATE_TIME_SEND' => "NULL",
            'R_DEPT_ID' => 0,
            'R_USER_ID' => 0,
            'PRPS_ID' => 0,
            'ROUTED' => 0,
            'ACTION_ID' => 2
        ],
        'WHERE' => ['ID' => $inputs['DATA']['CANCEL_S_ID']]
    ];
    $updateReceiveResult = $queries->updateQuery($updateReceiveData);
    $results[] = !is_null($updateReceiveResult);

    // Add cancellation action to logs
    $insertSCancelToLogsData = [
        'TABLE' => 'DOTS_TRACKING',
        'DATA' => [
            'DOC_NUM' => $selectReceiveRow["DOC_NUM"],
            'ROUTE_NUM' => $selectReceiveRow["ROUTE_NUM"],
            'ACTION_ID' => 5,
            'HRIS_ID' => $_SESSION['HRIS_ID'],
            'DATE_TIME_SERVER' => date("Y-m-d\TH:i"),
            'NOTE_USER' => $inputs['DATA']['CANCEL_S_NOTES'],
            'NOTE_SERVER' => "Sending Document canceled by sender",
        ]
    ];
    $insertSCancelToLogsResult = $queries->insertQuery($insertSCancelToLogsData);
    $results[] = !is_null($insertSCancelToLogsResult);

    // Check if all operations were successful
    $valid = checkArray($results);
    if ($valid) {
        $pdo->commit(); // Commit the transaction
        echo json_encode(
            [
                'VALID' => $valid,
                'MESSAGE' => "Sending has been canceled."
            ]
        );
    } else {
        $pdo->rollBack(); // Rollback the transaction
        echo json_encode(
            [
                'VALID' => $valid,
                'MESSAGE' => "SERVER ERROR"
            ]
        );
    }
}


/**
 * Retrieves options from a database table and formats them as key-value pairs.
 *
 * @param string $tableName The name of the table to retrieve options from.
 * @param string $columnName The name of the column containing the option values.
 * @return void This function echoes JSON-encoded response containing the retrieved options.
 */
function getOptions($tableName, $columnName)
{
    global $queries, $pdo; // Access global variables $queries and $pdo

    $valid = false; // Initialize variable to indicate if the operation was successful
    $data = [
        'TABLE' => $tableName,
        'COLUMNS' => ['ID', $columnName],
    ];

    // Retrieve options from the database
    $result = $queries->selectQuery($data);

    $formattedOptions = []; // Initialize array to store formatted options
    if ($result) { // If options are retrieved successfully
        $valid = true; // Set valid flag to true
        foreach ($result as $key => $value) { // Loop through retrieved options
            foreach ($value as $key2 => $value2) {
                $value3 = array_values($value); // Get array values
                $formattedOptions[$value3[0]] = $value3[1]; // Store option ID as key and option value as value
            }
        }
    }

    // Echo JSON-encoded response containing the retrieved options
    echo json_encode(
        [
            'VALID' => $valid,
            'RESULT' => $formattedOptions
        ]
    );
}

/**
 * Retrieves addressees from the database based on department ID.
 *
 * @param array $inputs The input data containing department ID.
 * @return void This function echoes JSON-encoded response containing the retrieved addressees.
 */
function getAddressee($inputs)
{
    global $queries, $pdo; // Access global variables $queries and $pdo

    $valid = false; // Initialize variable to indicate if the operation was successful
    $data = [
        'TABLE' => 'DOTS_ACCOUNT_INFO',
        'COLUMNS' => ['HRIS_ID', 'FULL_NAME'],
        'WHERE' => [
            'AND' => [
                ['DEPT_ID' => $inputs['DEPT_ID']] // Filter by department ID
            ],
        ]
    ];

    // Retrieve addressees from the database based on the provided department ID
    $result = $queries->selectQuery($data);

    $formattedOptions = []; // Initialize array to store formatted addressees
    if ($result) { // If addressees are retrieved successfully
        $valid = true; // Set valid flag to true
        foreach ($result as $key => $value) { // Loop through retrieved addressees
            foreach ($value as $key2 => $value2) {
                // $formattedOptions[$key] = $value; // Store addressee ID as key and addressee name as value
                $value3 = array_values($value); // Get array values
                $formattedOptions[$value3[0]] = $value3[1]; // Store HRIS ID as key and full name as value
            }
        }
    }

    // Echo JSON-encoded response containing the retrieved addressees
    echo json_encode(
        [
            'VALID' => $valid,
            'RESULT' => $formattedOptions
        ]
    );
}

/**
 * Handles sending of documents.
 *
 * @param array $inputs The input data containing document details.
 * @return void This function echoes JSON-encoded response indicating the success or failure of the operation.
 */
function sendDocForm($inputs)
{
    global $queries, $pdo; // Access global variables $queries and $pdo

    $valid = false; // Initialize variable to indicate if the operation was successful
    $newRoutingNumber = 0; // Initialize variable to store the new routing number
    $lastInboundId = 0; // Initialize variable to store the last inbound ID
    $results = []; // Initialize array to store operation results
    $r_user_id = 0; // Initialize variable to store receiver user ID

    $requiredFields = [ // Define required fields for sending documents
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

    // Validate if all required fields are provided in the input data
    if (!validateInputs($requiredFields, $inputs)) {
        echo json_encode([
            'VALID' => $valid,
            'MESSAGE' => "Please Fill up Required Fields"
        ]);
        exit;
    }

    // Check user privilege level
    if ($_SESSION['DOTS_PRIV'] < 3) {
        echo json_encode([
            'VALID' => $valid,
            'MESSAGE' => "Not enough privilege to perform this action",
        ]);
        exit;
    }

    $pdo->beginTransaction(); // Begin transaction

    // Set receiver user ID if provided in the input data
    if (isset ($inputs['DATA']['R_USER_ID'])) {
        $r_user_id = $inputs['DATA']['R_USER_ID'];
    }

    // Define data for inserting into DOTS_DOCUMENT_INBOUND table
    $insertInboundData = [
        'TABLE' => 'DOTS_DOCUMENT_INBOUND',
        'DATA' => $inputs['DATA'],
    ];

    // Define data for inserting into DOTS_DOCUMENT_OUTBOUND table
    $insertOutboundData = [
        'TABLE' => 'DOTS_DOCUMENT_OUTBOUND',
        'DATA' => $inputs['DATA'],
    ];

    // Check if the document is already routed
    $checkRoutedData = [
        'TABLE' => 'DOTS_DOCUMENT',
        'COLUMNS' => ['ID', 'DOC_NUM', 'ROUTE_NUM', 'ROUTED'],
        'WHERE' => [
            'AND' => [
                ['DOC_NUM' => $inputs['DATA']['DOC_NUM']],
                ['ROUTE_NUM' => $inputs['DATA']['ROUTE_NUM']],
            ]
        ],
    ];
    $checkRoutedRow = $queries->selectQuery($checkRoutedData)[0];

    // Define data for updating the document status to routed
    $updateDocumentData = [
        'TABLE' => 'DOTS_DOCUMENT',
        'DATA' => [
            'ROUTED' => 1, // Set to routed
            'DOC_STATUS' => 1, // Set on hand to pending
        ],
        'WHERE' => [
            'ID' => $checkRoutedRow['ID']
        ],
    ];

    // Retrieve receiver information based on the provided receiver user ID
    $selectReceiverData = [
        'TABLE' => 'DOTS_ACCOUNT_INFO',
        'WHERE' => [
            'AND' => [
                ['HRIS_ID' => $r_user_id],
            ]
        ],
    ];
    $selectReceiverRow = $queries->selectQuery($selectReceiverData)[0];

    // Retrieve department information based on the provided department ID
    $selectDeptData = [
        'TABLE' => 'DOTS_DOC_DEPT',
        'WHERE' => [
            'AND' => [
                ['ID' => $inputs['DATA']['R_DEPT_ID']],
            ]
        ],
    ];
    $selectDeptRow = $queries->selectQuery($selectDeptData)[0];

    // If the document is already routed
    if ($checkRoutedRow['ROUTED'] == 1) {
        // Retrieve the last document with the same document number and calculate the new routing number
        $selectDocumentData = [
            'TABLE' => 'DOTS_DOCUMENT',
            'WHERE' => [
                'AND' => [
                    ['DOC_NUM' => $checkRoutedRow['DOC_NUM']]
                ],
            ],
            'ORDER_BY' => 'ROUTE_NUM DESC'
        ];
        $selectDocumentRow = $queries->selectQuery($selectDocumentData)[0];
        unset($selectDocumentRow['ID']); // Remove the ID field

        $newRoutingNumber = intval($selectDocumentRow['ROUTE_NUM']) + 1;
        $selectDocumentRow['ROUTE_NUM'] = $newRoutingNumber;
        $selectDocumentRow['ROUTE_NUM'] = $newRoutingNumber;
        $insertInboundData['DATA']["ROUTE_NUM"] = $newRoutingNumber;
        $insertOutboundData['DATA']["ROUTE_NUM"] = $newRoutingNumber;

        // Insert the duplicated document record into the database
        $insertDocumentData = [
            'TABLE' => 'DOTS_DOCUMENT',
            'DATA' => $selectDocumentRow,
        ];
        $results[] = $queries->insertQuery($insertDocumentData);

        // Log the duplication action
        $insertDocumentLogData = [
            'TABLE' => 'DOTS_TRACKING',
            'DATA' => [
                'HRIS_ID' => $_SESSION['HRIS_ID'],
                'DOC_NUM' => $checkRoutedRow['DOC_NUM'],
                'ROUTE_NUM' => $newRoutingNumber,
                'ACTION_ID' => 4, // Duplicate action_id
                'DATE_TIME_SERVER' => date("Y-m-d\TH:i"),
                'DATE_TIME_ACTION' => $inputs['DATA']['DATE_TIME_SEND'],
                'NOTE_SERVER' => 'Document already routed, Document has been duplicated',
            ]
        ];

        // Include user notes if provided
        if (isset ($inputs['DATA']['DOC_NOTES'])) {
            $insertDocumentLogData['DATA']['NOTE_USER'] = $inputs['DATA']['DOC_NOTES'];
        }
        $results[] = $queries->insertQuery($insertDocumentLogData);

    } elseif ($checkRoutedRow['ROUTED'] == 0) { // If the document is not yet routed
        // Update the document status to routed
        $results[] = $queries->updateQuery($updateDocumentData);
    }

    // Insert the document details into DOTS_DOCUMENT_INBOUND table
    $lastInboundId = $queries->insertQuery($insertInboundData);
    $results[] = $lastInboundId;

    // Format the document number
    $formattedDocumentNumber = formatDocumentNumber($checkRoutedRow['DOC_NUM'], $newRoutingNumber);
    $note_server = "Document $formattedDocumentNumber sent to ";

    // Include receiver department and user information in the server note
    if (!is_null($selectReceiverRow)) {
        $note_server .= "$selectDeptRow[DOC_DEPT]-$selectReceiverRow[FULL_NAME]";
    } else {
        $note_server .= "$selectDeptRow[DOC_DEPT]";
    }

    // Insert the document sending action log into DOTS_TRACKING table
    $insertInboundLogData = [
        'TABLE' => 'DOTS_TRACKING',
        'DATA' => [
            'HRIS_ID' => $_SESSION['HRIS_ID'],
            'DOC_NUM' => $checkRoutedRow['DOC_NUM'],
            'ROUTE_NUM' => $newRoutingNumber,
            'ACTION_ID' => 1, // Sent action_id
            'DATE_TIME_SERVER' => date("Y-m-d\TH:i"),
            'DATE_TIME_ACTION' => $inputs['DATA']['DATE_TIME_SEND'],
            'NOTE_SERVER' => $note_server,
        ]
    ];

    // Include user notes if provided
    if (isset ($inputs['DATA']['DOC_NOTES'])) {
        $insertInboundLogData['DATA']['NOTE_USER'] = $inputs['DATA']['DOC_NOTES'];
    }

    // Insert the outbound document details into DOTS_DOCUMENT_OUTBOUND table
    $insertOutboundData['DATA']['INBOUND_ID'] = $lastInboundId;
    $results[] = $queries->insertQuery($insertOutboundData);

    // Insert the inbound log data
    $results[] = $queries->insertQuery($insertInboundLogData);

    // Check if all operations were successful
    $valid = checkArray($results);
    if ($valid) { // If all operations were successful
        $pdo->commit(); // Commit the transaction
        echo json_encode([
            'VALID' => $valid,
            'MESSAGE' => $note_server,
        ]);
    } else { // If any operation failed
        $pdo->rollBack(); // Rollback the transaction
        echo json_encode([
            'VALID' => $valid,
            'MESSAGE' => "SERVER ERROR",
        ]);
    }
}



/**
 * Receive document function
 *
 * @param array $inputs An array containing the input data for receiving the document
 *                      Required fields: ACTION_ID, DATE_TIME_RECEIVED, LETTER_DATE, DOC_TYPE_ID, S_OFFICE_ID,
 *                      DOC_SUBJECT, DOC_STATUS, R_USER_ID, R_DEPT_ID, DOC_SUBJECT
 * @return void Outputs a JSON response indicating the success or failure of the operation
 */
function receiveDoc($inputs)
{
    global $queries, $pdo;

    $valid = false;
    $results = [];

    // Required fields for receiving document
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

    // Validate required fields
    if (!validateInputs($requiredFields, $inputs)) {
        echo json_encode([
            'VALID' => $valid,
            'MESSAGE' => "Please ensure all required fields are filled out."
        ]);
        exit;
    }

    // Check privilege level
    if ($_SESSION['DOTS_PRIV'] < 2) {
        echo json_encode([
            'VALID' => $valid,
            'MESSAGE' => "Not enough privilege to perform this action",
        ]);
        exit;
    }

    $pdo->beginTransaction(); // Start transaction

    // Insert document data
    $insertDocumentData = [
        'TABLE' => 'DOTS_DOCUMENT',
        'DATA' => $inputs['DATA'],
    ];
    $lastId = $queries->insertQuery($insertDocumentData)[0];
    $results[] = $lastId; // Id of the last inserted row

    // Get doc_num, route_num, and actionid
    $selectDocumentData = [
        'TABLE' => 'DOTS_DOCUMENT',
        'WHERE' => [
            'AND' => [
                ['ID' => $lastId]
            ]
        ]
    ];
    $selectDocumentRow = $queries->selectQuery($selectDocumentData)[0];

    // Add log for creating/receiving doc
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
    $results[] = $queries->insertQuery($insertLogData);

    // Format document number
    $formattedDocumentNumber = formatDocumentNumber($selectDocumentRow['DOC_NUM'], $selectDocumentRow['ROUTE_NUM']);
    $formattedMessage = "";

    // Set formatted message based on action_id
    if ($inputs['DATA']['ACTION_ID'] == 2) {
        $formattedMessage = "Document $formattedDocumentNumber Received";
    }
    if ($inputs['DATA']['ACTION_ID'] == 3) {
        $formattedMessage = "Document $formattedDocumentNumber Created";
    }

    // Check if all operations were successful
    $valid = checkArray($results);
    if ($valid) {
        $pdo->commit(); // Commit the transaction
        echo json_encode([
            'VALID' => $valid,
            'MESSAGE' => $formattedMessage,
        ]);
    } else {
        $pdo->rollBack(); // Rollback the transaction
        echo json_encode([
            'VALID' => $valid,
            'MESSAGE' => "SERVER ERROR",
        ]);
    }
}

/**
 * Get main table data for display
 *
 * @param array $inputs An array containing input data, particularly the year for filtering
 * @return void Outputs HTML table data after fetching and formatting from the database
 */
function getTableMain($inputs)
{
    global $queries, $pdo;

    // Get document year from inputs
    $year = getDocYear($inputs['YEAR']);

    // Define table name
    $tableName = 'DOTS_DOCUMENT';

    // Define data query
    $data = [
        'TABLE' => 'DOTS_DOCUMENT',
        'COLUMNS' => [
            'DOTS_DOCUMENT.ID',

            // Format document number with or without route number
            "CASE WHEN ROUTE_NUM = 0 THEN DOTS_DOCUMENT.DOC_NUM 
             ELSE CONCAT(DOTS_DOCUMENT.DOC_NUM,'-',ROUTE_NUM) 
             END AS `No.`",

            'DOC_NUM',
            'ROUTE_NUM',
            'DOC_SUBJECT as `Subject`',
            'DOC_TYPE `Type`',
            'LETTER_DATE `Letter Date`',

            // Concatenate sender information
            "CONCAT(
             IF(S_OFFICE.DOC_OFFICE IS NOT NULL,CONCAT(S_OFFICE.DOC_OFFICE,'-'), ' '),' ', 
             IF(S_DEPT.DOC_DEPT IS NOT NULL,CONCAT(S_DEPT.DOC_DEPT,'-'), ' '), 
             IFNULL(S_FULL_NAME.FULL_NAME, ' ')) as 'Sent By'",

            // Concatenate receiver information
            "CONCAT(
            IF(R_OFFICE.DOC_OFFICE IS NOT NULL,CONCAT(R_OFFICE.DOC_OFFICE,'-'), ' '),' ',
            IF(R_DEPT.DOC_DEPT IS NOT NULL,CONCAT(R_DEPT.DOC_DEPT,'-'), ' '), 
            IFNULL(R_FULL_NAME.FULL_NAME, ' ')) as 'Received By'",

            'DATE_TIME_RECEIVED `Date Received`',
            'DOTS_DOC_STATUS.DOC_STATUS `Status`',
            'DOTS_DOC_ACTION.DOC_ACTION `Action`'
        ],
        'JOIN' => [
            // Left join with document type table
            [
                'table' => 'DOTS_DOC_TYPE',
                'ON' => ['DOTS_DOCUMENT.DOC_TYPE_ID = DOTS_DOC_TYPE.ID'],
                'TYPE' => 'LEFT'
            ],
            // Left join with sender office table
            [
                'table' => 'DOTS_DOC_OFFICE S_OFFICE',
                'ON' => ['DOTS_DOCUMENT.S_OFFICE_ID = S_OFFICE.ID'],
                'TYPE' => 'LEFT'
            ],
            // Left join with sender department table
            [
                'table' => 'DOTS_DOC_DEPT S_DEPT',
                'ON' => ['DOTS_DOCUMENT.S_DEPT_ID = S_DEPT.ID'],
                'TYPE' => 'LEFT'
            ],
            // Left join with sender account info table
            [
                'table' => 'DOTS_ACCOUNT_INFO S_FULL_NAME',
                'ON' => ['DOTS_DOCUMENT.S_USER_ID = S_FULL_NAME.HRIS_ID'],
                'TYPE' => 'LEFT'
            ],
            // Left join with receiver office table
            [
                'table' => 'DOTS_DOC_OFFICE R_OFFICE',
                'ON' => ['DOTS_DOCUMENT.R_OFFICE_ID = R_OFFICE.ID'],
                'TYPE' => 'LEFT'
            ],
            // Left join with receiver department table
            [
                'table' => 'DOTS_DOC_DEPT R_DEPT',
                'ON' => ['DOTS_DOCUMENT.R_DEPT_ID = R_DEPT.ID'],
                'TYPE' => 'LEFT'
            ],
            // Left join with receiver account info table
            [
                'table' => 'DOTS_ACCOUNT_INFO R_FULL_NAME',
                'ON' => ['DOTS_DOCUMENT.R_USER_ID = R_FULL_NAME.HRIS_ID'],
                'TYPE' => 'LEFT'
            ],
            // Left join with document status table
            [
                'table' => 'DOTS_DOC_STATUS',
                'ON' => ['DOTS_DOCUMENT.DOC_STATUS = DOTS_DOC_STATUS.ID'],
                'TYPE' => 'LEFT'
            ],
            // Left join with document action table
            [
                'table' => 'DOTS_DOC_ACTION',
                'ON' => ['DOTS_DOCUMENT.ACTION_ID = DOTS_DOC_ACTION.ID'],
                'TYPE' => 'LEFT'
            ],
        ],
        'WHERE' => [
            'AND' => [
                ['YEAR(DOTS_DOCUMENT.LETTER_DATE)' => $year] // Filter by year
            ]
        ],
        'ORDER_BY' => 'DOTS_DOCUMENT.DOC_NUM DESC'
    ];

    // Execute query
    $result = $queries->selectQuery($data);

    // Define action buttons
    $buttons = [
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
    ];

    // Set up table with result data and action buttons
    setupTable($result, $buttons, $tableName);
}


/**
 * Retrieve table data for display based on the user's role and the specified table name.
 * This function constructs a query to fetch data from the specified table and formats it into an HTML table.
 *
 * @param array $inputs An array of inputs containing filtering criteria, particularly the year.
 * @param string $tableName The name of the table for which data is to be retrieved.
 * @return void The function echoes the formatted HTML table.
 */
function getTableUser($inputs, $tableName)
{
    global $queries, $pdo;

    // Initialize variables
    $buttons = [];
    $WHERE = [];
    $year = getDocYear($inputs['YEAR']);

    // Determine the appropriate WHERE clause and action buttons based on the table name
    if ($tableName == "DOTS_DOCUMENT_INBOUND") {
        // Construct WHERE clause for inbound documents
        $WHERE[] = [
            "AND" => array(
                array("$tableName.R_DEPT_ID" => $_SESSION["DEPT_ID"]),
                array("YEAR(DOTS_DOCUMENT.LETTER_DATE)" => $year),
            ),
            "OR" => array(
                array("$tableName.R_USER_ID" => $_SESSION["HRIS_ID"]),
                array("$tableName.R_USER_ID" => '0'),
            ),
        ];
        // Define action buttons for inbound documents
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
        // Construct WHERE clause for outbound documents
        $WHERE[] = [
            "AND" => array(
                array("$tableName.S_DEPT_ID" => $_SESSION["DEPT_ID"]),
                array("YEAR(DOTS_DOCUMENT.LETTER_DATE)" => $year),
            ),
            "OR" => array(
                array("$tableName.S_USER_ID" => $_SESSION["HRIS_ID"]),
                array("$tableName.S_USER_ID" => '0'),
            ),
        ];
        // Define action buttons for outbound documents
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
    // Define the query data
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

        // Define table joins
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
    // Apply WHERE clause
    $data['WHERE'] = $WHERE[0];

    // Execute the query
    $result = $queries->selectQuery($data);

    // Add additional action button for each row
    $buttons[] = [
        'className' => 'btnT',
        'label' => 'T'
    ];
    
    // Render the HTML table with the retrieved data and action buttons
    setupTable($result, $buttons, $tableName);
}

/**
 * Setup the HTML table with formatted result data and action buttons.
 * This function formats the result data and action buttons into JSON format for rendering.
 *
 * @param array $result The result data retrieved from the database.
 * @param array $buttons The action buttons to be displayed in each row of the table.
 * @param string $tableName The name of the table for context.
 * @return void The function echoes the formatted JSON response.
 */
function setupTable($result, $buttons, $tableName)
{
    $valid = false;
    $formattedResult = [];

    // Format the result data
    if ($result != "") {
        foreach ($result as $row) {
            $formattedRow = [];
            foreach ($row as $key => $value) {
                $fValue = $value;

                // Perform formatting based on column keys
                switch ($key) {
                    case "Date Received":
                    case "Date Sent":
                    case "Date of Server":
                        if ($fValue != null && $fValue != '0000-00-00 00:00:00') {
                            $fValue = formatDateTime($value);
                        } else {
                            $fValue = '';
                        }
                        break;
                    case "Letter Date":
                        $fValue = formatDate($value);
                        break;
                    case "Date of Action":
                        $fValue = formatDateTime($value);
                        break;
                    // Add additional cases for specific columns if needed
                }

                $formattedRow[$key] = $fValue;
            }
            $formattedResult[] = $formattedRow;
        }
        $valid = true;
    }

    // Echo the formatted JSON response
    echo json_encode(
        array(
            'VALID' => $valid,
            'RESULT' => $formattedResult,
            'BUTTONS' => $buttons
        )
    );
}

/**
 * Process the action of receiving a document by a user.
 * This function updates the document status to received, logs the action, and inserts an outbound document entry.
 *
 * @param array $inputs The input data containing information about the received document.
 * @return void The function echoes a JSON response indicating the success or failure of the operation.
 */
function receiveDocUser($inputs)
{
    global $queries, $pdo;

    $valid = false;
    $results = [];

    // Prepare data for updating inbound document
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

    // Prepare data for inserting outbound document
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

    // Select the inbound document and check if it has already been received
    $selectInboundData = [
        'TABLE' => 'DOTS_DOCUMENT_INBOUND',
        'WHERE' => [
            'AND' => [
                ['ID' => $inputs['DATA']['ID']]
            ]
        ]
    ];
    $selectInboundRow = $queries->selectQuery($selectInboundData)[0];

    // Check if the document has already been received
    if ($selectInboundRow['ACTION_ID'] == 2) {
        echo json_encode(
            [
                'VALID' => $valid,
                'MESSAGE' => "Document Already Received",
            ]
        );
        exit;
    }

    // Check user privileges
    if ($_SESSION['DOTS_PRIV'] < 2) {
        echo json_encode(
            array(
                'VALID' => $valid,
                'MESSAGE' => "Not enough privilege to perform this action",
            )
        );
        exit;
    }

    // Begin database transaction
    $pdo->beginTransaction();

    // Add log for document received by the user
    $insertLogData = [
        'TABLE' => 'DOTS_TRACKING',
        'DATA' => [
            'DOC_NUM' => $inputs['DATA']["DOC_NUM"],
            'ROUTE_NUM' => $inputs['DATA']["ROUTE_NUM"],
            'ACTION_ID' => 2, // ACTION_ID RECEIVE
            'HRIS_ID' => $_SESSION['HRIS_ID'],
            'DATE_TIME_ACTION' => $inputs['DATA']['DATE_TIME_RECEIVED'],
            'DATE_TIME_SERVER' => date("Y-m-d\TH:i"),
            'NOTE_SERVER' => "Document Received by the user",
        ]
    ];

    $results[] = $queries->insertQuery($insertLogData);
    $lastId = $queries->insertQuery($insertData);
    $results[] = $lastId;

    // Update inbound document with outbound_id
    $updateData['DATA']['OUTBOUND_ID'] = $lastId;
    $results[] = $queries->updateQuery($updateData);

    // Check if the operation was successful
    $valid = checkArray($results);

    // Commit or rollback the transaction based on validity
    if ($valid) {
        $pdo->commit();
        $formattedDocumentNumber = formatDocumentNumber($inputs['DATA']["DOC_NUM"], $inputs['DATA']["ROUTE_NUM"]);
        echo json_encode(
            array(
                'VALID' => $valid,
                'MESSAGE' => "Document $formattedDocumentNumber Received",
            )
        );
    } else {
        $pdo->rollBack();
        echo json_encode(
            array(
                'VALID' => $valid,
                'MESSAGE' => "SERVER ERROR",
            )
        );
    }
}

/**
 * Process and send document form from user
 *
 * @param array $inputs An associative array containing the input data
 *                      Structure: [
 *                          'DATA' => [
 *                              'DOC_NUM' => string, // Document number
 *                              'ROUTE_NUM' => int, // Route number
 *                              'DATE_TIME_SEND' => string, // Date and time of sending
 *                              'PRPS_ID' => int, // Purpose ID
 *                              'R_DEPT_ID' => int, // Receiving department ID
 *                              'DOC_NOTES' => string, // Document notes
 *                              'ID' => int, // ID
 *                              'ACTION_ID' => string, // Action ID
 *                              'S_DEPT_ID' => int, // Sending department ID
 *                              'S_USER_ID' => int, // Sending user ID
 *                              'R_USER_ID' => int|null, // Receiving user ID (optional)
 *                          ]
 *                      ]
 *
 * @return void Outputs JSON response containing validation result and message
 */
function sendDocFormUser($inputs)
{
    global $queries, $pdo;

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

    // Validate required fields
    if (!validateInputs($requiredFields, $inputs)) {
        echo json_encode(
            [
                'VALID' => $valid,
                'MESSAGE' => "Please Fill up Required Fields"
            ]
        );
        exit;
    }

    // Check user privilege
    if ($_SESSION['DOTS_PRIV'] < 2) {
        echo json_encode(
            array(
                'VALID' => $valid,
                'MESSAGE' => "Not enough privilege to perform this action",
            )
        );
        exit;
    }

    $pdo->beginTransaction();

    // Update outbound data
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

    // Insert inbound data
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

    // Select outbound data
    $selectOutboundData = [
        'TABLE' => 'DOTS_DOCUMENT_OUTBOUND',
        'WHERE' => array(
            'AND' => array(
                array('ID' => $inputs['DATA']['ID']),
            ),
        ),
    ];
    $selectOutboundRow = $queries->selectQuery($selectOutboundData)[0];

    // Select receiver data
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

    $selectReceiverRow = $queries->selectQuery($selectReceiverData)[0];

    if ($selectOutboundRow['ROUTED'] == 1) {
        // Select main data
        $selectMainData = [
            'TABLE' => 'DOTS_DOCUMENT',
            'WHERE' => array(
                'AND' => array(
                    array('DOC_NUM' => $selectOutboundRow["DOC_NUM"]),
                ),
            ),
            'ORDER_BY' => 'ROUTE_NUM DESC'
        ];
        $selectMainRow = $queries->selectQuery($selectMainData)[0];

        // Calculate new route number
        $newRouteNumber = intval($selectMainRow['ROUTE_NUM']) + 1;
        $insertInboundData['DATA']['ROUTE_NUM'] = $newRouteNumber;
        $selectMainRow['ROUTE_NUM'] = $newRouteNumber;

        // Insert inbound data and retrieve last ID
        $last_id = $queries->insertQuery($insertInboundData);
        $results = $last_id;

        // Insert main data
        unset($selectMainRow['ID']);
        $insertMainData = [
            'TABLE' => 'DOTS_DOCUMENT',
            'DATA' => $selectMainRow,
        ];
        $results[] = $queries->insertQuery($insertMainData);

        // Insert log for duplicating document
        $insertMainLogData = [
            'TABLE' => 'DOTS_TRACKING',
            'DATA' => [
                'DOC_NUM' => $insertMainData['DATA']["DOC_NUM"],
                'ROUTE_NUM' => $insertMainData['DATA']["ROUTE_NUM"],
                'ACTION_ID' => 4, // ACTION_ID DUPLICATE
                'HRIS_ID' => $_SESSION['HRIS_ID'],
                'NOTE_USER' => $inputs['DATA']['DOC_NOTES'],
                'NOTE_SERVER' => "Document already routed, Document has been duplicated",
                'DATE_TIME_ACTION' => $inputs['DATA']['DATE_TIME_SEND'],
                'DATE_TIME_SERVER' => date("Y-m-d\TH:i"),
            ],
        ];
        $results[] = $queries->insertQuery($insertMainLogData);

        // Update outbound row
        $selectOutboundRow['ROUTE_NUM'] = $newRouteNumber;
        unset($selectOutboundRow['ID']);
        $insertOutboundData = [
            'TABLE' => 'DOTS_DOCUMENT_OUTBOUND',
            'DATA' => $selectOutboundRow
        ];
        $insertOutboundData["DATA"]['DATE_TIME_SEND'] = $inputs['DATA']['DATE_TIME_SEND'];
        $insertOutboundData['DATA']["INBOUND_ID"] = $last_id;

        $results[] = $queries->insertQuery($insertOutboundData);

    } else if ($selectOutboundRow['ROUTED'] == 0) {
        // Insert inbound data if outbound is not routed
        $last_id = $queries->insertQuery($insertInboundData);
        $results[] = $last_id;

        // Update outbound data with inbound ID
        $updateOutboundData['DATA']['INBOUND_ID'] = $last_id;
        $results[] = $queries->updateQuery($updateOutboundData);
    }

    // Select receiver data
    $selectReceiverData = [
        'TABLE' => 'DOTS_ACCOUNT_INFO',
        'WHERE' => [
            'AND' => [
                ['HRIS_ID' => $r_user_id],
            ]
        ],
    ];
    $selectReceiverRow = $queries->selectQuery($selectReceiverData)[0];

    // Select department data
    $selectDeptData = [
        'TABLE' => 'DOTS_DOC_DEPT',
        'WHERE' => [
            'AND' => [
                ['ID' => $inputs['DATA']['R_DEPT_ID']],
            ]
        ],
    ];
    $selectDeptRow = $queries->selectQuery($selectDeptData)[0];

    // Format document number
    $formattedDocumentNumber = formatDocumentNumber($selectOutboundRow['DOC_NUM'], $newRouteNumber);
    $note_server = "Document $formattedDocumentNumber sent to ";
    if (!is_null($selectReceiverRow)) {
        $note_server .= "$selectDeptRow[DOC_DEPT]-$selectReceiverRow[FULL_NAME]";
    } else {
        $note_server .= "$selectDeptRow[DOC_DEPT]";
    }

    // Insert main log data
    $insertMainLogData = [
        'TABLE' => 'DOTS_TRACKING',
        'DATA' => [
            'DOC_NUM' => $selectOutboundRow["DOC_NUM"],
            'ROUTE_NUM' => $selectOutboundRow["ROUTE_NUM"],
            'ACTION_ID' => 1, // ACTION_ID SEND
            'HRIS_ID' => $_SESSION['HRIS_ID'],
            'NOTE_USER' => $inputs['DATA']['DOC_NOTES'],
            'NOTE_SERVER' => $note_server,
            'DATE_TIME_ACTION' => $inputs['DATA']['DATE_TIME_SEND'],
            'DATE_TIME_SERVER' => date("Y-m-d\TH:i"),
        ],
    ];
    $results[] = $queries->insertQuery($insertMainLogData);

    // Check if all operations were successful
    $valid = checkArray($results);
    if ($valid) {
        $pdo->commit();
        echo json_encode(
            array(
                'VALID' => $valid,
                'MESSAGE' => $note_server,
            )
        );
    } else {
        $pdo->rollBack();
        echo json_encode(
            array(
                'VALID' => $valid,
                'MESSAGE' => "SERVER ERROR",
            )
        );
    }
}

/**
 * Retrieves tracking information from the database table.
 *
 * @param array $inputs An array containing input data.
 *                      Required keys: 'DOC_NUM', 'ROUTE_NUM'.
 * @return void This function echoes JSON-encoded tracking information or an error message.
 */
function getTableTracking($inputs)
{
    global $queries, $pdo;

    // Check user privileges
    if ($_SESSION['DOTS_PRIV'] < 1) {
        echo json_encode(
            array(
                'VALID' => false,
                'MESSAGE' => "Not enough privilege to perform this action",
            )
        );
        exit;
    }

    // Define the select query to retrieve tracking information
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

    // Execute the select query
    $selectTableResult = $queries->selectQuery($selectTableData);

    // Echo the tracking information or an error message
    setupTable($selectTableResult, [], 'DOTS_TRACKING');
}

/**
 * Retrieves attachment information from the database table.
 *
 * @param array $inputs An array containing input data.
 *                      Required key: 'ID'.
 * @return void This function echoes JSON-encoded attachment information or an error message.
 */
function getTableAttachment($inputs)
{
    global $queries, $pdo;

    // Check user privileges
    if ($_SESSION['DOTS_PRIV'] < 2) {
        echo json_encode(
            array(
                'VALID' => false,
                'MESSAGE' => "Not enough privilege to perform this action",
            )
        );
        exit;
    }

    // Retrieve document information
    $selectDocumentData = [
        'TABLE' => 'DOTS_DOCUMENT',
        'WHERE' => [
            'AND' => [
                ["ID" => $inputs['DATA']['ID']]
            ]
        ]
    ];
    $selectDocumentRow = $queries->selectQuery($selectDocumentData)[0];

    // Define the table name for attachments
    $tableName = 'DOTS_ATTACHMENTS';

    // Define the query to retrieve attachment information
    $data = [
        'TABLE' => $tableName,
        'WHERE' => [
            'AND' => [
                ['DOC_NUM' => $selectDocumentRow['DOC_NUM']],
                ['ROUTE_NUM' => $selectDocumentRow['ROUTE_NUM']],
            ]
        ]
    ];

    // Restrict access based on user privileges
    if ($_SESSION['DOTS_PRIV'] < 3) {
        $data['WHERE']['AND'][] = ['HRIS_ID' => $_SESSION['HRIS_ID']];
    }

    // Execute the query to retrieve attachment information
    $result = $queries->selectQuery($data);

    // Echo the attachment information or an error message
    setupTable($result, [], $tableName);
}

/**
 * Formats a date and time string into a custom format.
 *
 * @param string $dateString The input date and time string.
 * @return string The formatted date and time string.
 */
function formatDateTime($dateString)
{
    // Create a DateTime object from the input string
    $date = new DateTime($dateString);

    // Extract hours, minutes, and AM/PM from the DateTime object
    $hours = $date->format('H');
    $ampm = $hours >= 12 ? 'pm' : 'am';
    $hours = $hours % 12;
    $minutes = $date->format('i');

    // Construct the time string in HH:MM AM/PM format
    $strTime = $hours . ':' . $minutes . ' ' . $ampm;

    // Format the date string to 'D, m/j/Y' format
    // and concatenate it with the time string
    return $date->format('D, m/j/Y') . "  " . $strTime;
}


/**
 * Formats a date string into 'n/j/Y' format.
 *
 * @param string $dateString The input date string.
 * @return string The formatted date string.
 */
function formatDate($dateString)
{
    $date = new DateTime($dateString);
    return ($date->format('n')) . "/" . $date->format('j') . "/" . $date->format('Y');
}

/**
 * Converts results into an array.
 *
 * @param mixed $results The results to convert into an array.
 * @return array The converted array of results.
 */
function resultsToArray($results)
{
    $rows = [];
    while ($row = $results) {
        $rows[] = $row;
    }
    return $rows;
}

/**
 * Gets a value from an array of items based on the provided ID and column name.
 *
 * @param int $id The ID to search for.
 * @param array $array The array of items to search within.
 * @param string $columnName The column name from which to retrieve the value.
 * @return mixed The value corresponding to the provided ID and column name.
 */
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

/**
 * Formats a document number based on the document number and route number.
 *
 * @param string $doc_num The document number.
 * @param int $route_num The route number.
 * @return string The formatted document number.
 */
function formatDocumentNumber($doc_num, $route_num)
{
    $formattedDocumentNumber = "$doc_num-$route_num";
    if ($route_num == 0) {
        $formattedDocumentNumber = "$doc_num";
    }
    return $formattedDocumentNumber;
}

/**
 * Checks if all elements in an array are true.
 *
 * @param array $array The array to check.
 * @return bool True if all elements are true, false otherwise.
 */
function checkArray($array)
{
    return !in_array(false, $array, true);
}

/**
 * Validates inputs against a set of required fields.
 *
 * @param array $requiredFields The list of required fields.
 * @param array $inputs The inputs to validate.
 * @return bool True if all required fields are present and not empty, false otherwise.
 */
function validateInputs($requiredFields, $inputs)
{
    foreach ($requiredFields as $field) {
        if (!isset ($inputs['DATA'][$field]) || $inputs['DATA'][$field] == "") {
            return false;
        }
    }
    return true;
}

/**
 * Validates inputs against a set of required fields for editing.
 *
 * @param array $requiredFields The list of required fields.
 * @param array $inputs The inputs to validate.
 * @return bool True if all required fields for editing are present and not empty, false otherwise.
 */
function validateInputsEdit($requiredFields, $inputs)
{
    foreach ($requiredFields as $field => $val) {
        if (!isset ($inputs['DATA'][$field]) || $inputs['DATA'][$field] == "") {
            return false;
        }
    }
    return true;
}



/**
 * Returns the file location of an attachment with the given ID.
 *
 * @param int $id The ID of the attachment.
 */
function returnFileLocation($id)
{
    global $queries, $pdo;

    // Select attachment data from the database
    $selectAttachmentData = [
        'TABLE' => 'DOTS_ATTACHMENTS',
        'WHERE' => [
            'AND' => [
                ['ID' => $id]
            ]
        ]
    ];
    $selectAttachmentRow = $queries->selectQuery($selectAttachmentData)[0];

    // Retrieve FTP server information from configuration
    $config = parse_ini_file('config.ini', true);
    $uploadDirectory = $config['ftp_credentials']['ftp_server'];

    // Construct target file path
    $targetDir = "$uploadDirectory/$selectAttachmentRow[DOC_NUM]/$selectAttachmentRow[ROUTE_NUM]";
    $targetFile = "$targetDir/$selectAttachmentRow[DESCRIPTION].pdf";

    // Open the PDF file
    $fileHandle = fopen($targetFile, 'rb'); // 'rb' for reading binary mode
    $pdfContent = file_get_contents($targetFile);

    // Check if file opened successfully
    if ($fileHandle === false) {
        // If failed to open, return error message
        echo json_encode([
            'VALID' => false,
            'MESSAGE' => "Failed to open the PDF file."
        ]);
    } else {
        // Specify the directory where you want to store the temporary file on the server
        $tempDirectory = '../attachment_temp';

        // Create the temporary directory if it doesn't exist
        if (!file_exists($tempDirectory)) {
            mkdir($tempDirectory, 0777, true);
        }

        // Create a temporary file in the specified directory
        $tmpFilePath = tempnam($tempDirectory, 'pdf_');
        $tmpFileName = basename($tmpFilePath);

        // Write the PDF content to the temporary file
        file_put_contents($tmpFilePath, $pdfContent);


        // Return the file location
        echo json_encode([
            'VALID' => true,
            'RESULT' => $tempDirectory . '/' . $tmpFileName
        ]);
    }

    // Close the file handle
    fclose($fileHandle);

}

/**
 * Retrieves information about a document with the given ID.
 *
 * @param int $id The ID of the document.
 */
function getTableRow($id)
{
    global $queries, $pdo;

    // Define the data array for the document query
    $data = [
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
            [
                'table' => 'DOTS_DOC_TYPE',
                'ON' => ['DOTS_DOCUMENT.DOC_TYPE_ID = DOTS_DOC_TYPE.ID'],
                'TYPE' => 'LEFT'
            ],
            [
                'table' => 'DOTS_DOC_OFFICE S_OFFICE',
                'ON' => ['DOTS_DOCUMENT.S_OFFICE_ID = S_OFFICE.ID'],
                'TYPE' => 'LEFT'
            ],
            [
                'table' => 'DOTS_DOC_DEPT S_DEPT',
                'ON' => ['DOTS_DOCUMENT.S_DEPT_ID = S_DEPT.ID'],
                'TYPE' => 'LEFT'
            ],
            [
                'table' => 'DOTS_ACCOUNT_INFO S_FULL_NAME',
                'ON' => ['DOTS_DOCUMENT.S_USER_ID = S_FULL_NAME.HRIS_ID'],
                'TYPE' => 'LEFT'
            ],
            [
                'table' => 'DOTS_DOC_OFFICE R_OFFICE',
                'ON' => ['DOTS_DOCUMENT.R_OFFICE_ID = R_OFFICE.ID'],
                'TYPE' => 'LEFT'
            ],
            [
                'table' => 'DOTS_DOC_DEPT R_DEPT',
                'ON' => ['DOTS_DOCUMENT.R_DEPT_ID = R_DEPT.ID'],
                'TYPE' => 'LEFT'
            ],
            [
                'table' => 'DOTS_ACCOUNT_INFO R_FULL_NAME',
                'ON' => ['DOTS_DOCUMENT.R_USER_ID = R_FULL_NAME.HRIS_ID'],
                'TYPE' => 'LEFT'
            ],
            [
                'table' => 'DOTS_DOC_STATUS',
                'ON' => ['DOTS_DOCUMENT.DOC_STATUS = DOTS_DOC_STATUS.ID'],
                'TYPE' => 'LEFT'
            ],
            [
                'table' => 'DOTS_DOC_ACTION',
                'ON' => ['DOTS_DOCUMENT.ACTION_ID = DOTS_DOC_ACTION.ID'],
                'TYPE' => 'LEFT'
            ],
        ],
        'WHERE' => [
            'AND' => [
                ['DOTS_DOCUMENT.ID' => $id]
            ]
        ]
    ];

    // Select purpose data
    $selectPrpsData = [
        'TABLE' => 'DOTS_DOC_PRPS'
    ];
    $selectPrpsResults = $queries->selectQuery($selectPrpsData);

    // Select document row
    $selectDocumentRow = $queries->selectQuery($data)[0];

    // Format date and time
    $selectDocumentRow['Date Received'] = formatDateTime($selectDocumentRow['Date Received']);
    $selectDocumentRow['Letter Date'] = formatDate($selectDocumentRow['Letter Date']);

    // Encode the result in JSON format
    echo json_encode([
        'DOC' => $selectDocumentRow,
        'PRPS' => $selectPrpsResults
    ]);
}


/**
 * Retrieves the year associated with the given year ID.
 *
 * @param int $yearID The ID of the year.
 * @return int|string The year associated with the given ID.
 */
function getDocYear($yearID)
{
    global $queries, $pdo;

    // Define the query to fetch year data
    $yearData = [
        'TABLE' => "DOTS_FILTER_YEAR",
        'WHERE' => [
            'AND' => [
                ['ID' => $yearID],
            ],
        ],
    ];

    // Execute the query to retrieve year data
    $yearResult = $queries->selectQuery($yearData)[0];

    // Return the year associated with the given ID
    return $yearResult['YEAR'];
}

?>