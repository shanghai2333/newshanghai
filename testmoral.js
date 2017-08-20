$(document).ready(function(e){
	//显示德育分
	$.ajax({
	    type: 'GET',
	    url: 'API/read_moral.php',
	    dataType: 'json',
	    success:function(data){
	    	var moral_score = data.result;
	    	//moral_score 在某个地方显示出来
	    },
	})
})