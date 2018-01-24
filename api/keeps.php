<?php

header('Content-Type: application/json');

function list_notes() {
    // Open a MySQL connection
    include "config/db_config.php";
    $query = "SELECT * FROM `keeps` ORDER BY id DESC";
    $result = $conn->query($query);
    $json_response_array = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $row_array['id'] = $row['id'];
            $row_array['note'] = $row['note'];
            $row_array['is_checked'] = $row['is_checked'];
            $row_array['created_at'] = $row['created_at'];
            $row_array['updated_at'] = $row['updated_at'];
            array_push($json_response_array, $row_array);
        }
        return $json_response_array;
    }
    else{
        $response = [];
        return $response;
    }
    // Close Connection
    mysqli_close($conn);
}

function add_note($note) {
    // Open a MySQL connection
    include "config/db_config.php";
    $query = "INSERT INTO keeps (`note`) VALUES('".$note."')";
    if ($conn->query($query) === TRUE) {
        $query = "SELECT * from `keeps` order by `id` DESC LIMIT 1";
        $result = $conn->query($query);
        $response = [];
        if($result->num_rows == 1) {
            $row = $result->fetch_row();
            $response = ['id' => $row[0], 'note' => $row[1], 'is_checked' => $row[2], 'created_at' => $row[3], 'updated_at' => $row[4]];
        }
    	echo json_encode($response);
    }
    else{
    	$response = ['status' => 400, 'message' => 'Request does not processed successfully.'];
    	echo json_encode($response);
    }
    // Close Connection
    mysqli_close($conn);
}

function update_note($id, $note, $checked=0) {
	/**
	* This method will do basically PUT. For now note & is_checked is possible to change.
	*/
	// Open a MySQL connection
    include "config/db_config.php";

    $query = "UPDATE `keeps` SET `note`='".$note."', `is_checked`=".$checked." WHERE `id`=".$id;
    if ($conn->query($query) === TRUE) {
		$response = ['status' => 200, 'message' => 'Request processed successfully.'];
    	echo json_encode($response);
    }
    else{
    	$response = ['status' => 400, 'message' => 'Request does not processed successfully.'];
    	echo json_encode($response);
    }
    // Close Connection
    mysqli_close($conn);
}


// Handle HTTP requests like, GET, POST, PUT

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $response = list_notes();
    echo json_encode($response);
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $note = $data['note'];
    add_note($note);
}

if($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'];
    $note = $data['note'];
    $is_checked = $data['is_checked'];
    update_note($id, $note, $is_checked);
}

?>