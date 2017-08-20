var now_my_id;

$(document).ready(function(){
	$.ajaxSetup({
	    type:"POST",
	    url:"API/modify_my.php",
	    dataType:"json",
	    success:function(data){
	      if (data.result=="success") {
	          alert("修改成功！");
	      }else {
	          alert("修改失败！");
	      }   
	    }
	});

	$('#event_name').change(function(){
	    var sub = new Object;
	    sub.event_name = $("#event_name").val();
	    $.ajax({
	      data:sub,
	      activity_id:now_my_id,
	    });
  	});
	$('#event_starttime').change(function(){
	    var sub = new Object;
	    sub.event_starttime = $("#event_starttime").val();
	    $.ajax({
	      data:sub,
	      activity_id:now_my_id,
	    });
  	});
	$('#event_endtime').change(function(){
	    var sub = new Object;
	    sub.event_endtime = $("#event_endtime").val();
	    $.ajax({
	      data:sub,
	      activity_id:now_my_id,
	    });
  	});
	$('#event_desc').change(function(){
	    var sub = new Object;
	    sub.event_desc = $("#event_desc").val();
	    $.ajax({
	      data:sub,
	      activity_id:now_my_id,
	    });
  	});


})


function edit_my(act_id){
	$.ajax({
		type:"GET",
        url:"API/get_my_info.php",
        dataType:"json",
        data:{
        	activity_id:act_id,
        },
        success:function(obj){
        	now_my_id = obj.activity_id;
        	$("#event_name").val(obj.activity_title);
        	$("#event_starttime").val(obj.start_time);
        	$("#event_endtime").val(obj.end_time);
        	$("#event_desc").val(obj.activity_info);
        },
	})
}