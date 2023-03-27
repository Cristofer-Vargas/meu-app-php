<?php

session_start();

require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/cliente.class.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/controllers/cliente.controller.php");

$cliente = new Cliente();

if (isset($_GET) && isset($_GET['id'])) {
  $id         = addslashes(filter_input(INPUT_GET, 'id'));
  $nome       = addslashes(filter_input(INPUT_GET, 'nome'));
  $cpfcnpj    = addslashes(filter_input(INPUT_GET, 'cpfcnpj'));
  $telefone   = addslashes(filter_input(INPUT_GET, 'telefone'));

  if (empty($nome) && empty($cpfcnpj)) {
    $_SESSION['mensagem'] = "É necessário informar Nome e CPF / CNPJ";
    $_SESSION['sucesso'] = false;
    die();
  }

  $cliente->setId($id);
  $cliente->setNome($nome);
  $cliente->setCpfCnpj($cpfcnpj);
  $cliente->setTelefone($telefone);

  $controller = new ClienteController();
  $result = $controller->excluirCliente($cliente);

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
