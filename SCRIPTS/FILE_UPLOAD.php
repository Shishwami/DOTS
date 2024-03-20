<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include './Queries.php';
include './DB_Connect.php';

$queries = new Queries();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset ($_FILES['ATTACH_FILE'])) {

    if ($_SESSION['DOTS_PRIV'] < 2) {
        echo json_encode(
            array(
                'VALID' => false,
                'MESSAGE' => "Not enough privilege to perform this action",
            )
        );
        exit;
    }
    if ($_POST['DESCRIPTION'] == "") {
        echo json_encode(
            array(
                'VALID' => false,
                'MESSAGE' => "Please Fill up required Inputs",
            )
        );
        exit;
    }

    global $conn, $queries;

    $message = "";
    $valid = false;

    $documentRow = selectDocument($_POST['ID']);

    var_dump($documentRow);

    $config = parse_ini_file('config.ini', true);
    $uploadDirectory = $config['ftp_credentials']['ftp_server'];

    $targetDir = "$uploadDirectory/$documentRow[DOC_NUM]/$documentRow[ROUTE_NUM]/";
    $targetFile = "$targetDir/$_POST[DESCRIPTION].pdf";

    // Create the target directory if it doesn't exist
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $pdo->beginTransaction();
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
        $insertAttachmentSql = $queries->insertQuery($insertAttachmentData, getPdoConnection());
        echo "ASDASD $insertAttachmentSql ASd";

        if ($insertAttachmentSql != 0) {
            $pdo->commit();
            echo json_encode(
                array(
                    'VALID' => true,
                    'MESSAGE' => "File Uploaded.",
                )
            );
        } else {
            $pdo->rollback();
            unlink($targetFile);
            echo json_encode(
                array(
                    'VALID' => false,
                    'MESSAGE' => "File Not Uploaded.",
                )
            );
        }
    } else {
        // Failed to move the file
        echo json_encode(
            array(
                'VALID' => false,
                'MESSAGE' => "Failed to upload file.",
            )
        );
    }
} else {
    echo "Invalid request.";
}

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
    $selectDocumentRow = $queries->selectQuery($selectDocumentData, getPdoConnection())[0];

    return $selectDocumentRow;
}
?>