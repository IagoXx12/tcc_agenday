<?php
session_start();
include('php/conexao.php');

// Verifica se o usuário está autenticado
if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit(); // Certifique-se de sair do script após redirecionar
} else {
    // Obtém informações do usuário logado (presumindo que 'id_nivel' seja um campo na tabela de usuários)
    $email = $_SESSION['email'];
    $stmt = $conn->prepare("SELECT id_nivel FROM tb_usuario WHERE ds:email = :email");
    $stmt->execute(array(':email' => $email));
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o 'id_nivel' do usuário é igual a 1
    if ($_SESSION['id_nivel'] == 2) {
        header('Location: index.php');
        exit(); // Certifique-se de sair do script após redirecionar
    }?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Comunicados</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- css -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/comunicado.css">
	<link rel="stylesheet" href="css/menu.css">
	<link rel="stylesheet" href="css/selectcheck.css">
	    <link rel="stylesheet" href="css/selectcheck.css">



	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/brands.min.css" integrity="sha512-9YHSK59/rjvhtDcY/b+4rdnl0V4LPDWdkKceBl8ZLF5TB6745ml1AfluEU6dFWqwDw9lPvnauxFgpKvJqp7jiQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- /css -->

	<!-- js -->
	<script src="https://unpkg.com/scrollreveal"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js"></script>
	<script src="js/jquery.maskMoney.min.js"></script>

	<script>
	$(document).ready(function(){

//ADD COMUNICADO
$('#addComunicado').submit(function (e) {
	e.preventDefault();

	var formulario = new FormData(this); // Crie um objeto FormData com os dados do formulário
	$.ajax({
		type: 'POST',
		url: 'php/add_comunicado.php',
		data: formulario,
		contentType: false,
		processData: false,
	}).done(function(resposta){
		//Recarregar página
		$("#exibe").html(resposta);
	}).fail(function(jqXHR, textStatus ) {
		console.log("Request failed: " + textStatus);
	});
});

//UPDATE COMUNICADO

//Pegar os valores dos inputs
$(".alterar").on("click", function(){
	$("#exibir_cod").text($(this).attr('cod'));
	$("#exibir_path").text($(this).attr('imagem'));
	$("#alterarTitulo").val($(this).attr('titulo'));
	$("#alterarData").val($(this).attr('dt_comunicado'));
	$("#alterarDescricao").val($(this).attr('descricao'));

	//SELECT TURMAS
	var turmasString = $(this).attr('turmas');
	var turmasArray = turmasString.split('-');

	for (var i = 0; i < turmasArray.length; i++) {
		$("input[name='turmasAlterar[]'][value='" + turmasArray[i] + "']").prop('checked', true);
	}
});

//Atualizar valores
$('#alterarComunicado').submit(function (e) {
	e.preventDefault();

	var formulario = new FormData(this);
	formulario.append('codigo', $("#exibir_cod").text());
	formulario.append('imagemAntiga', $("#exibir_path").text());
	
	$.ajax({
		type: 'POST',
		url: 'php/alterar_comunicado.php',
		data: formulario,
		contentType: false,
		processData: false,
	}).done(function(resposta){
		$("#exibe2").html(resposta);
	}).fail(function(jqXHR, textStatus ) {
		console.log("Request failed: " + textStatus);
	});
});
$('#turma').change(function() {
var opcao = $(this).val();
$('.comunicado').hide(); // Oculta 
if (opcao === 'Todos') {
$('.comunicado').show(); // Mostra todos os registros quando "todos" for selecionado
} else {
$('.comunicado-turma-' + opcao).show(); // Mostra apenas a opção selecionada
}
});
$('#ordem').change(function(){
var ordem = $(this).val();

});
});
</script>
	<!-- /js -->
	</head>
<body>
	<section class="-container">
    <!-- INICIO MENU  -->
    <nav class="menu-lateral">
			<div class="btn-expandir">
			  <i class="bi bi-list" id="btn-exp"></i>
			</div>
			<ul>
			<li class="item-menu">
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
			  <li class="item-menu ativo">
					  <a href="adm-comunicados.php">
					  <span class="icon"><i class="bi bi-megaphone-fill"></i></span>
					  <span class="txt-link">Comunicados</span>
					  </a>
				  </li>
				  <li class="item-menu">
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
				  <li class="item-menu">
					  <a href="adm-gerenciamento.php">
					  <span class="icon"><i class="bi bi-gear-fill"></i></span>
					  <span class="txt-link">Gerenciamento</span>
					  </a>
				  </li>
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
	</section>
	<main class="body">
     <div class="wave"></div>
     <div class="wave"></div>
     <div class="wave"></div>
  </div>
<section >		
	
    	<div class="comuni">
			<h1>Comunicados</h1>
    	</div>

		<!-- search bar-->
<div class="centro-search mt-5">

<div class="inner-form">
	<div class="input-field">
<button class="btn-search" type="button">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
<path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
</svg>
</button>
<input id="search" type="text" placeholder="Pesquise aqui"/>
</div>
</div>
<div class="suggestion-wrap">
<span>Etec</span>
<span>Evento</span>
<span>Escolar</span>
<span>Aviso</span>
<span style="background:red" id="clearSearch">Limpar <i class="bi bi-x-circle-fill"></i></span>
</div>
</div>

<!-- fim da search bar-->
<div class="tempo">
		<?php

		$OrdemPadrao = isset($_GET['ordem']) ? $_GET['ordem']: 'todos';

		switch ($OrdemPadrao) {
			case 'Recente':
				$sql = "SELECT * FROM tb_comunicado ORDER BY cd_comunicado DESC ";
				break;
			
			case 'Antigo':
				$sql = "SELECT * FROM tb_comunicado ORDER BY cd_comunicado ASC ";
				break;

			default:
				$sql = "SELECT * FROM tb_comunicado ORDER BY cd_comunicado DESC ";
				break;
		}
			
			foreach ($conn->query($sql) as $item){
				//pegar a array de turmas selecionadas no comunicado
				$stmt = $conn->prepare("SELECT id_turma FROM tb_comunicado_turma WHERE id_comunicado = :id");
				$stmt->execute(array(
					':id' => $item['cd_comunicado']
				));
				$turmasAlterar = $stmt->fetchAll(PDO::FETCH_COLUMN);
				$turmasString = implode('-', $turmasAlterar);
				?>
				<section class="comunicado horizontal borda-gradient">
					<div class="comunicado-image">
						<img src="<?php echo $item['ds_imagem'];?>" alt="Imagem do comunicado">
					</div>
					<div class="comunicado-content">
						<div class="comunicado-header">
							<h2><?php echo $item['nm_titulo'];?></h2>
							<?php
								list($ano, $mes, $dia) = explode('-', $item['dt_postagem']);
								$postagem = $dia."-".$mes."-".$ano;
							?>
							<p class="date"><?php echo $postagem;?></p>
						</div>
						<p class="comunicado-text"><?php echo $item['ds_descricao'];?></p>
						<button class="alterar" data-bs-toggle="modal" data-bs-target="#editModal" style="border:none;" cod="<?php echo $item['cd_comunicado'];?>" titulo="<?php echo $item['nm_titulo'];?>" descricao="<?php echo $item['ds_descricao']?>" dt_comunicado="<?php echo $item['dt_comunicado']?>" turmas="<?php echo $turmasString;?>" imagem="<?php echo $item['ds_imagem'];?>">
							<i class="bi bi-pencil-square edit-icon"></i>
						</button>
						<a href="#" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"><i class="bi bi-trash-fill delete-icon"></i></a>  
					</div>
				</section>
				<!-- Modal De Exclusao -->
	<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content custom-modal">
			  <div class="modal-circle">
				  <i class="bi bi-x-circle mt-5" style="color: #ff0000; font-size:5em;display: flex; align-items: center; justify-content: center;"></i>
			  </div>
				<div class="modal-header" style="background-color: #fff; border: none; text-align: center; justify-content: center;">
					<h5 class="modal-title" style="color:#000; font-size:1.5em ">Você tem certeza?</h5>
				</div>
				<div class="modal-body" style="text-align: center;">
					<p>Você realmente deseja excluir esses registros? Este processo não pode ser desfeito.</p>
				</div>
				<div class="modal-footer" style="border: none; justify-content: center;">
				  <a href="php/delete_comunicado.php?cod=<?php echo $item['cd_comunicado'];?>"><button type="button" class="btn btn-danger">Sim, Excluir</button></a>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
				</div>
			</div>
		</div>
	</div>
	</div>
	<?php
			}
			?>	
	<!-- fim do Modal De Exclusao -->
    	<!-- Modal de Alteração -->
    	<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      		<div class="modal-dialog modal-dialog-centered">
				<form  id="alterarComunicado" enctype="multipart/form-data">
					<div class="modal-content">
						<div class="modal-header">
							<h1 class="modal-title fs-5" id="editModalLabel">Editar Comunicado</h1>
							<button type="button" class="btn-close btn-close-white close-button" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="mb-3">
								<label for="alterarImagem" class="form-label">Alterar Imagem do Comunicado</label>
								<div class="input-group">
									<input type="file" name="alterarImagem" class="form-control" id="alterarImagem" accept="image/*">
									<button class="btn btn-outline-secondary" type="button" id="editButton">
										<i class="bi bi-pencil"></i> <!-- Ícone de editar -->
									</button>
								</div>
							</div>
							<div class="mb-3">
								<label for="alterarTitulo" class="form-label">Alterar Título do Comunicado</label>
								<input type="text" name="titulo" class="form-control" id="alterarTitulo">
							</div>
							<div class="row mb-3 altura-curso">
								<div class="col">
									<label for="alterarData" class="form-label">Data</label>
									<input type="date" name="data_comunicado" class="form-control" id="alterarData">
								</div>
							<div class="col">
									<div class="select-btn">
										<span class="btn-text">Selecionar Curso</span>
										<i class="bi bi-chevron-down"></i>
									</div>
									<ul class="list-itens">
										<li class="a" id="all-select3" style="cursor:pointer;">
											<label class="form-check-label" for="selectAllOptions" style="cursor:pointer;">Todos</label>
										</li>
										<?php
											//exibir o select
											$sql = "SELECT * FROM tb_turma";

											foreach ($conn->query($sql) as $item){?>
												<li class="item">
													<!-- Checkbox oculto -->
													<input type="checkbox" class="checkbox" name="turmasAlterar[]" value="<?php echo $item['cd_turma'];?>" id="<?php echo $item['nm_turma'];?>">
													<label class="checkbox-label" for="<?php echo $item['nm_turma'];?>"></label>
													</span>
													<span class="item-text"><?php echo $item['nm_turma'];?></span>
												</li>
											<?php
											}
										?>
									</ul>
								</div>
							</div>
							<br>
							<div class="mb-3">
								<label for="alterarDescricao" class="form-label">Alterar Descrição</label>
								<textarea name="descricao" class="form-control" id="alterarDescricao" rows="4"></textarea>
							</div>
							<p id="exibir_cod" style="display: none;"></p>
							<p id="exibir_path" style="display: none;"></p>
						</div>
							<div id="exibe2"></div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-roxo" id="salvarAlterar">Salvar Alterações</button>
							<button type="button" class="btn btn-azul" data-bs-dismiss="modal" id="fecharAlterar">Cancelar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
    	<!-- Fim do modal de Alteração -->


		<!-- inIcio do modal ADD -->
		<button type="button" class="btn btn-primary add" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
			<i class="bi bi-plus-circle-fill"></i> <!-- Ícone de adição -->
		</button>

		<!-- Modal ADD -->
		<div class="modal fade adcomuni" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
		aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<form  id="addComunicado" enctype="multipart/form-data">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="staticBackdropLabel">Adicionar Comunicado</h1>
						<button type="button" class="btn-close btn-close-white close-button" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
						<div class="modal-body">
							<div class="mb-3">
								<label for="imageInput" class="form-label">Imagem do Comunicado</label>
								<div class="input-group">
									<input type="file" name="ds_imagem" class="form-control">
									<button class="btn btn-outline-secondary" type="button" id="editButton">
										<i class="bi bi-pencil"></i> <!-- Ícone de editar -->
									</button>
								</div>
							</div>
							<div class="mb-3">
								<label for="nm_titulo" class="form-label">Título do Comunicado</label>
								<input type="text" name="titulo" class="form-control" id="nm_titulo">
							</div>
							<div class="row mb-3 altura curso">
								<div class="col">
									<label for="dt_comunicado" class="form-label">Data</label>
									<input type="date" name="data_comunicado" class="form-control" id="dt_comunicado">
								</div>
								<div class="col">
									<div class="select-btn">
										<span class="btn-text">Selecionar Curso</span>
										<i class="bi bi-chevron-down"></i>
									</div>
									<ul class="list-itens" style="position: absolute !important;
    width: 190px !important;">
										<li class="a" id="all-select4" style="cursor:pointer;">
											<label class="form-check-label" for="selectAllOptions"
												style="cursor:pointer;">Todos</label>
										</li>
										<?php
											$sql = "SELECT * FROM tb_turma";

											foreach ($conn->query($sql) as $item){?>
												<li class="item">
													<!-- Checkbox oculto -->
													<input type="checkbox" class="checkbox" name="turmas[]" value="<?php echo $item['cd_turma'];?>" id="<?php echo $item['nm_turma'];?>">
													<label class="checkbox-label" for="<?php echo $item['nm_turma'];?>"></label>
													</span>
													<span class="item-text"><?php echo $item['nm_turma'];?></span>
												</li>
											<?php
											}
										?>
									</ul>
								</div>
							</div>
							<div class="mb-3">
								<label for="ds_descricao" class="form-label">Descrição</label>
								<textarea class="form-control" name="descricao" id="ds_descricao" rows="4"></textarea>
							</div>
						</div>
							<div id="exibe">
			
							</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-roxo" id="salvar">Salvar</button>
							<button type="button" class="btn btn-azul" id="fechar" data-bs-dismiss="modal">Fechar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- fim do modal ADD-->
										</section>
	</main>
	
	<script src="js/duvidas.js"></script>
	<script src="js/menu.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
	</script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
	<script src="js/jQuery-Mask-Plugin-master/src/jquery.mask.js"></script>
	  <script src="js/select-comunicado.js"></script></body>
	  <script src="js/selectcheck.js"></script></body>
</body>
<SCRIpt>
				  $(document).ready(function(){
    // Evento de clique para spans dentro de suggestion-wrap
    $(".suggestion-wrap span").click(function(){
      // Atualiza o valor do campo de pesquisa com o texto do span clicado
      $("#search").val($(this).text());

      // Executa a função de filtro
      filterCards();
    });

    // Função de filtro
    function filterCards() {
      var searchTerm = $("#search").val().toLowerCase();

      $(".comunicado").each(function(){
        var cardTitle = $(this).find(".comunicado-header").text().toLowerCase();
        var cardSub = $(this).find(".comunicado-text").text().toLowerCase();

        if(cardTitle.includes(searchTerm) || cardSub.includes(searchTerm)){
          $(this).show();
        } else {
          $(this).hide();
        }
      });
    }
    // Evento de clique para o span "Limpar"
    $("#clearSearch").click(function(){
      // Limpa o valor do campo de pesquisa
      $("#search").val('');

      // Executa a função de filtro
      filterCards();
    });
    // Evento de clique para o botão de pesquisa
    $(".btn-search").click(function(){
      filterCards();
    });

    // Evento de tecla para pesquisa em tempo real
    $("#search").on('keyup', function(){
      filterCards();
    });
  });
				const input = document.getElementById("search-input");
const searchBtn = document.getElementById("search-btn");

const expand = () => {
  searchBtn.classList.toggle("close");
  input.classList.toggle("square");
};

searchBtn.addEventListener("click", expand);
</SCRIpt>

</html>
<?php
    }
?>