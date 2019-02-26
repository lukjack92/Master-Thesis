"use strict";
$(document).ready(function() {
	
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

	//Session time; 
	var time = 10;
	
	//Display what is time to expired session.
	document.getElementById('time').innerHTML = "Time session " + time + "s";
	
	//Interval every 1 second (1000 millisecond).
	setInterval(function() {
		var distance = --time;
		document.getElementById('time').innerHTML = "Time session " + distance + "s";
		
		if(distance < 0) {
			clearInterval(time);
			document.getElementById('time').innerHTML = "SESSION EXPIRED";

			doConfirm("Expired, restore session?", function yes()
			{
				alert("Restore");
				window.location.href = "welcome.php";
			}, function no() {
				window.location.href = "logout.php";
			});
		}
		
	}, 1000);
}); 