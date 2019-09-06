<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "migration";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        
        $data = array();
        $data['msg'] ="DB Connection failed : " . $conn->connect_error;
        $data['status'] = "error";
        $data['result'] = [];
        echo json_encode($data);
    } 
?>