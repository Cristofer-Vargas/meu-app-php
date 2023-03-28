<?php

require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/DAO/ProdutoDAO.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/produto.class.php");


class ProdutoController {

  public function buscarTodos() {
    $dao = new ProdutoDAO;
    return $dao->buscarTodos();
  }

}