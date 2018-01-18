<?php
ob_start();
session_start();
// Open a MySQL connection
include "config/db_config.php";
header('Content-Type: application/json');

if (isset($_SESSION['username'])) {
    // logged in
    $api_response = ["user" => $_SESSION['username'], "login" => true, "message" => "User is already logged in to the System"];
    echo json_encode($api_response);
}

if($_SERVER['REQUEST_METHOD'] == 'GET') {
	$response = ['status' => 405, 'message' => '[GET] Method not allowed.'];
    echo json_encode($response);
}


if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$data = json_decode(file_get_contents('php://input'), true);
	// echo json_encode($data);
	$api_response = ['status' => 200, 'success' => true];
	$username = $data['username'];
	$password = $data['password'];
	
	$query = "SELECT * FROM users WHERE username='".$username."' AND password='".$password."'";
	$login_success = $conn->query($query);
	if($login_success->num_rows == 1){
		// Add to session
		$_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['username'] = $username;
		// Response to API
		$api_response = ["user" => $username, "login" => true, "message" => "Request processed successfully."];
    	echo json_encode($api_response);
	}
	else {
		$api_response = ["user" => $username, "login" => false, "message" => "Credentials may wrong."];
    	echo json_encode($api_response);
	}
}

// Close Connection
// $conn.close();

?>