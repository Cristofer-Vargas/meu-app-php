<?php

require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/config/functions.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/classes/produto.class.php');

class ProdutoDAO
{

  public function BuscarTodos()
  {

    try {
      $pdo = connectDb();
      $stmt = $pdo->query('SELECT * FROM produtos');

      if ($stmt->rowCount()) {
        $produtos = new Produto();
        $retorno = array();

        while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
          $produtos->setId($result->id);
          $produtos->setNome($result->nome);
          $produtos->setDescricao($result->descricao);
          $produtos->setCodigo_barras($result->codigo_barras);
          $produtos->setQtde_estoque($result->qtde_estoque);
          $retorno[] = clone $produtos;
        }

        return $retorno;
      } else {
        return NULL;
      }
    } catch (PDOException $ex) {
      echo "Erro ao buscar produtos: " . $ex->getMessage();
      die();
    }
  }

  public function BuscarPorId(int $id)
  {

    try {
      $conec = connectDb();
      $stmt = $conec->prepare('SELECT * FROM produtos WHERE id = :id');
      $stmt->bindValue(':id', $id);
      $stmt->execute();

      if ($stmt->rowCount()) {
        $produto = new Produto();

        while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
          $produto->setId($result->id);
          $produto->setNome($result->nome);
          $produto->setDescricao($result->descricao);
          $produto->setCodigo_barras($result->codigo_barras);
          $produto->setQtde_estoque($result->qtde_estoque);
          return $produto;
        }
      } else {
        $_SESSION['mensagem'] = "Não houve resultados com esse ID";
        $_SESSION['sucesso'] = false;
        return NULL;
      }
    } catch (PDOException $ex) {
      echo "Erro ao buscar ID: " . $ex->getMessage();
      die();
    }
  }

  public function InserirProduto(Produto $produto)
  {
    try {
      $conec = connectDb();
      $conec->beginTransaction();

      $stmt = $conec->prepare('INSERT INTO produtos (nome, 
      descricao, codigo_barras, qtde_estoque) 
      VALUES (:nome, :descricao, :codigo_barras, :qtde_estoque)');
      $stmt->bindValue(':nome', $produto->getNome());
      $stmt->bindValue(':descricao', $produto->getDescricao());
      $stmt->bindValue(':codigo_barras', $produto->getCodigo_barras());
      $stmt->bindValue(':qtde_estoque', $produto->getQtde_estoque());

      $stmt->execute();

      if ($stmt->rowCount()) {
        $conec->commit();
        return true;
      }

      if ($stmt == false) {
        $_SESSION['mensagem'] = "Não foi possível adicionar produto!";
        $_SESSION['sucesso'] = false;
        return false;
      }
    } catch (PDOException $ex) {
      $conec->rollBack();
      echo "Erro ao inserir Produto: " . $ex->getMessage();
      die();
    }
  }

  public function ExcluirProduto(int $id)
  {
    try {
      $conec = connectDb();
      $conec->beginTransaction();

      $stmt = $conec->prepare('DELETE FROM produtos WHERE id = :id');
      $stmt->bindValue(':id', $id);
      $stmt->execute();
      
      if ($stmt->rowCount()) {
        $conec->commit();
        return true;

      }

      return false;

    } catch (PDOException $ex) {
      echo "Erro ao excluir produto: " . $ex->getMessage();
      $conec->rollBack();
      die();
    }
  }

  public function AtualizarProduto(Produto $produto)
  {
    try {
      $conec = connectDb();
      $conec->beginTransaction();

      $stmt = $conec->prepare('UPDATE produtos SET nome = :nome, 
      descricao = :descricao, codigo_barras = :codigo_barras, 
      qtde_estoque = :qtde_estoque WHERE id = :id');
      $stmt->bindValue(':nome', $produto->getNome());
      $stmt->bindValue(':descricao', $produto->getDescricao());
      $stmt->bindValue(':codigo_barras', $produto->getCodigo_barras());
      $stmt->bindValue(':qtde_estoque', $produto->getQtde_estoque());
      $stmt->bindValue(':id', $produto->getId());

      $stmt->execute();

      if ($stmt->rowCount()) {
        $conec->commit();
        return true;
      }

      return false;

    } catch (PDOException $ex) {
      echo "Erro ao atualizar produto: " . $ex->getMessage();
      $conec->rollBack();
      die();
    }
  }
}
