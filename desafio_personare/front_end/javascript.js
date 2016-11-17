$(document).ready(function(){
	$('form').submit(function(event){
		event.preventDefault();
		
		var data = {
			    valor: $('input[id=valor]').val(),
				cotacao: $('input[id=cotacao]').val(),
				tipo_de: $('select[id=tipo_de]').val(),
				tipo_para: $('select[id=tipo_para]').val()
		    };
			
		if (isNaN(data['valor']) || isNaN(data['cotacao'])) {
			alert('Insira apenas números para a conversão');
			return false;
		}
		
		$.ajax({
			url      : 'back_end/conexao_com_cliente.php',
			data     : data,
			dataType : 'json', 
			type     : 'GET',
			success  : function(json){
				$.each(json, function(ind, valor){
					document.getElementById("resposta").innerHTML = 'O valor foi convertido para ' + valor;
					console.log(valor);
				});
			}
		});
	});
});
