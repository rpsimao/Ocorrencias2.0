$(function(){
	
	//$("#data_detectada").after('<span class="input-append"><span class="add-on"><i class="icon-calendar"></i></span></span>');
	
	
	$("#data_detectada").datepicker({ dateFormat: "yy-mm-dd" , 
    	dayNamesMin: ["Dom","Seg", "Ter", "Qua", "Qui", "Sex", "Sab"], 
    	monthNames:["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
    	monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
		
	});
	$('#data_detectada').datepicker($.datepicker.regional['pt']);
	
	
	$('#obra').keyup(function(){
		
		var charLength = $(this).val().length;
		var j_number = $('#obra').val();
		
		if (charLength == 5 )
			{
			
			$.ajax({
				type: 'GET',
				url: '/ajax/optimusjobdata',
				data: 'job=' + j_number,
				datatype: 'json',
				beforeSend: loading(),
				complete: function(){$('#job-data-msg').remove();},
				error: function(req, status, error){errorFunc(error);},	
				success: function(response) {
					
					var json = $.parseJSON(response);
					
					$("#entidade").val(translateCliente(json.j_customer));
					$("#trabalho").val(json.j_title1);
					$("#jobtype").val(json.j_type);
					//$("#lote").focus();
				 }
			  });
		 }
	});
});





function errorFunc(error)
{

	$('.bottom-right').notify({
	    message: {html: '<i class="icon-exclamation-sign"></i> Ocorreu um erro: <br />' + error },
	    type: 'error'
	  }).show();
}



function loading()
{
	$('.bottom-right').notify({
	    message: {html: '<i class="icon-spinner icon-spin"></i> A obter dados do Optimus...' },
	    type: 'info'
	  }).show();
	
	//$('<span class="label label-info sp-bottom-8" id="job-data-msg"><i class="icon-spinner icon-spin"></i> A obter dados do Optimus...</span>').insertBefore("#obra");


}


function validateForm()
{
	
	if($("#tipo_registo").val() == "")
		{
			msg = 'Tem de escolher o "Tipo de Registo."';
			$("#msg").html(_privateErrorMsg(msg));
			$("#tipo_registo_div").addClass("error");
			
			return false;
		}
	
	if($("#origem").val() == "")
	{
		msg = 'Tem de escolher a "Origem."';
		$("#msg").html(_privateErrorMsg(msg));
		$("#origem_div").addClass("error");
		
		return false;
	}
	
	if($("#sistema").val() == "")
	{
		msg = 'Tem de escolher o "Sistema."';
		$("#msg").html(_privateErrorMsg(msg));
		$("#sistema_div").addClass("error");
		
		return false;
	}
	
	if($("#entidade").val() == "")
	{
		msg = 'O campo "Cliente/Entidade" não pode estar vazio.';
		$("#msg").html(_privateErrorMsg(msg));
		$("#entidade_div").addClass("error");
		
		return false;
	}
	
	if($("#trabalho").val() == "")
	{
		msg = 'O campo "Trabalho" não pode estar vazio.';
		$("#msg").html(_privateErrorMsg(msg));
		$("#trabalho_div").addClass("error");
		
		return false;
	}
	
	if($("#descricao_problema").val() == "")
	{
		msg = 'O campo "Descrição do Problema" não pode estar vazio.';
		$("#msg").html(_privateErrorMsg(msg));
		$("#descricao_problema_div").addClass("error");
		
		return false;
	}
	
	if($("#data_detectada").val() == "")
	{
		msg = 'A data não está correcta (utilize AAAA-MM-DD)';
		$("#msg").html(_privateErrorMsg(msg));
		$("#data_detectada_div").addClass("error");
		
		return false;
	}
	
	if($("#detectado").val() == "")
	{
		msg = 'O campo "Detectado" não pode estar vazio.';
		$("#msg").html(_privateErrorMsg(msg));
		$("#detectado").addClass("error");
		
		return false;
	}


	 /*var currVal = $("#data_detectada").val();
	  if(currVal == ''){
		  msg = 'A data não está correcta (utilize AAAA-MM-DD)';
			$("#msg").html(_privateErrorMsg(msg));
			$("#data_detectada_div").addClass("error");
	    return false;
	  }
	  //Declare Regex  
	  var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/; 
	  var dtArray = currVal.match(rxDatePattern); // is format OK?

	  if (dtArray == null)
		  {
		  msg = 'A data não está correcta (utilize AAAA-MM-DD)';
			$("#msg").html(_privateErrorMsg(msg));
			$("#data_detectada_div").addClass("error");
		  }
	     return false;
	 
	  //Checks for mm/dd/yyyy format.
	  dtMonth = dtArray[1];
	  dtDay= dtArray[3];
	  dtYear = dtArray[5];

	  if (dtMonth < 1 || dtMonth > 12)
	  {
		  	msg = 'A data não está correcta (utilize AAAA-MM-DD)';
			$("#msg").html(_privateErrorMsg(msg));
			$("#data_detectada_div").addClass("error");
		  return false;
	   } 
	  if (dtDay < 1 || dtDay> 31)
	  {
		  	msg = 'A data não está correcta (utilize AAAA-MM-DD)';
			$("#msg").html(_privateErrorMsg(msg));
			$("#data_detectada_div").addClass("error");
		  return false;
	 } 
	  if ((dtMonth==4 || dtMonth==6 || dtMonth==9 || dtMonth==11) && dtDay ==31)
	  {
		  	msg = 'A data não está correcta (utilize AAAA-MM-DD)';
			$("#msg").html(_privateErrorMsg(msg));
			$("#data_detectada_div").addClass("error");
		  return false;
	 } 
	  if (dtMonth == 2)
	  {
	     var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
	     if (dtDay> 29 || (dtDay ==29 && !isleap))
	     {
	 	  	msg = 'A data não está correcta (utilize AAAA-MM-DD)';
	 		$("#msg").html(_privateErrorMsg(msg));
	 		$("#data_detectada_div").addClass("error");
	 	  return false;
	    } 
	  }*/
	  

}



function _privateErrorMsg(msg)
{
	var html = '<div class="alert alert-error">';
	html+='<button type="button" class="close" data-dismiss="alert">&times;</button>';
	html += '<i class="icon-warning-sign"></i> ';
	html+= msg;
	html += '</div>';
	
	return html;

}
