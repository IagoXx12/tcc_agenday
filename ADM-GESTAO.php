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
    $stmt = $conn->prepare("SELECT id_nivel FROM tb_usuario WHERE ds_email = :email");
    $stmt->execute(array(':email' => $email));
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o 'id_nivel' do usuário é igual a 1
    if ($_SESSION['id_nivel'] != 1) {
        header('Location: index.php');
        exit(); // Certifique-se de sair do script após redirecionar
    }?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- css -->
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/gestao.css">
		<link rel="stylesheet" href="css/menu.css">
		<link rel="stylesheet" href="css/perfilfundo.scss">


		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/brands.min.css" integrity="sha512-9YHSK59/rjvhtDcY/b+4rdnl0V4LPDWdkKceBl8ZLF5TB6745ml1AfluEU6dFWqwDw9lPvnauxFgpKvJqp7jiQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
	<!-- /css -->

	<!-- js -->
		<script type="text/javascript" src="js/jquery-3.6.1.min.js"></script>
		<script src="https://unpkg.com/scrollreveal"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				//ADD GESTAO
				$('#addGestao').submit(function (e) {
					e.preventDefault();

					var formulario = new FormData(this); // Crie um objeto FormData com os dados do formulário
					$.ajax({
						type: 'POST',
						url: 'php/add_gestao.php',
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

        		//UPDATE Gestão

				//Pegar os valores dos inputs
				$(".alterar").on("click", function(){
					$("#exibir_cod").text($(this).attr('cod'));
					$("#exibir_path").text($(this).attr('imagem'));
					$("#alterar_nm").val($(this).attr('nome'));
					$("#alterar_cargo").val($(this).attr('cargo'));
				});

				//Atualizar valores
				$('#alterarGestao').submit(function (e) {
					e.preventDefault();

					var formulario = new FormData(this);
					formulario.append('codigo', $("#exibir_cod").text());
					formulario.append('imagemAntiga', $("#exibir_path").text());
					
					$.ajax({
						type: 'POST',
						url: 'php/alterar_gestao.php',
						data: formulario,
						contentType: false,
						processData: false,
					}).done(function(resposta){
						$("#exibe2").html(resposta);
					}).fail(function(jqXHR, textStatus ) {
						$("#exibe2").html("Request failed: " + textStatus);
					});
				});
			});	
		</script>
	<!-- /js -->
  	<title>Gestão</title>
</head>

<body>
  <!-- INICIO DA DUVIDA!! -->
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
				<a href="ADM-CALENDARIO.php">
					<span class="icon"><i class="bi bi-house-door-fill"></i></span>
					<span class="txt-link">Calendário</span>
				</a>
			</li>
        <li class="item-menu">
				<a href="ADM-COMUNICADOS.php">
				<span class="icon"><i class="bi bi-megaphone-fill"></i></span>
				<span class="txt-link">Comunicados</span>
				</a>
			</li>
			<li class="item-menu ">
				<a href="ADM-APM.php">
				<span class="icon"><i class="bi bi-cart4"></i></span>
				<span class="txt-link">APM</span>
				</a>
			</li>
			<li class="item-menu ativo">
				<a href="ADM-GESTAO.php">
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
				<a href="ADM-GERENCIAMENTO.php">
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
  <main>
    <div class="comuni">
      <h1>Gestão Pedagógica</h1>
    </div>
    <section class="gestao">
		<div class="gestao-container">
      <?php
          $sql = "SELECT * FROM tb_gestao";
          foreach ($conn->query($sql) as $row) {?>
				<div class="gestao-users">
              		<img src="<?php echo $row['ds_imagem'];?>" alt="Foto do Usuário">
              		<button class="alterar" data-bs-toggle="modal" data-bs-target="#editModal" cod="<?php echo $row['cd_membro'];?>" nome="<?php echo $row['nm_membro'];?>" cargo="<?php echo $row['ds_cargo'];?>" imagem="<?php echo $row['ds_imagem'];?>"><i class="bi bi-pencil-square edit-icon"></i></button>
					<a href="php/delete_gestao.php?cod=<?php echo $row['cd_membro'];?>"><i class="bi bi-trash-fill delete-icon"></i></a>
              		<p><?php echo $row['nm_membro'];?></p>
              		<p><?php echo $row['ds_cargo'];?></p>
            	</div>
				<?php
          }
          ?>
		</div>
  </section>
</main>

  <!-- Modal de Alteração -->
  <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
		<form id="alterarGestao" enctype="multipart/form-data">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="editModalLabel">Editar Membro</h1>
				<button type="button" class="btn-close close-button" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<!-- Inputs para a alteração -->
				<div class="mb-3">
					<label for="imageInput" class="form-label">Editar Imagem do Membro</label>
					<div class="input-group">
						<input type="file" class="form-control" name="alterarImagem" id="imageInput" accept="image/*">
						<button class="btn btn-outline-secondary" type="button" id="editButton">
							<i class="bi bi-pencil"></i> <!-- Ícone de editar -->
						</button>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col">
						<label for="alterar_nm" class="form-label">Editar Nome do Membro</label>
						<input type="text" class="form-control" name="nome" id="alterar_nm">
					</div>
					<div class="col">
						<label for="alterar_cargo" class="form-label">Editar Cargo do Membro</label>
						<input type="text" class="form-control" name="cargo" id="alterar_cargo">
					</div>
				</div>
				<p id="exibir_cod" style="display: none;"></p>
				<p id="exibir_path" style="display:none;"></p>
			</div>
			<div id="exibe2"></div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-roxo">Salvar Alterações</button>
				<button type="button" class="btn btn-azul" data-bs-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</form>
    </div>
  </div>
  <!-- Fim do modal de Alteração -->

  <!-- incio do modal E BOTAO QUE ABRE ELE -->
  <button type="button" class="btn btn-primary add" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    <i class="bi bi-plus-circle-fill"></i> <!-- Ícone de adição -->
  </button>

  <!-- Modal de ADICIONAR APM -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Adicionar Membro</h1>
          <button type="button" class="btn-close close-button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
		    <form id="addGestao" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="mb-3">
              <label for="ds_imagem" class="form-label">Imagem do Membro</label>
              <div class="input-group">
                <input type="file" class="form-control" name="ds_imagem" id="ds_imagem" accept="image/*">
                <button class="btn btn-outline-secondary" type="button" id="editButton">
                  <i class="bi bi-pencil"></i> <!-- Ícone de editar -->
                </button>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                <label for="nm_membro" class="form-label">Nome do Membro</label>
                <input type="text" name="nm_membro" class="form-control" id="nm_membro">
              </div>
              <div class="col">
                <label for="membroCargo" class="form-label">Cargo do Membro</label>
                <input type="text" name="ds_cargo" class="form-control" id="membroCargo">
              </div>
            </div>
        </div>
		<div id="exibe"></div>
        <div class="modal-footer">
			<button type="submit" class="btn btn-roxo">Salvar</button>
			<button type="button" class="btn btn-azul" data-bs-dismiss="modal">Fechar</button>
        </div>
	</form>
	</div>
    </div>
  </div>
  <!-- fim do modal -->
  <!-- js -->
  <script src="js/duvidas.js"></script>
  <script src="js/menu.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
<?php
	}
?>