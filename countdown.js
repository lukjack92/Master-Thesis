"use strict";

var timer;

function addUser() {
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
	setTimeout(function() {
			$("#cl").empty();
		}, 6000);
}

function deleteUser(id) {
	/*
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
	*/
	
	$("#delUserModal").modal('show');
	
	var modelConfirm = function(callback){

	$("#modal-btn-yes").on("click", function(){
		callback(true);
		$("#delUserModal").modal('hide');
	});
  
	$("#modal-btn-no").on("click", function(){
		callback(false);
		$("#delUserModal").modal('hide');
	});
};

modelConfirm(function(confirm){
	
	if(confirm){
		console.log(id);
		
		var posting = $.post("delUser.php", {
			id: id
		});	
	
		posting.done(function(data) {
			console.log(data);
			$("#cl").empty().append(data);
			readRecords();
		});
	};
});
	
	setTimeout(function() {
			$("#cl").empty();
		}, 6000);
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
	
	timer = setTimeout(function() {
		$("#cl").empty();
	}, 6000);
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

function readDatabase() {
	var getting = $.get("readDatabase.php", {
		
	});

	getting.done(function(data) {
		$("#database_content").empty().append(data);
	});
}

function resetPassUser() {
	clearInterval(timer);
	var user_to_reset = $("#reset_user").val();
	var pass = $("#setPassword").val();
	
	console.log(pass);
	
	var posting = $.post("resetPassword.php", {
		pass: pass,
		user: user_to_reset
	});
	
	posting.done(function(data) {
		$("#set_password").modal("hide");
		$('#cl').empty().append(data);
	});
	
	$("#reset_user").val("");
	$("#setPassword").val("");
	
	timer = setTimeout(function() {
		$("#cl").empty();
	}, 6000);
}

function confirmPassword(user_confirm) {
	clearInterval(timer);
	var user_to_reset = $("#reset_user").val();
	console.log(user_confirm);
	console.log(user_to_reset);
	var pass = $("#password").val();
	$("#password").val(""); 
	var posting = $.post("confirmPassword.php", {
		user_confirm: user_confirm,
		pass: pass
	});
	
	posting.done(function(data) {
		$("#authentication_the_operation").modal("hide");
		
		var attr = JSON.parse(data);
		console.log(attr);
		if(attr.status) {
			$("#set_password").modal("show");
			$('#myModalLabelUser').empty().append("The password reset of user "+user_to_reset);			
		}
		$('#cl').empty().append(attr.message);
		
		timer = setTimeout(function() {
			$("#cl").empty();
		}, 6000);
	});
}

function doConfirm(msg, yesFn, noFn) {
	var confirmBox = $("#exampleModalCenter");
		confirmBox.find("#exampleModalLongTitle").text(msg);
		confirmBox.find(".yes,.no").unbind().click(function()
		{
			confirmBox.hide();
		});
	
		confirmBox.find(".yes").click(yesFn);
		confirmBox.find(".no").click(noFn);
		//confirmBox.show();
		$("#exampleModalCenter").modal("show");
} 


function actionReset(user_reset) { 
	clearInterval(timer);
	console.log(user_reset);
	$("#authentication_the_operation").modal("show");
	$("#reset_user").val(user_reset);
}

function delQuestion(id_question){
	
$("#delQuestionModal").modal('show');
//var conf = confirm("Are you sure!!!");

/*
if(conf == true){
	
	console.log(id_question);
	var posting = $.post("removeQuestion.php", {
			id: id_question
		});	
	
		posting.done(function(data) {
			console.log(data);
			$("#cl").empty().append(data);
			readDatabase();
		});
}*/

var modelConfirm = function(callback){

	$("#modal-btn-yes").on("click", function(){
		callback(true);
		$("#delQuestionModal").modal('hide');
	});
  
	$("#modal-btn-no").on("click", function(){
		callback(false);
		$("#delQuestionModal").modal('hide');
	});
};

modelConfirm(function(confirm){
	
	if(confirm){
		console.log(id_question);
		
		var posting = $.post("removeQuestion.php", {
			id: id_question
		});	
	
		posting.done(function(data) {
			console.log(data);
			$("#cl").empty().append(data);
			readDatabase();
		});
	};
});
}

function viewQuestion(id_question) {
	console.log("Clicked Button");
	var posting = $.post("viewQuestion.php", {
			id: id_question
	});	
	
	posting.done(function(data) {
		var attr = JSON.parse(data);
		//console.log(attr.question);
		console.log(attr.odp);
		//$("#cl").empty().append(attr.question);
		$("#span_test").empty().append(" "+attr.question);
		$("#span_opd1").empty().append(" "+attr.ansa);
		$("#span_opd2").empty().append(" "+attr.ansb);
		$("#span_opd3").empty().append(" "+attr.ansc);
		$("#span_opd4").empty().append(" "+attr.ansd);
		$("#span_corr_odp").empty().append(" "+attr.odp);
		
		
		$("#updateViewModal").modal("show");
	});
}

function buttonEdit() {
	console.log("Clicked Button Edit");
		$("#updateViewModal").modal("hide");
		$("#updateViewModalUpdate").modal("show");

}

function buttonCancel() {
	$("#updateViewModal").modal("show");
}

function buttonSave() {
	$("#updateViewModalUpdate").modal("hide");
	$("#updateViewModal").modal("show");
}

$(document).ready(function() {
	
	readRecords();
	readDatabase();
	
	//Session time; 
	var time = 15;
	var test = document.getElementById('cl');
	var label1 = document.getElementById('label1');
	let drawIntrernal;
	
	$("html").mouseup(function() {
		test.append(" Clicked");
		//console.log("Time 100 and clicked.");
		time = 15;
		//clearInterval(timer);
	});
	
	//Function display, whether extend session or not.
	
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