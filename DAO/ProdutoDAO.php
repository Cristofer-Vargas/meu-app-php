<?php

require_once(str_replace('\\', '/', dirname(__FILE__, 2)). '/config/functions.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)). '/classes/produto.class.php');

class ProdutoDAO {
  
  public function BuscarTodos() {
    
    $pdo = connectDb();

    try {
      $stmt = $pdo->query('SELECT * FROM produtos');
      
      if ($stmt->rowCount()) {
        
        while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
          $produtos = new Produto();
          $produtos->setId($result->id);
          $produtos->setNome($result->nome);
          $produtos->setDescricao($result->descricao);
          $produtos->setCodigo_barras($result->codigo_barras);
          $produtos->setQtde_estoque($result->qtde_stoque);
          $retorno[] = clone $produtos;
        }

        return $retorno;

      }

      return NULL;

    } catch (PDOException $ex) {
      echo "Erro ao buscar produtos: " . $ex->getMessage();
      die();

    }

  }

  public function BuscarPorId(int $id) {



  }

  public function InserirProduto() {



  }

  public function ExcluirProduto(int $id) {



  }

  public function AtualizarProduto(int $id) {



  }

}