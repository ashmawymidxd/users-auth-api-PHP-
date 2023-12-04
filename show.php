<?php
require_once('config.php');
header('Content-Type: application/json; Charset=UTF-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Check if the 'id' parameter is provided in the POST request
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Retrieve user by ID
    $sql = "SELECT * FROM `users` WHERE `id` = $id";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        // Check if user with the given ID exists
        if ($res->num_rows > 0) {
            $user = $res->fetch_assoc();
            
            $response["status"] = 'success';
            $response["message"] = 'User retrieved successfully';
            $response["user"] = $user;
            echo json_encode($response);
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