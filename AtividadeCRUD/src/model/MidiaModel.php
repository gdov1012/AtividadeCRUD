<?php

enum Genero: string{
    case Acao = 'Acao'; 
    case Aventura = 'Aventura'; 
    case Comedia = 'Comedia';
    case Drama = 'Drama'; 
    case FiccaoCientifica = 'Ficçao Cientifica';
    case Fantasia = 'Fantasia'; 
    case Terror = 'Terror';
    case Romance = 'Romance'; 
    case Musical = 'Musical'; 
    case Suspense = 'Suspense'; 
    case Documentario = 'Documentario';
}

class MidiaModel {
    public $codigo;
    public $tipo;
    public $nome;
    public Genero $genero;
    public $anoLanc;
    public $sinopse;
    public $clasInd;


    // o codigo não está aqui pois eu deixei ele ser auto colocado pelo proprio mysql
    public function __construct(
        $nome, $genero, $anoLanc, $sinopse, $clasInd, $tipo,) 
        {
        $this->nome     = $nome;
        $this->genero   = Genero::from($genero);
        $this->anoLanc  = $anoLanc;
        $this->sinopse  = $sinopse;
        $this->clasInd  = $clasInd;
        $this->tipo     = $tipo;
    }
}