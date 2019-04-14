"use strict";
$(document).ready(function() {
	
	//Session time; 
	var time = 10;
	var test = document.getElementById('cl');
	var label1 = document.getElementById('label1');
	let drawIntrernal;
	
	$("html").mouseup(function() {
		test.append(" Clicked");
		console.log("Time 100 and clicked.");
		time = 10;
		
	});
	
	//Function display, whether extend session or not.
	function doConfirm(msg, yesFn, noFn) {
		var confirmBox = $("#confirmBox");
			confirmBox.find(".message").text(msg);
			confirmBox.find(".yes,.no").unbind().click(function()
			{
				confirmBox.hide();
			});
		
			confirmBox.find(".yes").click(yesFn);
			confirmBox.find(".no").click(noFn);
			confirmBox.show();
	}


	//Display what is time to expired session.
	document.getElementById('time').innerHTML = "Time session " + time + "s";
	
	//Interval every 1 second (1000 millisecond).
	drawIntrernal = setInterval(function() {
		var distance = time--;
		document.getElementById('time').innerHTML = "Time session " + distance + "s";
		
		if(distance < 0) {
			clearInterval(time);
			document.getElementById('time').innerHTML = "SESSION EXPIRED";

			doConfirm("Expired, restore session?", function yes()
			{
				//alert("Restore");
				//window.location.href = "welcome.php";
				//console.log(window.location.href);
				//window.location.href;]
				location.reload();
				//location.reload();
			}, function no() {
				window.location.href = "logout.php";
			});
		}
		
	}, 1000);
/*	
	$('#checkBoxPer').change(function() {
		if(this.checked == true){
			this.value = "user"
			label.innerHTML = "user permissions"
		} else { 
			this.value = "admin"
			label.innerHTML = "admin permissions"
		}
	}); 
*/

	$('#checkBoxPer').change(function() {
		if($(this).prop("checked") == true) {
			$(this).val("admin");
			label.innerHTML = "admin permissions";			
		} else {
			$(this).val("user");
			label.innerHTML = "user permissions";
		}
	});
}); 