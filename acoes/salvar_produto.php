<?php

require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/classes/produto.class.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/controllers/produto.controller.php');

if (isset($_POST) && isset($_POST['id'])) {
  $id = addslashes(filter_input(INPUT_POST, 'id'));
  $nome = addslashes(filter_input(INPUT_POST, 'nome'));
  $descricao = addslashes(filter_input(INPUT_POST, 'descricao'));
  $codigo_barras = addslashes(filter_input(INPUT_POST, 'codigo_barras'));
  $qtde_estoque = addslashes(filter_input(INPUT_POST, 'qtde_estoque'));

  if (empty($nome) && empty($qtde_estoque)) {
    $_SESSION['mensagem'] = "É necessário informar campos obrigatórios!";
    $_SESSION['sucesso'] = false;
    die();
  }

  $produto = new Produto();
  $controller = new ProdutoController();

  $produto->setId($id);
  $produto->setNome($nome);
  $produto->setDescricao($descricao);
  $produto->setCodigo_barras($codigo_barras);
  $produto->setQtde_estoque($qtde_estoque);

  // $resultado = $controller->inserirProduto($produto);

  header('Location:../public/cad_produto.php');

} else {

  $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
  $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : null;
  $codigo_barras = isset($_POST['codigo_barras']) ? $_POST['codigo_barras'] : null;
  $qtde_estoque = isset($_POST['qtde_estoque']) ? $_POST['qtde_estoque'] : null;

  if ($nome && $qtde_estoque) {
    
    $produto = new Produto();
    $controller = new ProdutoController();
  
    $produto->setId($id);
    $produto->setNome($nome);
    $produto->setDescricao($descricao);
    $produto->setCodigo_barras($codigo_barras);
    $produto->setQtde_estoque($qtde_estoque);
  
    $resultado = $controller->inserirProduto($produto);
  
    if ($resultado == true) {
      $_SESSION['mensagem'] = "Produto adicionado com sucesso!";
      $_SESSION['sucesso'] = true;
  
    } else {
      $_SESSION['mensagem'] = "Erro ao adicionar produto!";
      $_SESSION['sucesso'] = false;
    }

  } else {
    $_SESSION['mensagem'] = "É preciso preencher campos obrigatórios!";
    $_SESSION['sucesso'] = false;
  }

  header('Location:../public/cad_produto.php');
}