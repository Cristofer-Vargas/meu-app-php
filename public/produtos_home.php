<?php

require_once('./header.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/controllers/produto.controller.php');
// require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/classes/produto.class.php');

$controller = new ProdutoController();
$produtos = $controller->buscarTodos();

?>

<div class="container">
  <?php include_once('./nav.php') ?>

  <h2>Tabela Produtos</h2>

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

      <?php
      foreach ($produtos as $row) {
        echo "<tr><td>" . $row->getId() . "</td>" . 
        "<td>" . $row->getNome() . "</td>" .
        "<td>" . $row->getDescricao() . "</td>" .
        "<td>" . $row->getCodigo_barras() . "</td>" .
        "<td>" . $row->getQtde_estoque() . "</td>" .
        "<td><a class='btn btn-light' href='#?key=" . $row->getId() . "Editar</a></td>" .
        "<td><a class='btn btn-light' href='#?key=" . $row->getId() . "Excluir</a></td>";
      }
      ?>

    </tbody>
  </table>

  <?php
  if (isset($_SESSION) && isset($_SESSION['sucesso']) && $_SESSION['sucesso'] == TRUE) {
  ?>
    <tr colspan="4">
      <div class="alert alert-success" role="alert">
        <?= $_SESSION['mensagem']; ?>
      </div>
    </tr>
  <?php
  }
  if (isset($_SESSION) && isset($_SESSION['sucesso']) && $_SESSION['sucesso'] == false) {
  ?>
    <tr colspan="4">
      <div class="alert alert-danger" role="alert">
        <?= $_SESSION['mensagem']; ?>
      </div>
    </tr>
  <?php
  }
  unset($_SESSION['sucesso'], $_SESSION['mensagem']);
  ?>


</div>

<?php require_once('./footer.php');