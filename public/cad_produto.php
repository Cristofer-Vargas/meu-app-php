<?php

require_once('./header.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/produto.class.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/controllers/produto.controller.php");

$produto = new Produto();

if (isset($_GET) && isset($_GET['key'])) {
	$id = filter_input(INPUT_GET, 'key');
	$controller = new ProdutoController();
	$produto = $controller->buscarPorId($id);
}

?>

<div class="container">
  <?php require_once('./nav.php') ?>

  <h1>Cadastro de produto</h1>

  <form method="POST" action="../acoes/salvar_produto.php">
		<div class="mb-3">
			<label for="nome" class="form-label">Nome*</label>
			<input type="text" class="form-control" id="nome" name="nome" value="<?= $produto->getNome() ?>">
			<input type="hidden" name="id" value="<?= $produto->getId(); ?>">
		</div>
    
		<div class="mb-3">
			<label for="descricao" class="form-label">Descrição</label>
			<textarea type="text" class="form-control" id="descricao" name="descricao"><?= $produto->getDescricao() ?></textarea>
		</div>

		<div class="mb-3">
			<label for="codigo_barras" class="form-label">Código de Barras</label>
			<input type="tel" class="form-control" id="codigo_barras" name="codigo_barras" value="<?= $produto->getCodigo_barras() ?>">
		</div>
		
    <div class="mb-3">
			<label for="qntde_estoque" class="form-label">Quantidade em Estoque*</label>
			<input type="tel" class="form-control" id="qntde_estoque" name="qntde_estoque" value="<?= $produto->getQtde_estoque() ?>">
		</div>

		<button type="submit" class="btn btn-primary">Salvar</button>
	</form>

  <?= menssagemPerssonalizada() ?>
  
</div>