<?php

session_start();

require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/cliente.class.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/controllers/cliente.controller.php");

$cliente = new Cliente();

if (isset($_GET) && isset($_GET['key'])) {
	$id = filter_input(INPUT_GET, 'key');
	$controller = new ClienteController();
	// $cliente = $controller->buscarPorId($id);

  // $cliente->setId($id);

  $result = $controller->excluirCliente($id);

  if ($result == true) {
    $_SESSION['mensagem'] = "Cliente excluido com sucesso";
    $_SESSION['sucesso'] = true;
  } else {
    $_SESSION['mensagem'] = "Erro ao excluir cliente";
    $_SESSION['sucesso'] = false;
  }
  header('Location:../public/home.php');

} else {
  echo "Sem valores no POST";
}
