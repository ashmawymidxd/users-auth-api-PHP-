<?php
require_once('config.php');
header('Content-Type:application/json; Charset=UTF-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Assuming you want to retrieve all users

    $sql = "SELECT * FROM `users`";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        if ($res->num_rows > 0) {
            $users = array();

            while ($row = $res->fetch_assoc()) {
                $users[] = $row;
            }

            $response["status"] = 'success';
            $response["message"] = 'Users found';
            $response["users"] = $users;
            echo json_encode($response);
        } else {
            $response["status"] = 'failed';
            $response["message"] = 'No users found';
            echo json_encode($response);
        }
    } else {
        $response["status"] = 'failed';
        $response["message"] = 'Error in query: ' . mysqli_error($conn);
        echo json_encode($response);
    }
} else {
    $response["status"] = 'failed';
    $response["message"] = 'Invalid request method, use GET';
    echo json_encode($response);
}
?>
