<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include './Queries.php';
include './DB_Connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['ATTACH_FILE'])) {
    if ($_SESSION['DOTS_PRIV'] < 3) {
        echo json_encode(
            array(
                'VALID' => false,
                'MESSAGE' => "Not enough privilege to perform this action",
            )
        );
        exit;
    }
    $queries = new Queries();
    $message = "";
    $valid = false;

    $config = parse_ini_file('config.ini', true);
    $uploadDirectory = $config['directories']['upload_directory'];

    $doc_num = $_POST['DOC_NUM'];
    $route_num = $_POST['ROUTE_NUM'];
    $desc = $_POST['DESCRIPTION'];


    $targetDir = "$uploadDirectory/$doc_num/$route_num/";
    // Create the target directory if it doesn't exist
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    foreach ($_FILES['ATTACH_FILE']['name'] as $key => $fileName) {
        $tmpFilePath = $_FILES['ATTACH_FILE']['tmp_name'][$key];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $fileExtension;
        $targetFile = $targetDir . $filename;

        if (move_uploaded_file($tmpFilePath, $targetFile)) {
            $insertData = [
                'TABLE' => "DOTS_ATTACHMENTS",
                'DATA' => [
                    "FILE_PATH" => $targetDir,
                    "FILE_NAME" => $filename,
                ]
            ];

            foreach ($_POST as $key => $value) {
                $safeKey = mysqli_real_escape_string($conn, $key);
                $safeValue = mysqli_real_escape_string($conn, $value);
                $insertData['DATA'][$safeKey] = $safeValue;
            }

            $insertSql = $queries->insertQuery($insertData);
            if (mysqli_query($conn, $insertSql)) {
                $valid = true;
                $message = "File uploaded successfully.";
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        } else {
            $message = "Sorry, there was an error uploading your file.";
        }
    }
    echo json_encode(
        array(
            'VALID' => $valid,
            'MESSAGE' => $message,
        )
    );
} else {
    echo "Invalid request.";
}
?>