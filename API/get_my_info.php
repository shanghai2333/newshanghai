<?php 
	require("../classes/yb-globals.inc.php");
    session_start();
    if(!isset($_SESSION['token'])){
        print('{"result":"Forbidden"}');
        die();
    }
	include_once("connect.php");
	$username = $_SESSION['usrid'];

	$activity_id = $_GET['activity_id'];

	try{
		$sql = $DBH->prepare("SELECT * FROM my_activity WHERE username = ? AND activity_id = ?");
		$sql->bindParam(1,$username);
		$sql->bindParam(2,$activity_id);
	    $sql->execute();
	    $allrows = $sql->fetch(PDO::FETCH_ASSOC);
        print(json_encode($allrows, JSON_UNESCAPED_UNICODE));
	}catch (PDOException $e) {
        print('{"result":"Database Error"}');
        die();
    }    

?>