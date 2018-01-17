<?php

header('Content-Type: application/json');

function add_note($note) {
    // Open a MySQL connection
    include "config/db_config.php";
    $query = "INSERT INTO keeps (`note`) VALUES('".$note."')";
    if ($conn->query($query) === TRUE) {
		$response = ['status' => 200, 'message' => 'Request processed successfully.'];
    	echo json_encode($response);
    }
    else{
    	$response = ['status' => 400, 'message' => 'Request does not processed successfully.'];
    	echo json_encode($response);
    }
    // Close Connection
    $conn.close();
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
    $conn.close();
}

?>