"use strict";

function addRecord() {
	var login = $("#login").val();
	var first_name = $("#first_name").val();
	var last_name = $("#last_name").val();
	var pass = $("#password").val();
	var permission = $("#inputState").val().toLowerCase();

	var posting = $.post("addUser.php", { 
		login: login,
		first_name: first_name,
		last_name: last_name,
		pass: pass,
		permission: permission
	});
	
	
	posting.done(function(data) {
		$("#add_new_record_modal").modal("hide");
		$("#cl").empty().append(data);
		readRecords();
	});
	
	$("#login").val("");
	$("#first_name").val("");
	$("#last_name").val("");
	$("#password").val("");
	
	//location.reload();
}

function deleteUser(id) {
	
	var conf = confirm("Are you sure!!!");
	
	if(conf == true) {
		var posting = $.post("delUser.php", {
			id: id
		});
	
		posting.done(function(data) {
			$("#cl").empty().append(data);
			readRecords();
		});
	}
}

function updateIsActive(id, active) {
	
	active ? active=false : active=true;  
	
	console.log(active);
	
	var posting = $.post("updateIsActive.php", {
		id: id,
		active: active
	});
	
	posting.done(function(data) {
		$("#cl").empty().append(data);
		readRecords();
	});
}

function getDetails(id, userID) {

	$("#hidden_user_id").val(userID);
	$("#update_login").val("");
    $("#update_first_name").val("");
    $("#update_last_name").val("");
    $("#updateInputState").val("");
	
	var login = $("tr:nth-child("+id+") td:nth-child(2)").text();
	var first_name = $("tr:nth-child("+id+") td:nth-child(3)").text();
	var last_name = $("tr:nth-child("+id+") td:nth-child(4)").text();
	var permission = $("tr:nth-child("+id+") td:nth-child(6)").text();

	permission = permission.substr(0,1).toUpperCase()+permission.substr(1,permission.length)

	$("#update_login").val(login);
    $("#update_first_name").val(first_name);
    $("#update_last_name").val(last_name);
    $("#updateInputState").val(permission);
	
	$("#updateUserModal").modal("show");
}

function updateUser() {

	var login = $("#update_login").val();
	var first_name = $("#update_first_name").val();
	var last_name = $("#update_last_name").val();
	var permission = $("#updateInputState").val().toLowerCase();
	var userID = $("#hidden_user_id").val();
	
	var posting = $.post("updateDetailsUser.php", {
		login: login,
		firstName: first_name,
		lastName: last_name,
		permission: permission,
		userID: userID
	});
	
	posting.done(function(data) {
		$("#updateUserModal").modal("hide");
		$("#cl").empty().append(data);
		readRecords();
	});
}

function readRecords() {
	
	var getting = $.get("readRecords.php", {
	});
	
	getting.done(function(data) {
		$("#record_content").empty().append(data);
		//$("#record_content").innerHTML = data;
		//location.reload();
		//console.log(data);
		//$("#record_content").html(data);
	});
}

$(document).ready(function() {
	
	readRecords();
	
	//Session time; 
	var time = 10;
	var test = document.getElementById('cl');
	var label1 = document.getElementById('label1');
	let drawIntrernal;
	
	$("html").mouseup(function() {
		test.append(" Clicked");
		//console.log("Time 100 and clicked.");
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

	//Displays the time after which the session will be expiring.
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
				//window.location.href;
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