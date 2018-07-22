$("#have-query").click(function(){
	$("#have-query").fadeOut();
	$("#query-form").slideDown();
	$("#query-heading").html("Enter the details below");
});

$("#btn-submit").click(function(){
	sendform();
	return false;
});

function sendform(){
		$("#query-form").slideUp();
		$("#query-heading").html('We will get back to You, shortly.<br><i class="fa fa-smile-o fa-3x"></i>');
}
