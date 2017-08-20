<?php
	require("classes/yb-globals.inc.php");
    
    session_start();
    
    if(!isset($_SESSION['token'])){
        exit('illegal access!');
     }
	 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>我的日历</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/calendar.css">
	<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
</head>
<body>
<div class="calendar-showbar">
	<div id="calendar" class="calendar"></div>
	<div id="schedule" class="schedule">

		<div id="event-modal" class="event-modal">
			<div class="event-modal-content">
				<div class="event-modal-title"></div>
				<div class="event-modal-info">
					<div class="event-modal-date"></div>
					<div class="event-modal-starttime"></div>
					<div class="event-modal-endtime"></div>
					<div class="event-modal-spot"></div>
					<div class="event-modal-state"></div>
				</div><br>
				<div class="event-modal-detail"></div>
				<div class="event-modal-moral"></div>
				<div class="event-modal-hold"></div>
			</div>
			<div class="modal-footer center">
				<a class="event-finished btn-flat">已完成</a>
				<a class="cancel btn-flat">取消</a>
			</div>

		</div>

		<div id="list">
		<a class="schedule-line hide">
			<div class="schedule-desc left">
				<div class="schedule-first-colm left">
					<div class="schedule-start-time"></div>
					<div class="schedule-end-time"></div>
				</div>
				<div class="title233 schedule-second-colm left"></div>
			</div>
			<!--      !!!!!!!!!!!!!!!!!!!!!!!!!-->

			<div class="">
				<span class="changebar icon-cross"></span>
			</div>

			<!--      !!!!!!!!!!!!!!!!!!!!!!!!!-->
			<div class="schedule-cls right">
				<span class="delete233 icon-cross"></span>
			</div>
		</a>
		</div>
		<div id="list1"></div>
	</div>
	<div class="event-modal-overlay"></div>
</div>
<div class="calendar-editbar">
	<div class="calendar-edit-title">
		<a class="calendar-edit-back left">返回</a>
		添加事件
		<a class="calendar-edit-finish right" onclick="finish_add_new()">完成</a>
	</div>
	<div class="calendar-edit-body">
		<div class="calendar-edit-part">
			<div class="calendar-edit-line" id="edit-event-name" style="border-bottom: 1px solid #dedede;">
				<input type="text" name="edit-event-name" placeholder="事件名称">
			</div>
		</div>
		<div class="calendar-edit-part">
			<div class="calendar-edit-line" id="edit-event-starttime" style="border-bottom: 1px solid #dedede;">
				<input type="text" name="edit-event-starttime" placeholder="起始时间">
			</div>
			<div class="calendar-edit-line" id="edit-event-endtime">
				<input type="text" name="edit-event-endtime" placeholder="结束时间">
			</div>
		</div>
		<div class="calendar-edit-part">
			<div class="calendar-edit-line" id="edit-event-desc">
				<input type="text" name="edit-event-desc" placeholder="详细信息">
			</div>
		</div>
	</div>
</div>


<!-- 编辑框！！！ -->

<div class="calendar-editbar">
	<div class="calendar-edit-title">
		<a class="calendar-edit-back left">返回</a>
		编辑事件
	</div>
	<div class="calendar-edit-body">
		<div class="calendar-edit-part">
			<div class="calendar-edit-line" id="edit-event-name" style="border-bottom: 1px solid #dedede;">
				<input id="event_name" type="text" name="edit-event-name" >
			</div>
		</div>
		<div class="calendar-edit-part">
			<div class="calendar-edit-line" id="edit-event-starttime" style="border-bottom: 1px solid #dedede;">
				<input id="event_starttime" type="text" name="edit-event-starttime">
			</div>
			<div class="calendar-edit-line" id="edit-event-endtime">
				<input id="event_endtime" type="text" name="edit-event-endtime">
			</div>
		</div>
		<div class="calendar-edit-part">
			<div class="calendar-edit-line" id="edit-event-desc">
				<input id="event_desc" type="text" name="edit-event-desc">
			</div>
		</div>
	</div>
</div>



<!-- 编辑框！！！ -->



	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
	<script src="js/calendar.js"></script>
	<script src="js/list.js"></script>
	<script src="js/edit.js"></script>

</body>
</html>