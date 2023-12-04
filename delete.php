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
            // Delete the user with the given ID
            $deleteSql = "DELETE FROM `users` WHERE `id` = $id";
            $deleteRes = mysqli_query($conn, $deleteSql);

            if ($deleteRes) {
                $response["status"] = 'success';
                $response["message"] = 'User deleted successfully';
                echo json_encode($response);
            } else {
                $response["status"] = 'failed';
                $response["message"] = 'Error in deleting user';
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