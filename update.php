<?php
require_once('config.php');
header('Content-Type: application/json; Charset=UTF-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Check if the 'id' parameter is provided in the POST request
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Check if the user with the given ID exists
    $checkSql = "SELECT * FROM `users` WHERE `id` = $id";
    $checkRes = mysqli_query($conn, $checkSql);

    if ($checkRes) {
        if ($checkRes->num_rows > 0) {
            // Update user information with the given ID
            $updateSql = "UPDATE `users` SET 
                `name` = '" . $_POST['name'] . "',
                `email` = '" . $_POST['email'] . "',
                `password` = '" . $_POST['password'] . "',
                `address` = '" . $_POST['address'] . "',
                `contact` = '" . $_POST['contact'] . "'
                WHERE `id` = $id";

            $updateRes = mysqli_query($conn, $updateSql);

            if ($updateRes) {
                $response["status"] = 'success';
                $response["message"] = 'User updated successfully';
                echo json_encode($response);
            } else {
                $response["status"] = 'failed';
                $response["message"] = 'Error in updating user';
                echo json_encode($response);
            }
        } else {
            $response["status"] = 'failed';
            $response["message"] = 'User not found';
            echo json_encode($response);
        }
    } else {
        $response["status"] = 'failed';
        $response["message"] = 'Error in query';
        echo json_encode($response);
    }

} else {
    $response["status"] = 'failed';
    $response["message"] = 'Please provide the user ID';
    echo json_encode($response);
}
?>