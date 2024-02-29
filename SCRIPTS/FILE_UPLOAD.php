<?php
include './Queries.php';
include './DB_Connect.php';

$imgFile = $_FILES['ATTACH_FILE'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($imgFile)) {

    var_dump($_POST);

    $queries = new Queries();

    $config = parse_ini_file('config.ini', true);
    $uploadDirectory = $config['directories']['upload_directory'];

    $doc_num = $_POST['DOC_NUM'];
    $route_num = $_POST['ROUTE_NUM'];
    $targetDir = "$uploadDirectory/$doc_num/$route_num/";
    echo $targetDir;
    // Create the target directory if it doesn't exist
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $originalFileName = $imgFile["name"];
    $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);

    $filename = "0." . $fileExtension;
    $index = 0;


    while (file_exists($targetDir . $filename)) {
        $index++;
        $filename = strval($index) . '.' . $fileExtension;
    }

    $targetFile = $targetDir . $filename;

    if (move_uploaded_file($imgFile["tmp_name"], $targetFile)) {
        // $filePath = mysqli_real_escape_string($conn, $targetFile); // Assuming $conn is your MySQLi connection

        // $query = "INSERT INTO files (file_path) VALUES ('$filePath')";

        // if (mysqli_query($conn, $query)) {
        // echo "File uploaded successfully.";
        // } else {
        // echo "Error: " . $query . "<br>" . mysqli_error($conn);
        // }
        $insertData = [
            'TABLE' => "DOTS_ATTACHMENTS",
            'DATA' => [

                "FILE_PATH" => "$targetDir",
                "FILE_NAME" => "$filename",
            ]
        ];

        foreach ($_POST as $key => $value) {
            $safeKey = mysqli_real_escape_string($conn, $key);
            $safeValue = mysqli_real_escape_string($conn, $value);
            $insertData['DATA'][$safeKey] = $safeValue;
        }

        $insertSql = $queries->insertQuery($insertData);
        if (mysqli_query($conn, $insertSql)) {
            echo "File uploaded successfully.";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} else {
    echo "Invalid request.";
}
?>