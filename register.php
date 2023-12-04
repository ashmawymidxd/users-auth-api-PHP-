<?php
require_once('config.php');
require_once('password.php');
header('Content-Type: application/json; Charset=UTF-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if (
    $_POST['name'] != '' &&
    $_POST['email'] != '' &&
    $_POST['password'] != '' &&
    $_POST['address'] != '' &&
    $_POST['contact'] != '' &&
    $_POST['confirm_password'] != ''
) {
    // Check if the image file is uploaded successfully
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == UPLOAD_ERR_OK) {
        $image_path = 'users_images/' . basename($_FILES['profile_image']['name']);
        move_uploaded_file($_FILES['profile_image']['tmp_name'], $image_path);
    } else {
        $response["status"] = 'failed';
        $response["message"] = 'Error uploading image';
        echo json_encode($response);
        exit;
    }

    $sql = "SELECT * FROM `users` WHERE `email` = '" . $_POST['email'] . "' AND `CONTACT` = '" . $_POST['contact'] . "'";
    $res = mysqli_query($conn, $sql);

    // Validate password length and complexity
    $validate_password = check_password($_POST['password'], $_POST['confirm_password']);

    if ($validate_password != 'Password matched') {
        $response["status"] = 'failed';
        $response["message"] = $validate_password;
        echo json_encode($response);
        exit;
    } else {
        // Validate email availability
        if ($res->num_rows == 0) {
            $sql = "INSERT INTO `users` (`NAME`,`EMAIL`,`PASSWORD`,`ADDRESS`,`CONTACT`,`PROFILE_IMAGE`) 
                    VALUES ('" . $_POST['name'] . "','" . $_POST['email'] . "','" . $_POST['password'] . "','" . $_POST['address'] . "','" . $_POST['contact'] . "','" . $image_path . "')";

            $query = mysqli_query($conn, $sql);

            if ($query) {
                $user["id"] = mysqli_insert_id($conn);
                $user["name"] = $_POST['name'];
                $user["email"] = $_POST['email'];
                $user["password"] = $_POST['password'];
                $user["address"] = $_POST['address'];
                $user["contact"] = $_POST['contact'];
                $user["profile_image"] = $image_path;

                $response["status"] = 'success';
                $response["message"] = 'User registered successfully';
                $response["user"] = $user;
                echo json_encode($response);
            } else {
                $response["status"] = 'failed';
                $response["message"] = 'Error in query';
                echo json_encode($response);
            }
        } else {
            $response["status"] = 'failed';
            $response["message"] = 'User already exists';
            echo json_encode($response);
        }
    }
} else {
    $response["status"] = 'failed';
    $response["message"] = 'Please enter all input fields like email, name, password, confirm_password, contact; it cannot be empty';
    echo json_encode($response);
}
?>
