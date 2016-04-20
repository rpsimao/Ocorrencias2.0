$(function() {
   
	
	$("#user-label").hide();
	$("#user").hide();
	
	
	
	$("#tipo-externo").change(function(){
		
		$("#user-label").fadeIn();
		$("#user").fadeIn();
		
	});
	
	$("#tipo-interno").change(function(){
		
		$("#user-label").fadeOut();
		$("#user").fadeOut();
		
	});
	
	
	
	
});


function checkUser()
{
	
	radioVal = $('input[name=tipo]:checked', '#export-form').val();
	
	
	if ( radioVal == "externo" && $("#user").val() == "")
		{
			alert("Escolha o operador.");
			return false;
		
		}
	
	

}