$(function(){
	var chk = $("#evento_fechado");
	var txt = $("#id_causas");
	
	
	chk.click(function(){
		
		if (!txt.val())
			{
				
			$('.top-right').notify({
			    message: { html: '<i class="icon-warning-sign"></i>&nbsp;&nbsp;&nbsp;<b>Para poder fechar uma Ocorrência, tem de preencher as Causas.</b>' },
			    type: 'error'
			  }).show();
				chk.attr('checked', false);
			}
	});
	
});



function makeCal(id)
{
	

	$("#" + id).datepicker({ dateFormat: "yy-mm-dd" , 
    	dayNamesMin: ["Dom","Seg", "Ter", "Qua", "Qui", "Sex", "Sab"], 
    	monthNames:["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
    	monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
		
	});
	$('#'+id).datepicker($.datepicker.regional['pt']);

}


function onlyInt(id)
{
	
	$("#"+id).keypress(function (e)  
			{
				if(e.which!=8 && e.which!=0 && e.which!=44 && e.which!=46 && e.which!=13 && (e.which<48 || e.which>57))
			{
					$('.bottom-right').notify({
					    message: { html: '<i class="icon-warning-sign"></i>&nbsp;&nbsp;&nbsp;<b>Apenas números.</b>' },
					    type: 'error'
					  }).show();
					
					return false;
					}
			});

}



function displayMsg(icon, msg)
{
	
	var html = '<div class="alert alert-error">';
	html+= '<button type="button" class="close" data-dismiss="alert">&times;</button>';
    html+= '<i class="'+icon+'"></i> ' + msg;
    html+= '</div>';

    return html;

}




function onlyFloat(id)
{
	
	$("#"+id).keypress(function(event) {
	    if(event.which < 46
	    || event.which > 59) {
	        event.preventDefault();
	    } // prevent if not number/dot

	    if(event.which == 46
	    && $(this).val().indexOf('.') != -1) {
	        event.preventDefault();
	    } // prevent if already dot
	});



}

function translateCliente(cliente)
{
	
	var cli = $.ajax({
		type: 'GET',
		url: '/ajax/cliente',
		data: 'c=' + cliente,
		dataType: 'html',
		async: false,
		}).responseText;

	return cli;

}

function getJobType()
{

	var job = $("#obra").val();
	
	var type = $.ajax({
		type: 'GET',
		url: '/ajax/optimusjobtype',
		data: 'job=' + job,
		dataType: 'html',
		async: false,
		}).responseText;

	$("#jobtype").val(type);
	$("#get-job-type-button").fadeOut();

}


function searchNumber()
{
	
	$('#numeromodal').modal('show');
	$('#numeromodal').on('shown', function(){
		$('#numero-modal-search').focus();
		
		
	});
}


function validateNumberSearch()
{

   
    
    if($("#numero-modal-search").val() == ""){

            
        
        $("#numero-modal-errors-form").html(displayMsg("icon-warning-sign", 'O campo <b>"Número"</b> não pode estar vazio.'));
        $("#numero-modal-search").addClass("error");
        $("#numero-modal-search").focus();
        return false;   
    }
}


function searchCliente()
{
	
	$('#clientemodal').modal('show');
	$('#clientemodal').on('shown', function(){
		$('#customer-modal-search').focus();
		
		
	});
}

function validateCustomersSearch()
{
	var cust = $("#customer-modal-search");
	var mes = $("#customer-modal-mes");
	var ano = $("#customer-modal-ano");
	var oc = $("#customer-modal-oc");
   
    
    if(cust.val() == ""){

        	    
        $("#clientemodal-errors-form").html(displayMsg("icon-warning-sign", 'O campo <b>"Cliente"</b> não pode estar vazio.'));
        cust.addClass("error");
        cust.focus();
        return false;   
    }
    
    
    if(mes.val() !="" && oc.val() !=""){
    	
    		    
        $("#clientemodal-errors-form").html(displayMsg("icon-warning-sign", 'Não pode selecionar a <b>"Data"</b> e a <b>"Ordem de Compra"</b> em simultâneo.'));
    	return false;
    }
    
    if(ano.val() !="" && oc.val() !=""){
    	
    		    
        $("#clientemodal-errors-form").html(displayMsg("icon-warning-sign", 'Não pode selecionar a <b>"Data"</b> e a <b>"Ordem de Compra"</b> em simultâneo.'));
    	return false;
    }
    
    if(ano.val() !="" && oc.val() !="" && mes.val() !=""){
    	
    		    
        $("#clientemodal-errors-form").html(displayMsg("icon-warning-sign", 'Não pode selecionar a <b>"Data"</b> e a <b>"Ordem de Compra"</b> em simultâneo.'));
    	return false;
    }
    
    if(ano.val() =="" && mes.val() !=""){
    	
    	    
        $("#clientemodal-errors-form").html(displayMsg("icon-warning-sign", 'Tem de selecionar o <b>"Ano"'));
    	return false;
    }
    
}



function searchJob()
{
	
	$('#jobmodal').modal('show');
	$('#jobmodal').on('shown', function(){
		$('#job-modal-search').focus();
		
		
	});
}





function validateJobSearch()
{

   
    
    if($("#job-modal-search").val() == ""){

       	    
        $("#jobmodal-errors-form").html(displayMsg("icon-warning-sign", 'O campo "Obra" não pode estar vazio.'));
        $("#job-modal-search").addClass("error");
        $("#job-modal-search").focus();
        return false;   
    }
    
    
    
}





function searchDates()
{
	
	$('#datesmodal').modal('show');
	makeCal("dates-modal-search1");
	makeCal("dates-modal-search2");
}





function validateDatesSearch()
{

   if($("#dates-modal-search1").val() == "" || $("#dates-modal-search2").val() == ""){

            
        $("#datesmodal-errors-form").html(displayMsg("icon-warning-sign", 'O campo "Data" não pode estar vazio.'));
        
        return false;   
    }
}

function validateEditModal(id)
{
	
	var input = $("#edit-modal-passwd-" + id);
	
	var passwd = $.ajax({
		type: 'GET',
		url: '/ajax/validatepasswd',
		data: 'p=' + input.val() ,
		dataType: 'html',
		async: false,
		}).responseText;

	
	
		
	if (input.val() == "")
		{
		   $("#datesmodal-errors-form").html(displayMsg("icon-warning-sign", 'O campo <b>"Password"</b> não pode estar vazio.'));
	        input.focus();
	        
	        return false;   
		}
	
	if (passwd == false)
	{
	 	    
        $("#datesmodal-errors-form").html(displayMsg("icon-lock", 'Não tem permissão para aceder a este recurso'));
        input.select();
        
        return false;   
	}

	

}


function checkRepeatJob()
{
	
	var obra = $("#obra");
	
	var validate = $.ajax({
		type: 'GET',
		url: '/ajax/checkrepeatjob',
		data: 'job=' + obra.val() ,
		dataType: 'html',
		async: false,
		}).responseText;
	
	if (validate == 1)
		{
		$('#msg').notify({
		    message: {html: '<i class="icon-exclamation-sign"></i> Já existe uma Ocorrência para esta obra.' },
		    type: 'warning',
		    fadeOut: 500,
		  }).show();
		
		$("#obra_div").addClass("warning");
		
		
		}


}