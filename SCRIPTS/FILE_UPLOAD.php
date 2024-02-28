<?php
// Assuming you have already established a database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $doc_num = $_POST['DOC_NUM'];
    $route_num = $_POST['ROUTE_NUM'];
    $targetDir = "uploads/$doc_num/$route_num/";

    // Create the target directory if it doesn't exist
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true); // The third parameter creates nested directories if needed
    }

    $originalFileName = $_FILES["file"]["name"];
    $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);

    // Generate a unique filename
    $uniqueFileName = uniqid() . '_' . bin2hex(random_bytes(8)) . '.' . $fileExtension;

    $targetFile = $targetDir . $uniqueFileName;

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        // File uploaded successfully, now insert file path into database
        // $filePath = mysqli_real_escape_string($conn, $targetFile); // Assuming $conn is your MySQLi connection

        $data = [
            'TABLE' => "",
            'DATA' => [
                "DOC_NUM" => "",
                "ROUTE_NUM" => "",
            ]
        ];
        // $query = "INSERT INTO files (file_path) VALUES ('$filePath')";

        // if (mysqli_query($conn, $query)) {
        //     $insertedId = mysqli_insert_id($conn); // Get the ID of the inserted row
        //     echo "File uploaded successfully. ID of the inserted row: $insertedId";
        // } else {
        //     echo "Error: " . $query . "<br>" . mysqli_error($conn);
        // }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} else {
    echo "Invalid request.";
}
?>