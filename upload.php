<?php
require_once 'config.php';
$target_dir = "uploads/";
$uploadOk = 1;
$message = "";

if(isset($_POST["submit"])) {
    if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $message = "File is not an image.";
            $uploadOk = 0;
        }

        $unique_filename = uniqid() . "." . strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
        $target_file = $target_dir . $unique_filename;

        if (file_exists($target_file)) {
            $message = "Sorry, file already exists.";
            $uploadOk = 0;
        }

        if ($_FILES["fileToUpload"]["size"] > 5000000) { // Increased to 5MB
            $message = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        $allowed_types = array("jpg", "jpeg", "png", "gif");
        if(!in_array(strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION)), $allowed_types)) {
            $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            $message = "Sorry, your file was not uploaded. " . $message;
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                if ($mysqli->connect_error) {
                    die("Connection failed: " . $mysqli->connect_error);
                }
                $query = "INSERT INTO images (filename, title, description) VALUES (?, ?, ?)";
                $stmt = $mysqli->prepare($query);
                $stmt->bind_param("sss", $unique_filename, $_POST['title'], $_POST['description']);
                if ($stmt->execute()) {
                    $message = "The file ". htmlspecialchars($unique_filename) . " has been uploaded.";
                } else {
                    $message = "Sorry, there was an error uploading your file information.";
                }
                $stmt->close();
                $mysqli->close();
            } else {
                $message = "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        $message = "No file was uploaded or an error occurred.";
        $uploadOk = 0;
    }
    header("Location: index.php?message=" . urlencode($message) . "&uploadOk=" . $uploadOk);
    exit();
}
?>
