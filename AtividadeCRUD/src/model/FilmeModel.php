<?php
require_once 'MidiaModel.php';

class FilmeModel extends MidiaModel{

    function __construct($nome, $genero, $anoLanc, $sinopse, $clasInd, $tipo){
        parent::__construct($nome, $genero, $anoLanc, $sinopse, $clasInd, $tipo);
    }

    // Getters
    public function getNome() { return $this->nome; }
    public function getGenero() { return $this->genero; }
    public function getAnoLanc() { return $this->anoLanc; }
    public function getSinopse() { return $this->sinopse; }
    public function getClasInd() { return $this->clasInd; }
    public function getTipo() { return $this->tipo; }
}