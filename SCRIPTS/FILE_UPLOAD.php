<?php
// Start or resume session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include necessary files
include './Queries.php';
include './DB_Connect.php';

// Initialize Queries object
$queries = new Queries($pdo);

// Handle file upload if it's a POST request and ATTACH_FILE is set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['ATTACH_FILE'])) {
    // Check user privilege
    if ($_SESSION['DOTS_PRIV'] < 2) {
        echo json_encode(
            array(
                'VALID' => false,
                'MESSAGE' => "Not enough privilege to perform this action",
            )
        );
        exit;
    }

    // Check if the uploaded file is empty
    if ($_FILES['ATTACH_FILE']['size'] == 0) {
        echo json_encode(
            array(
                'VALID' => false,
                'MESSAGE' => "The uploaded file is empty",
            )
        );
        exit;
    }

    // Check if DESCRIPTION is provided
    if ($_POST['DESCRIPTION'] == "") {
        echo json_encode(
            array(
                'VALID' => false,
                'MESSAGE' => "Please fill up required inputs",
            )
        );
        exit;
    }
     // Check if the uploaded file is a PDF
    if ($_FILES['ATTACH_FILE']['type'] != 'application/pdf') {
        echo json_encode(
            array(
                'VALID' => false,
                'MESSAGE' => "Only PDF files are allowed",
            )
        );
        exit;
    }

    // Get document details
    $documentRow = selectDocument($_POST['ID']);

    // Read FTP credentials from config.ini
    $config = parse_ini_file('config.ini', true);
    $uploadDirectory = $config['ftp_credentials']['ftp_server'];
    $username = $config['ftp_credentials']['username'];
    $password = $config['ftp_credentials']['password'];

    // Connect to FTP server
    connectTo($uploadDirectory, $username, $password);

    $targetDir = "$uploadDirectory/$documentRow[DOC_NUM]/$documentRow[ROUTE_NUM]";
    $targetFile = "$targetDir/$_POST[DESCRIPTION].pdf";

    // Create the target directory if it doesn't exist
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0, true);
    }

    // Start database transaction
    $pdo->beginTransaction();

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES['ATTACH_FILE']['tmp_name'], $targetFile)) {
        // File uploaded successfully
        $insertAttachmentData = [
            'TABLE' => 'DOTS_ATTACHMENTS',
            "DATA" => [
                'DOC_NUM' => $documentRow['DOC_NUM'],
                'ROUTE_NUM' => $documentRow['ROUTE_NUM'],
                'HRIS_ID' => $_SESSION['HRIS_ID'],
                'DESCRIPTION' => $_POST['DESCRIPTION'],
            ]
        ];
        $insertAttachmentSql = $queries->insertQuery($insertAttachmentData);

        if ($insertAttachmentSql != 0) {
            $pdo->commit();
            echo json_encode(
                array(
                    'VALID' => true,
                    'MESSAGE' => "File uploaded.",
                )
            );
        } else {
            $pdo->rollback();
            unlink($targetFile);
            echo json_encode(
                array(
                    'VALID' => false,
                    'MESSAGE' => "File not uploaded." . error_get_last()['message'],
                )
            );
        }
    } else {
        // Failed to move the file
        echo json_encode(
            array(
                'VALID' => false,
                'MESSAGE' => "Failed to upload file." . error_get_last()['message'],
            )
        );
    }

    // Delete old temporary files
    deleteOldTemp("../attachment_temp");

    // Disconnect from FTP server
    disconnectTo($uploadDirectory);
} else {
    // Invalid request
    echo json_encode(
        array(
            'VALID' => false,
            'MESSAGE' => "Invalid request.",
        )
    );
    exit;
}

// Function to select document details by ID
function selectDocument($id)
{
    global $conn, $queries;
    $selectDocumentData = [
        'TABLE' => 'DOTS_DOCUMENT',
        'WHERE' => [
            'AND' => [
                ['ID' => $id]
            ]
        ]
    ];
    $selectDocumentRow = $queries->selectQuery($selectDocumentData)[0];

    return $selectDocumentRow;
}

// Function to delete old temporary files
function deleteOldTemp($directory)
{
    // Get the current time and calculate the time one hour ago
    $time = time() - (60 * 60); // 60 seconds * 60 minutes = 1 hour

    // Open the directory
    if ($handle = opendir($directory)) {
        // Loop through the directory
        while (false !== ($file = readdir($handle))) {
            $filePath = $directory . '/' . $file;
            // Check if the file is a regular file and if it's older than an hour
            if (is_file($filePath) && filemtime($filePath) != $time) {
                // Delete the file
                unlink($filePath);
            }
        }
        // Close the directory handle
        closedir($handle);
    }
}

// Function to connect to FTP server
function connectTo($directory, $username, $password)
{
    $command = "net use $directory /user:$username $password";
    return exec($command);
}

// Function to disconnect from FTP server
function disconnectTo($directory){
    $command = "net use $directory /delete";
    return exec($command);
}
?>
