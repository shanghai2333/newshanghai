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

	try {

        $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_POST['event_name'])) {
            $stmt = $DBH->prepare("UPDATE my_activity SET activity_title = ? WHERE username = {$_SESSION['usrid']}");
            $stmt->execute(array($_POST['event_name']));
        }
        if (isset($_POST['event_starttime'])) {
            $stmt = $DBH->prepare("UPDATE my_activity SET start_time = ? WHERE username = {$_SESSION['usrid']}");
            $stmt->execute(array($_POST['event_starttime']));
        }
        if (isset($_POST['event_endtime'])) {
            $stmt = $DBH->prepare("UPDATE my_activity SET end_time = ? WHERE username = {$_SESSION['usrid']}");
            $stmt->execute(array($_POST['event_endtime']));
        }
        if (isset($_POST['event_desc'])) {
            $stmt = $DBH->prepare("UPDATE my_activity SET activity_info = ? WHERE username = {$_SESSION['usrid']}");
            $stmt->execute(array($_POST['event_desc']));
        }
     
       print('{"result":"success"}');
       die();

    } catch (PDOException $e) {
        //print_r($e);
        print('{"result":"Database Error"}');
        die();
    }
?>