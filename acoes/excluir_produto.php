<?php

session_start();

require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/produto.class.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/controllers/produto.controller.php");

$produto = new Produto();

if (isset($_GET) && isset($_GET['key'])) {
	$id = filter_input(INPUT_GET, 'key');
	$controller = new ProdutoController();

  $result = $controller->excluirProduto($id);

  if ($result == true) {
    $_SESSION['mensagem'] = "Produto excluido com sucesso";
    $_SESSION['sucesso'] = true;
  } else {
    $_SESSION['mensagem'] = "Erro ao excluir produto";
    $_SESSION['sucesso'] = false;
  }
  header('Location:../public/produtos_home.php');

} else {
  echo "Sem valores no POST";
}
