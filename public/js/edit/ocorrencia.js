$(function(){
		
	
	makeCal("data_detectada");
	makeCal("data_investigacao");
	makeCal("data_correccoes");
	makeCal("data_causas");
	makeCal("data_fecho");
	makeCal("data_acc_corr");
	makeCal("data_ac_melhoria");
	makeCal("prazo_ac_prev_corr");
	makeCal("prazo_ac_preventivas");
	makeCal("prazo_ac_melhoria");
	makeCal("data_ac_prev_corr");
	makeCal("dataacpreventivas");
	makeCal("respcliente");
	

	if ($("#jobtype").val() != "")
		{
			$("#get-job-type-button").hide();
		}
	
	
	var obra = $("#obra").val();
	
	if (obra =="" || obra == 0 || obra == ".")
		{
		 $("#get-job-type-button").hide();
		}
	
	
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
				beforeSend: loadingOptimus(),
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
	

	/*switch ($('#tipo_registo').val())
		{
			case "ocorrencia":
				$("#title_accordion_accoes_correctivas").hide();
				$("accordion_accoes_correctivas").hide();
				$("#notificacao-label").hide();
				$("#notificacao").hide();
				$("#rejeicao-label").hide();
				$("#rejeicao").hide();
				$("#nao_aceite-label").hide();
				$("#nao_aceite").hide();
			break;	
			
			case "nao_conformidade":
				$("#title_accordion_accoes_preventivas").hide();
				$("accordion_accoes_preventivas").hide();
				$("#notificacao-label").hide();
				$("#notificacao").hide();
				$("#nao_aceite-label").hide();
				$("#nao_aceite").hide();
				$("#reavaliacao-label").hide();
				$("#reavaliacao").hide();
				$("#reavaliacao-label").hide();
				$("#reavaliacao").hide();
				
			break;	
			
			case "reclamacao":
				$("#title_accordion_accoes_preventivas").hide();
				$("accordion_accoes_preventivas").hide();
				$("#reavaliacao-label").hide();
				$("#reavaliacao").hide();
				$("#registo-label").hide();
				$("#registo").hide();
			break;	
		}

*/

	
	
	/*if ($('#trabalho').val() == 'ANULADA')
		{
			$("#origem").html("");
			$('<option value="anulada">Anulada</option>').appendTo("#origem");
			$("#sistema").html("");
			$('<option value="anulada">Anulada</option>').appendTo("#sistema");
			$("#tipo_registo").html("");
			$('<option value="anulada">Anulada</option>').appendTo("#tipo_registo");
		}*/
	




});





