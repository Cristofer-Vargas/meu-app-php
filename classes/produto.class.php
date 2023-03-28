<?php

class Produto {
  private $id;
  private $nome;
  private $descricao;
  private $codigo_barras;
  private $qtde_estoque;

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getNome() {
    return $this->nome;
  }

  public function setNome($nome) {
    $this->nome = $nome;
  }

  public function getDescricao() {
    return $this->descricao;
  }

  public function setDescricao($descricao) {
    $this->descricao = $descricao;
  }

  public function getCodigo_barras() {
    return $this->codigo_barras;
  }

  public function setCodigo_barras($codigo_barras) {
    $this->codigo_barras = $codigo_barras;
  }

  public function getQtde_estoque() {
    return $this->qtde_estoque;
  }

  public function setQtde_estoque($qtde_estoque) {
    $this->qtde_estoque = $qtde_estoque;
  }

}