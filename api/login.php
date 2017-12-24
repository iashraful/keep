<?php

$data = ['name' => 'God', 'age' => -1];
header('Content-Type: application/json');
echo json_encode($data);

?>