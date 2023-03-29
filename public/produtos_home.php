<?php

require_once('./header.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/controllers/produto.controller.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/config/functions.php');

// require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/classes/produto.class.php');

$controller = new ProdutoController();
$produtos = $controller->buscarTodos();

?>

<div class="container">
  <?php include_once('./nav.php') ?>

  <h1>Lista de Produtos</h1>
  <a class="btn btn-primary" href="cad_produto.php">Novo produto</a>

  <?= menssagemPerssonalizada() ?>

  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nome</th>
        <th scope="col">Descrição</th>
        <th scope="col">Código de Barras</th>
        <th scope="col">Quantidade em estoque</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>

    <?php if (!empty($produtos)) {
      foreach ($produtos as $row) :?>
    <tr>
      <td><?= $row->getId() ?></td>
      <td><?= $row->getNome() ?></td>
      <td><?= $row->getDescricao() ?></td>
      <td><?= $row->getCodigo_barras() ?></td>
      <td><?= $row->getQtde_estoque() ?></td>
      <td>
        <a class='btn btn-light' href="./cad_produto.php?key=<?= $row->getId()?>">Editar</a>
        <a class="btn btn-link" href="../acoes/excluir_produto.php?key=<?= $row->getId()?>">Excluir</a>
      </td>
    </tr>
    <?php endforeach;
  } else {
    $_SESSION['mensagem'] = "Não há produtos cadastrados";
    $_SESSION['sucesso'] = false;
  }
  ?>

    </tbody>
  </table>


</div>

<?php require_once('./footer.php');