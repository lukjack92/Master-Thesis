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
	
	var getting = $.get("readRecords.php", {});
	console.log("Start");
	$("#record_content").text("Loading...");
	document.getElementById("loader").style.display = "block";
	getting.done(function(data) {
		if(document.readyState == 'complete'){ 
			console.log("Koniec"); 
			$("#record_content").empty().append(data);
			document.getElementById("loader").style.display = "none";};
	}); 
}

function readDatabase(number_page) {
	var posting = $.post("readDatabase.php", {
		page: number_page
	});
	console.log("Start");
	
	$("#database_content").text("Loading...");
	document.getElementById("loader").style.display = "block";
	posting.done(function(data) {
		if(document.readyState == 'complete'){ 
			console.log("Koniec"); 
			$("#database_content").empty().append(data);
			document.getElementById("loader").style.display = "none";
		};	
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
		confirmBox.find(".yes,.no").unbind().click(function() {
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

function delCategory(id, name){
	
$("#delQuestionModal").modal('show');

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
		console.log(id);
		console.log(name);
		var posting = $.post("removeCategory.php", {
			id: id,
			name: name
		});	
	
		posting.done(function(data) {
			console.log(data);
			$("#cl").empty().append(data);
			buttonViewCategory();
		});
	};
});
}

function viewQuestion(id_question) {
	console.log("Clicked Button");
	var attr;
	var cate;
	//console.log(id_question);
	$("#myID").empty().append(id_question);
	var posting = $.post("viewQuestion.php", {
			id: id_question
	});	
	
	posting.done(function(data) {
		attr = JSON.parse(data);
		//console.log(attr.question);
		console.log(attr.id);
		console.log(attr);
		//$("#cl").empty().append(attr.question);

		$("#spanQuestion").empty().append(attr.question);
		$("#spanOdp1").empty().append(attr.ansa);
		$("#spanOdp2").empty().append(attr.ansb);
		$("#spanOdp3").empty().append(attr.ansc);
		$("#spanOdp4").empty().append(attr.ansd);
		
		cate = attr.category;
		
		//Setting the answer for the Modal updateViewModal 
		//$("#spanCorrOdp").empty().append(attr.odp);
		var myArray = {ansa: "Answer A", ansb: "Answer B", ansc: "Answer C", ansd: "Answer D"};
		for(var key in myArray) {
			console.log("Przyszło: "+key);
				console.log(attr.odp);
			if(attr.odp === key) {
				console.log("Ustawić: "+myArray[key]);
				//document.getElementById("spanCorrOdp").value=myArray[key];
				$("#spanCorrOdp").val(myArray[key]);
				break;
			}
		}
		
		//View all category
		var getting = $.get("viewCategory.php", {
		});

		//This a remove all options from drop down list
		$("#chooseCategory option").remove();

		getting.done(function(data) {
			var category = JSON.parse(data);
		 		
				//console.log("Data: ");
				if(document.readyState == 'complete'){
					for(var i=0; i<category.length-1; i++) {
						console.log(category[i].category);
						//$("#database_content").append('<button type="button" class="btn btn-primary" onclick="viewQuestionFromCategory(\''+attr[i].category+'\')">'+attr[i].category+'</button>');
						var sel = document.getElementById("chooseCategory");
						var opts = document.createElement('option');
			
						opts.appendChild(document.createTextNode(category[i].category));
						sel.appendChild(opts);
					}
				
				$("#chooseCategory").val(cate);
				}		
		});
		
		//Setting the category for the Modal updateViewModal 
		//$("#chooseCategory").empty().append(attr.category);

		
		$("#updateViewModal").modal("show");
	});
	
	//To save updated element's in updateViewModalUpdate model
	$("#updateViewModal").find("#buttonSaveUpdate").unbind().click();
	$("#updateViewModal").find("#buttonSaveUpdate").click(function(){
		var myID = $("#myID").text();	
		console.log("SAVE: "+myID);
		//$("#updateViewModal").modal("hide");
		
		var posting = $.post("updateQuestion.php", {
			id: id_question,
			spanQuestion: $("#spanQuestion").text(),
			spanOdp1: $("#spanOdp1").text(),
			spanOdp2: $("#spanOdp2").text(),
			spanOdp3: $("#spanOdp3").text(),
			spanOdp4: $("#spanOdp4").text(),
			spanCorrOdp: $("#spanCorrOdp").val(),
			chooseCategory: $("#chooseCategory").val()
		});
		
		posting.done(function(data) {
			console.log(data);
			$("#cl").empty().append(data);
		});
		
		readDatabase();
		$("#updateViewModal").modal("hide");
		
		timer = setTimeout(function() {
			$("#cl").empty();
		}, 6000);
	});	
}

function buttonEdit(change) {
		//console.log(change);
		//console.log("Clicked Button Edit");
		$("#updateViewModal").modal("hide");
		
		var valueInput = $("#"+change).text();
		$("#textToEdit").val(valueInput);
		$("#updateViewModalUpdate").modal("show");
		
		//Update model with updateViewModalUpdate
		$("#updateViewModalUpdate").find("#buttonUpdate").unbind().click();
		$("#updateViewModalUpdate").find("#buttonUpdate").click(function(){
			var valueInput = $("#textToEdit").val();	
			$("#"+change).text(valueInput);			
			$("#updateViewModalUpdate").modal("hide");
			$("#updateViewModal").modal("show");
		});	
}

function buttonCancel() {
	$("#updateViewModal").modal("show");
}

function buttonAllDatabases() {
	$("#database_content").empty();
	readDatabase();
}


function buttonViewCategory(number_page) {
	var posting = $.post("readCategoryMainPage.php", {
		page: number_page
	});
	console.log("Start");
	
	$("#database_content").text("Loading...");
	document.getElementById("loader").style.display = "block";
	
	posting.done(function(data) {
		if(document.readyState == 'complete'){
			console.log("Koniec"); 
			$("#database_content").empty().append(data);	
			document.getElementById("loader").style.display = "none";
		}
	});
	
/*	//$("#database_content").empty();
	
	var getting = $.get("viewCategory.php", {
	});
	//Start Loading...
	$("#database_content").text("Loading...");
	document.getElementById("loader").style.display = "block";


	$("#listCategories li").remove();

	getting.done(function(data) {
		var attr = JSON.parse(data);
		//console.log(attr);

			$("#database_content").empty();
			
			var data = document.getElementById('database_content');
			var lista = document.createElement('ul');
			
			lista.className = "list-group";
			lista.id = "listCategories";
			data.appendChild(lista);
			
			//console.log(data);
			if(document.readyState == 'complete'){
				for(var i=0; i<attr.length-1; i++) {
					console.log(attr[i].category);
					//$("#database_content").append('<button type="button" class="btn btn-primary" onclick="viewQuestionFromCategory(\''+attr[i].category+'\')">'+attr[i].category+'</button>');
					//$("#list_category").append('<li class="list-group-item">Cras justo odio <button class="btn btn-primary pull-right" onclick="viewQuestionFromCategory(\''+attr[i].category+'\')">Select</button></li>');
					
					var sel = document.getElementById('listCategories');
					var opts = document.createElement('li');
					opts.className = "list-group-item";
					
					var butt = document.createElement("button");
					butt.className = "btn btn-primary pull-right";
					butt.innerHTML = "Select";
					
					opts.appendChild(document.createTextNode(attr[i].category));
					opts.appendChild(butt);
					sel.appendChild(opts);
				}
				document.getElementById("loader").style.display = "none";
		}
		//var test = document.getElementsByTagName('li');
		//console.log(test);
		//for(var i=0; i<attr.length-1; i++) test[i].click = viewQuestionFromCategory(attr[i].category);
	});	
	*/
}

function viewQuestionFromCategory(category) {
	console.log("Wywolano funkcje view");
	console.log(category);
	//console.log("Clicked button of category");
	var getting = $.get("readQuestionCategory.php", {
		category: category
	});

	$("#database_content").text("Loading...");
	document.getElementById("loader").style.display = "block";
	
	getting.done(function(data) {
		if(document.readyState == 'complete'){
			$("#database_content").empty().append(data);	
			document.getElementById("loader").style.display = "none";
		}
	});
}

function nextModalTwo() {
	$("#createViewModal1").modal("hide");
	$("#createViewModal2").modal("show");
}

function prevModalOne() {
	$("#createViewModal1").modal("show");
	$("#createViewModal2").modal("hide");
}

function nextModalThree() {
	$("#createViewModal2").modal("hide");
	$("#createViewModal3").modal("show");
}

function prevModalTwo() {
	$("#createViewModal2").modal("show");
	$("#createViewModal3").modal("hide");
}

function nextModalFour() {
	
	//View all category
	var getting = $.get("viewCategory.php", {
	});

	//This a remove all options from drop down list
	$("#chooseCategoryNewQuestion option").remove();

	getting.done(function(data) {
		var category = JSON.parse(data);
	 		
			//console.log("Data: ");
			if(document.readyState == 'complete'){
				for(var i=0; i<category.length-1; i++) {
					console.log(category[i].category);
					//$("#database_content").append('<button type="button" class="btn btn-primary" onclick="viewQuestionFromCategory(\''+attr[i].category+'\')">'+attr[i].category+'</button>');
					var sel = document.getElementById("chooseCategoryNewQuestion");
					var opts = document.createElement('option');
			
					opts.appendChild(document.createTextNode(category[i].category));
					sel.appendChild(opts);
				}
			}		
	});
	
	$("#createViewModal3").modal("hide");
	$("#createViewModal4").modal("show");
}

function prevModalThree() {
	$("#createViewModal3").modal("show");
	$("#createViewModal4").modal("hide");
}

function closeModal() {
	$("#question").val("");
	$("#chooseAnswer").prop('selectedIndex',0);
	$("#odp1").val("");
	$("#odp2").val("");
	$("#odp3").val("");
	$("#odp4").val("");
	$("#chooseAnswer").val("");
	$("#chooseCategoryNewQuestion");
}


function saveQuestion() {
	var posting = $.post("addNewQuestion.php", {
		question: $("#question").val(),
		odp1: $("#odp1").val(),
		odp2: $("#odp2").val(),
		odp3: $("#odp3").val(),
		odp4: $("#odp4").val(),
		corrOdp: $("#chooseAnswer").val(),
		category: $("#chooseCategoryNewQuestion").val()
	});
		
	posting.done(function(data) {
		//console.log(data);
		closeModal();
		$("#cl").empty().append(data);
		$("#createViewModal4").modal("hide");
	});
}

function selectSingleCheckBox() {
	//$('#singleCheckBox').click(function(){
	//if($(this).is(':checked')) { 
	//	document.getElementById("removeBox").style.display = "block";
	//	console.log("Active button");
	//} else { 
	//	document.getElementById("removeBox").style.display = "none"; }
	//});
	
	$("#singleCheckBox").click(function () {
		if ($(this).is(":checked")) {
			$("#removeBox").show();
		} else {
			$("#removeBox").hide();
		}
	});

	console.log("It's works")
}


function selectAllCheckBox() {
	$('#allCheckBoxes').click(function(){
	if($(this).is(':checked')) { $('input:checkbox').prop('checked', true);
		document.getElementById("removeBox").style.display = "block";
	} else { $('input:checkbox').prop('checked', false); 
		document.getElementById("removeBox").style.display = "none"; }
	});
	
	$("input[type='checkbox']").change(function(){
    var a = $("input[type='checkbox']");
    if(a.length == a.filter(":checked").length){
        $('#allCheckBoxes').prop('checked', true);
    }
    else {
        $('#allCheckBoxes').prop('checked', false);
    }
});
}

function checkSelectedCheckBoxes() {
	console.log("Selected checkBox:");
	
	var arraySelectedCheckBoxes = [];
	
	$.each($("input[name='allCheckBox']:checked"), function() {
		arraySelectedCheckBoxes.push($(this).val());
	});

	removeSelectedQuestion(arraySelectedCheckBoxes);
	arraySelectedCheckBoxes = [];

	function removeSelectedQuestion(test) {
		var posting = $.post("removeSelectedCheckBoxes.php", {
			arrayCheckBoxes: test
		});
		posting.done(function (data) {
			//console.log(data);
			$("#cl").empty().append(data);
			buttonViewCategory();
		});
	}
}

function actionCheckBox() {
	$('#allCheckBox').click(function(){
		if($(this).is(':checked')) { $('input:checkbox').prop('checked', true);
			document.getElementById("removeBox").style.display = "block";
		} else { $('input:checkbox').prop('checked', false); 
			document.getElementById("removeBox").style.display = "none"; }
		});
}

function saveNewCategory() {
	
	var cate = $("#category").val();
	console.log(cate);
	var posting = $.post("addNewCategory.php", {
		category: $("#category").val()
	});
		
	posting.done(function(data) {
		//console.log(data);
		$("#cl").empty().append(data);
		$("#createViewModalNewCategory").modal("hide");
	});
}

$(document).ready(function() {
	
	//readRecords();
	//readDatabase();
	
	//Session time; 
	var time = 15;
	var test = document.getElementById('cl');
	var label1 = document.getElementById('label1');
	let drawIntrernal;
	
	$("html").mouseup(function() {
		//test.append(" Clicked");
		//console.log("Time 100 and clicked.");
		time = 15;
		//time = 15;
		//clearInterval(timer);
	});
	
	
	//$('body').hide();
	//$(window).on("load", function() {
	//	$('body').show();
	//});
	
	
	//Displays the time after which the session will be expiring.
	document.getElementById('time').innerHTML = "Time session " + time + "s";
	
	//Interval every 1 second (1000 millisecond).
	drawIntrernal = setInterval(function() {
		var distance = time--;
		document.getElementById('time').innerHTML = "Time session " + distance + "s";
		
		if(distance < 0) {
			clearInterval(time);
			document.getElementById('time').innerHTML = "SESSION EXPIRED";

			doConfirm("Expired session, restore?", function yes()
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

	$('#checkBoxPer').change(function() {
		if($(this).prop("checked") == true) {
			$(this).val("admin");
			label.innerHTML = "admin permissions";			
		} else {
			$(this).val("user");
			label.innerHTML = "user permissions";
		}
	});
	
*/
}); 