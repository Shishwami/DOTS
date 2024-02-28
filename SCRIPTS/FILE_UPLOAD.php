<?php
include './Queries.php';
include './DB_Connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {

    $queries = new Queries();

    $doc_num = $_POST['DOC_NUM'];
    $route_num = $_POST['ROUTE_NUM'];
    $targetDir = "uploads/$doc_num/$route_num/";

    // Create the target directory if it doesn't exist
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $originalFileName = $_FILES["file"]["name"];
    $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);

    $filename = "0." . $fileExtension;
    $index = 0;


    while (file_exists($targetDir . $filename)) {
        $index++;
        $filename = strval($index) . '.' . $fileExtension;
    }

    $originalFileName = $_FILES["file"]["name"];
    $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);

    $targetFile = $targetDir . $filename;

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
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
                "DOC_NUM" => "$doc_num",
                "ROUTE_NUM" => "$route_num",
                "FILE_PATH" => "$targetDir",
                "FILE_NAME" => "$filename",
            ]
        ];

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