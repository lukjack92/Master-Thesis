"use strict";
$(document).ready(function() {
    var test = document.getElementById('cl');
	
	$("html").mouseup(function() {
		test.append(" Clicked");
		console.log("Time 100 and clicked.");
	});
});