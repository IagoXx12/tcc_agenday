<?php
	session_start();
	if($_SESSION['email']){
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- css -->
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/lote.css">
		<link rel="stylesheet" href="css/menu.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
		integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/brands.min.css"
		integrity="sha512-9YHSK59/rjvhtDcY/b+4rdnl0V4LPDWdkKceBl8ZLF5TB6745ml1AfluEU6dFWqwDw9lPvnauxFgpKvJqp7jiQ=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
		<style>
			ul li.item-menu a {
		 		padding: 20px 34px !important;
			}

			ul li.item-menu::after {
				margin-left: 34px !important;

			}

			ul li.ativo::before {
				margin-left: 34px !important;
			}''

			@media screen and (max-width: 480px) {
				ul li.item-menu a {
			    	padding: 20px .1rem !important;
			  	}

				ul li.item-menu::after {
			    	margin-left: 0px !important;
			  	}

			  	ul li.ativo::before {
			    	margin-left: 0 px !important;
			  	}
			}
		</style>
	<!-- /css -->

	<!-- js -->
		<script src="https://unpkg.com/scrollreveal"></script>
		<script type="text/javascript" src="js/jquery-3.6.1.min.js"></script>
	    <script type="text/javascript">
	  		$(document).ready(function(){
	  			$('#exibeBotao').hide();
	  			
	          	//ENVIAR CSV
	    		$('#add_usuarios').submit(function (e) {
	      			e.preventDefault();
					var formulario = new FormData(this); // Crie um objeto FormData com os dados do formulário
	          		$.ajax({
		            	type: 'POST',
		            	url: 'php/ler_novosAlunos.php',
		            	data: formulario,
		            	contentType: false,
		            	processData: false,
		          	}).done(function(tabela){         
		            	$(".exibe").html(tabela);
		            	$('#exibeBotao').show();
		          	}).fail(function(jqXHR, textStatus ) {
		            	console.log("Request failed: " + textStatus);
		          	});
		        });

				$('#enviarUsuarios').click(function() {
	            	var usuarios = [];
	            	$('#tabelaUsuarios tbody tr').each(function() {
	                	var cod = $(this).find('.codigo').text();
	                	var nome = $(this).find('.nome').text();
						var tipo = $(this).find('.tipoUsuario').find('.select').val();
						var turma = $(this).find('.turma').find('.select').val();
	                	var email = $(this).find('.email').text();

						var user = {
							cod: cod,
							nome: nome,
							tipo: tipo,
							turma: turma,
							email: email
						};

	                  	usuarios.push(user);
	              	});

	              	$.ajax({
	                	type: 'POST',
	                	url: 'php/cadastrar_lote.php',
	                	data: { usuarios: usuarios },
	              	}).done(function(resposta){         
	                	$("#resposta").html(resposta);
	              	}).fail(function(jqXHR, textStatus ) {
	                	console.log("Request failed: " + textStatus);
	              	});
	          	});
	      	});
	    </script>
	<!-- /js -->
	<title>Gerenciamento</title>
</head>

<body>
	<section class="-container">
    <!-- INICIO MENU  -->
    <nav class="menu-lateral">
      <div class="btn-expandir">
        <i class="bi bi-list" id="btn-exp"></i>
      </div>
      <ul>
      <li class="item-menu ativo">
				<a href="adm-perfil.php">
				<span class="icon"><i class="bi bi-person-fill"></i></span>
				<span class="txt-link">Usuário</span>
				</a>
			</li>
			<li class="item-menu">
				<a href="adm-calendario.php">
					<span class="icon"><i class="bi bi-house-door-fill"></i></span>
					<span class="txt-link">Calendário</span>
				</a>
			</li>
        <li class="item-menu">
				<a href="adm-comunicados.php">
				<span class="icon"><i class="bi bi-megaphone-fill"></i></span>
				<span class="txt-link">Comunicados</span>
				</a>
			</li>
			<li class="item-menu ">
				<a href="adm-apm.php">
				<span class="icon"><i class="bi bi-cart4"></i></span>
				<span class="txt-link">APM</span>
				</a>
			</li>
			<li class="item-menu">
				<a href="adm-gestao.php">
				<span class="icon"><i class="bi bi-person-workspace"></i></span>
				<span class="txt-link">Gestão</span>
				</a>
			</li>
        <li class="item-menu">
				<a href="adm-duvidas.php">
				<span class="icon"><i class="bi bi-question-lg"></i></span>
				<span class="txt-link">Dúvidas</span>
				</a>
			</li>
			<?php
			// Verifica se o 'id_nivel' do usuário é igual a 1
			if ($_SESSION['id_nivel'] == 1) {
				?>
				<li class="item-menu">
					<a href="adm-gerenciamento.php">
					<span class="icon"><i class="bi bi-gear-fill"></i></span>
					<span class="txt-link">Gerenciamento</span>
					</a>
				</li>
<?php
}?>
			<li class="item-menu">
				<a href="php/logout.php">
				<span class="icon"><i class="bi bi-box-arrow-right"></i></span>
				<span class="txt-link">Sair</span>
				</a>
			</li>
			</ul>
    </nav>
    <!-- FIM DO MENU -->
	</section>

	<section class="adm-container">
		<div class="adm">
			<div class="adm-title row">
	  				<h1>Cadastro de Alunos</h1>
			</div>
		</div>
		<div class="adm-img">
			<img src="img/spreadsheets-animate.svg" alt="Figura Inicial" class="adm-element">
		</div>
		<div class="col mt-5">
			<!-- upload -->
			<form id="add_usuarios" class="row form-container" enctype='multipart/form-data'>
                <div class="input-group mb-3">
                    <input type="file" name="registro_alunos" class="form-control" id="registro_alunos">
				</div>
                <button type="submit">Enviar</button>
			</form>
			<!-- fim do upload -->
			
			<!-- table -->
			<div class="row exibe tabela-gera mt-4">
				
			</div>
			<!-- fim da table -->

			<div class="row" id="exibeBotao">
				<button id="enviarUsuarios">Salvar Alterações</button>
			</div>
			<div id="resposta">
				
			</div>
		</div>
  	</section>

	<!-- FIM DA PÁGINA!! -->
  	<!-- js -->
	<script>
	    function habilitarEdicao(td) {
			// Define o atributo contentEditable como true para habilitar a edição.
			td.contentEditable = true;
			// Adiciona uma classe CSS para indicar que a célula está em modo de edição.
			td.classList.add('editavel');
			// Define o foco na célula para que o usuário possa começar a editar imediatamente.
			td.focus();

			// Defina um ouvinte de evento de teclado para detectar a tecla "Enter" e desabilitar a edição.
			td.addEventListener('keydown', function (event) {
			    if (event.key === "Enter") {
			        event.preventDefault(); // Evita que a quebra de linha seja inserida
			        desabilitarEdicao(td);
			    }
			});

			// Defina um evento de clique para desabilitar a edição quando a célula perder o foco.
			td.addEventListener('blur', function () {
			    desabilitarEdicao(td);
			});
		}

	    function desabilitarEdicao(td) {
	        // Define o atributo contentEditable como false para desabilitar a edição.
	        td.contentEditable = false;
	        // Remove a classe CSS de edição.
	        td.classList.remove('editavel');
	    }

		function apagarLinha(elementoClicado){
			elementoClicado.closest("tr").remove();
		}
	</script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.7.1/jquery.min.js" integrity="sha512-BkBgWiL0N/EFIbLZYGTgbksKG5bS6PtwnWvVk3gccv+KhtK/4wkLxCRGh+kelKiXx7Ey4jfTabLg3AEIPC7ENA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="js/lote.js"></script>
	<script src="js/menu.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
<?php
  }
?>s