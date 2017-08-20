<?php
	require("../classes/yb-globals.inc.php");
    session_start();
    if(!isset($_SESSION['token'])){
        print('{"result":"Forbidden"}');
        die();
    }
	include_once("connect.php");
	$username = $_SESSION['usrid'];
	
	$activity_id = $_POST['activity_id'];
	try{
		$sql = $DBH->prepare("DELETE FROM personal_activity WHERE username = ? AND activity_id = ?");
		//$sql->execute([$state,$username,$activity_id]);
		$sql->bindParam(1,$username);
		$sql->bindParam(2,$activity_id);
		$sql->execute();
		$arr = array("result"=>"success");
		print(json_encode($arr, JSON_UNESCAPED_UNICODE));
	}catch(PDOException $e){
		die($e->getMessage());
	}
?>