<?php

class Produto {
  private int $id;
  private string $nome;
  private string $descricao;
  private string $codigo_barras;
  private int $qtde_estoque;
  private bool $ativo;

  public function getId(): int {
    return $this->id;
  }

  public function setId(int $id) {
    $this->id = $id;
  }

  public function getNome(): string {
    return $this->nome;
  }

  public function setNome(string $nome) {
    $this->nome = $nome;
  }

  public function getDescricao(): string {
    return $this->descricao;
  }

  public function setDescricao(string $descricao) {
    $this->descricao = $descricao;
  }

  public function getCodigo_barras(): string {
    return $this->codigo_barras;
  }

  public function setCodigo_barras(string $codigo_barras) {
    $this->codigo_barras = $codigo_barras;
  }

  public function getQtde_estoque(): int {
    return $this->qtde_estoque;
  }

  public function setQtde_estoque(int $qtde_estoque) {
    $this->qtde_estoque = $qtde_estoque;
  }

  public function getAtivo(): bool {
    return $this->ativo;
  }

  public function setAtivo(bool $ativo) {
    $this->ativo = $ativo;
  }

}