function anularOcorrencia()
{		
		$('#tipo_registo').val('Anulada');
		$('#origem').val('Anulada');
		$('#sistema').val('Anulada');
		$("#doc_referencia").val('ANULADA');
		$("#obra").val('');
		$("#entidade").val('ANULADA');
		$("#trabalho").val('ANULADA');
		$("#lote").val('');
		$("#qtd_recebida").val('');
		$("#qtd_reclamada").val('');
		$("#qtd_falta").val('');
		$("#ordem_compra").val('');
		$("#amostra_disponivel").attr('checked', false);
		$("#situacao_recorrente").attr('checked', false);
		$("#data_detectada").val('');
		$("#descricao_problema").val('');
		$("#notificacao").attr('checked', false);
		$("#rejeicao").attr('checked', false);
		$("#nao_aceite").attr('checked', false);
		$("#registo").attr('checked', false);
		$("#reavaliacao").attr('checked', false);
		$("#detectado").val('');
		$("#cod_def").val('');
		$("#investigacao_efectuada").val('');
		$("#data_investigacao").val('');
		$("#preenchido_investigacao").val('');
		$("#correcoes").val('');
		$("#data_correccoes").val('');
		$("#custo_correccoes").val('');
		$("#resp_correccoes").val('');
		$("#id_causas").val('');
		$("#data_causas").val('');
		$("#responsavel_causas").val('');
		$("#seccao_causas").val('');
		$("#impacto_ambiental").val('');
		$("#perigos").val('');
		$("#def_ac_prev_corr").val('');
		$("#data_ac_prev_corr").val('');
		$("#resp_ac_prev_corr").val('');
		$("#custo_ac_prev_corr").val('');
		$("#def_ac_preventivas").val('');
		$("#data_ac_preventivas").val('');
		$("#resp_ac_preventivas").val('');
		$("#custo_ac_preventivas").val('');
		$("#def_ac_melhoria").val('');
		$("#data_ac_melhoria").val('');
		$("#resp_ac_melhoria").val('');
		$("#custo_ac_melhoria").val('');
		$("#info_adicional").val('');
		$("#resultado").val('');
		$("#evento_fechado").attr('checked', false);
		$("#custo_total").val('');
		$("#resp_fecho").val('');
		$("#data_fecho").val('');
		$("#eficaz-1").attr('checked', false);
		$("#eficaz-2").attr('checked', false);
		$("#eficaz-3").attr('checked', false);
		$("#def_ac_prev_corr").val('');
		$("#data_ac_prev_corr").val('');
		$("#resp_ac_prev_corr").val('');
		$("#custo_ac_prev_corr").val('');
		$("#prazo_ac_prev_corr").val('');
		$("#fechado_ac_prev_corr").attr('checked', false);
		$("#fechado_ac_melhoria").attr('checked', false);
		$("#prazo_ac_prev_corr").val('');
		$("#prazo_ac_melhoria").val('');
		$("#respcliente").val('');
		$("#abertura_obra-0").attr('checked', false);
		$("#abertura_obra-1").attr('checked', false);
		$("#jobtype").val('');
		$("#matcert").attr('checked', false);
		$("#prazo_ac_preventivas").val('');
		$("#fechado_ac_preventivas").attr('checked', false);
		
		
		
		$("#anulada").val(1);
		
		/*$("#dialog").dialog("destroy");
		
		$("#dialog-message").dialog({
			modal: true,
			resizable: false,
			buttons: {
				Ok: function() {
					$(this).dialog('close');
					$('#descricao_problema').focus();
					$("#descricao_problema").get(0).value = "Escrever aqui o motivo da anulação.";
					$('#descricao_problema').select();
				}
			}
		
		});*/
		
		$('#modal-anulada').modal({show: true});
		$('#modal-anulada').on('hidden', function(){
			$('#descricao_problema').focus();
			$("#descricao_problema").get(0).value = "Escrever aqui o motivo da anulação.";
			$('#descricao_problema').select();
			$('#anulada').val(1);
			$('html,body').animate({scrollTop: $("#tab1").offset().top},'slow');
			
		});

}


function custo()
{
	var obra       = $("#obra").val();
	var qtdfalta   = $('#qtd_falta').val();
	var custoTotal = $('#custo_total');
	
	
	$.ajax({
		type: 'GET',
		url: '/ajax/custo',
		data: {j : obra, qtd : qtdfalta},
		beforeSend: loading(),
		dataType: 'text',
		
		success: function(response) {
			
			custoTotal.val(response);
		}
	});
}

function loading()
{
	$('.bottom-right').notify({
	    message: {html: '<i class="icon-spinner icon-spin"></i> A calcular custo total...' },
	    type: 'info'
	  }).show();
	
	//$('<span class="label label-info sp-bottom-8" id="job-data-msg"><i class="icon-spinner icon-spin"></i> A obter dados do Optimus...</span>').insertBefore("#obra");


}

function loadingOptimus()
{
	$('.bottom-right').notify({
	    message: {html: '<i class="icon-spinner icon-spin"></i> A obter dados do Optimus...' },
	    type: 'info'
	  }).show();
	
	//$('<span class="label label-info sp-bottom-8" id="job-data-msg"><i class="icon-spinner icon-spin"></i> A obter dados do Optimus...</span>').insertBefore("#obra");


}






