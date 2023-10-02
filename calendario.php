<?php
	include("php/conexao.php");
    session_start();
    if (!isset($_SESSION['email'])){
        header('Location: index.php');
    }else{
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- css -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/calendario.css">
	<link rel="stylesheet" href="css/menu.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
	integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/brands.min.css"
	integrity="sha512-9YHSK59/rjvhtDcY/b+4rdnl0V4LPDWdkKceBl8ZLF5TB6745ml1AfluEU6dFWqwDw9lPvnauxFgpKvJqp7jiQ=="
	crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- /css -->

	<!-- js -->
	<script src="js/calendario.js"></script>
	<script src="https://unpkg.com/scrollreveal"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js"></script>
	<script src="js/jquery.maskMoney.min.js"></script>
	<script>
		$(document).ready(function () {
			$('.date').mask('00/00/0000');
			//  $('.time').mask('00:00h');
			var mask = "HG:MN",
			pattern = {
				'translation': {
				'H': {
					pattern: /[0-2]/
				},
				'G': {
					pattern: /[0-23]/
				},
				'M': {
					pattern: /[0-5]/
				},
				'N': {
					pattern: /[0-59]/
				}
				}
			};

			$(".time").mask(mask, pattern);
		});
	</script>
	<!-- /js -->

	<title>Calendário</title>
</head>

<body>
	<!-- INICIO DA DUVIDA!! -->
	<section class="calendario-container">
		<!-- INICIO MENU  -->
		<nav class="menu-lateral">
			<div class="btn-expandir">
			<i class="bi bi-list" id="btn-exp"></i>
			</div>
			<ul>
			<li class="item-menu">
				<a href="perfil.php">
				<span class="icon"><i class="bi bi-person-fill"></i></span>
				<span class="txt-link">Usuário</span>
				</a>
			</li>
			<li class="item-menu">
				<a href="index.html">
				<span class="icon"><i class="bi bi-house-door-fill"></i></span>
				<span class="txt-link">Home</span>
				</a>
			</li>
			<li class="item-menu ativo">
				<a href="#">
				<span class="icon"><i class="bi bi-calendar2-week-fill"></i></span>
				<span class="txt-link">Calendário</span>
				</a>
			</li>
			<li class="item-menu">
				<a href="comunicados.php">
				<span class="icon"><i class="bi bi-megaphone-fill"></i></span>
				<span class="txt-link">Comunicados</span>
				</a>
			</li>
			<li class="item-menu ">
				<a href="apm.php">
				<span class="icon"><i class="bi bi-cart4"></i></span>
				<span class="txt-link">APM</span>
				</a>
			</li>
			<li class="item-menu">
				<a href="painel.php">
				<span class="icon"><i class="bi bi-heart-fill"></i></span>
				<span class="txt-link">Saúde</span>
				</a>
			</li>
			<li class="item-menu">
				<a href="gestao.php">
				<span class="icon"><i class="bi bi-person-workspace"></i></span>
				<span class="txt-link">Gestão</span>
				</a>
			</li>
			<li class="item-menu">
				<a href="duvidas.php">
				<span class="icon"><i class="bi bi-question-lg"></i></span>
				<span class="txt-link">Dúvidas</span>
				</a>
			</li>
			<li class="item-menu">
				<a href="gerenciamento.php">
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
		
		<div class="info mt-5">
			<div class="calendario">
				<header>
					<h2 id="mes">Abril</h2>
					<h3 id="ano"></h3>
					<a class="btn-ant" id="btn-ant"><</a>
					<a class="btn-pro" id="btn-next">></a>
					</a>
				</header>
				<table>
					<thead>
						<tr>
							<td>Dom</td>
							<td>Seg</td>
							<td>Ter</td>
							<td>Qua</td>
							<td>Qui</td>
							<td>Sex</td>
							<td>Sáb</td>
						</tr>
					</thead>
					<tbody id="dias">
						<tr>
							<td>1</td>
							<td>2</td>
							<td>3</td>
							<td>4</td>
							<td>5</td>
							<td>6</td>
							<td>7</td>
						</tr>
						<tr>
							<td>1</td>
							<td>2</td>
							<td>3</td>
							<td>4</td>
							<td>5</td>
							<td>6</td>
							<td>7</td>
						</tr>
						<tr>
							<td>1</td>
							<td data-toggle="popover" data-content="Dia Das Crianças" data-trigger="hover">2</td>
							<td>3</td>
							<td>4</td>
							<td>5</td>
							<td>6</td>
							<td>7</td>
						</tr>
						<tr>
							<td>1</td>
							<td>2</td>
							<td>3</td>
							<td>4</td>
							<td>5</td>
							<td>6</td>
							<td>7</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="event" data-toggle="popover" data-content="Dia Das Crianças" data-trigger="hover">2</td>
							<td>3</td>
							<td>4</td>
							<td>5</td>
							<td>6</td>
							<td>7</td>
						</tr>
						<tr>
							<td>1</td>
							<td>2</td>
							<td>3</td>
							<td>4</td>
							<td>5</td>
							<td>6</td>
							<td>7</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="data-evento">
				<h2>Eventos</h2>
				<?php
					// Exibir os eventos cadastrados no banco
					$sql = "SELECT * FROM tb_comunicado";
	
					foreach ($conn->query($sql) as $item){?>
						<div class="info-evento mt-5 adm">
							<button data-bs-toggle="modal" data-bs-target="#editModal" style="border: none;">
								<i class="bi bi-pencil-square edit-icon"></i>
							</button>
							<i class="bi bi-trash-fill delete-icon"></i>
							<h3><?php echo $item[''];?></h3>
							<h4>25/25/2025</h4>
						</div>
				<?php
					}
				?>
				</div>
		</div>


	<!-- Modal de Alteração -->
	<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
		aria-labelledby="editModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
			<h1 class="modal-title fs-5" id="editModalLabel">Editar Evento</h1>
			<button type="button" class="btn-close close-button" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
			<form>
				<!-- Inputs para a alteração -->
				<div class="mb-3">
				<label for="productTitle" class="form-label">Alterar Título do Evento</label>
				<input type="text" class="form-control" id="productTitle">
				</div>
				<div class="col">
				<label for="productDate" class="form-label">Alterar Data e Hora</label>
				<input type="datetime-local" class="form-control" id="productDate">
				</div>
			</form>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-primary">Salvar Alterações</button>
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
			</div>
		</div>
		</div>
	</div>
	<!-- Fim do modal de Alteração -->




	<!-- incio do modal E BOTAO QUE ABRE ELE -->
	<button type="button" class="btn btn-primary add" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
		<i class="bi bi-plus-circle-fill"></i> <!-- Ícone de adição -->
	</button>

	<!-- Modal de ADICIONAR Evento -->
	<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
		aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
			<h1 class="modal-title fs-5" id="staticBackdropLabel">Adicionar Evento</h1>
			<button type="button" class="btn-close close-button" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
			<form>
				<div class="mb-3">
				<label for="productTitle" class="form-label">Título do Comunicado</label>
				<input type="text" class="form-control" id="productTitle">
				</div>
				<div class="input-group col">
				<input placeholder="Data" style="height: 2rem !important;" type="text" class="form-control date"
					id="dateInput" accept="image/*">
				<input placeholder="Hora" style="height: 2rem !important;" class="form-control time" type="text"
					id="timeInput">
				</input>
				</div>
			</form>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-roxo">Salvar</button>
			<button type="button" class="btn btn-azul" data-bs-dismiss="modal">Fechar</button>
			</div>
		</div>
		</div>
	</div>
	<!-- fim do modal -->
	</section>

	<!-- FIM DA DÚVIDA!! -->

	<!-- js -->
	<script src="js/menu.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
	integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
	integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
	crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
	integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
	crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
	integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
	crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
	integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
	crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
	<script src="js/jQuery-Mask-Plugin-master/src/jquery.mask.js"></script>
	<script>
	$('[data-toggle="popover"]').popover({}) 
	</script>
</body>

</html>
<?php
}
?>