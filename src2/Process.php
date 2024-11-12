<?php
// Process.php

class Process {
    public $id;
    public $tipoProcesso;
    public $numeroProcesso;
    public $dataDistribuicao;
    public $nomePartes;
    public $advogados;
    public $juizResponsavel;
    public $tribunal;
    public $dataPeticaoInicial;
    public $dataContestacao;
    public $dataAudienciaConciliacao;
    public $decisoesInterlocutorias;
    public $dataSentenca;
    public $valorCausa;
    public $dataIntimacao;
    public $situacao;
    public $descricao;

    public function __construct(
        $tipoProcesso,
        $numeroProcesso = null,
        $dataDistribuicao = null,
        $nomePartes = null,
        $advogados = null,
        $juizResponsavel = null,
        $tribunal = null,
        $dataPeticaoInicial = null,
        $dataContestacao = null,
        $dataAudienciaConciliacao = null,
        $decisoesInterlocutorias = null,
        $dataSentenca = null,
        $valorCausa = null,
        $dataIntimacao = null,
        $situacao = null,
        $descricao = null
    ) {
        $this->tipoProcesso = $tipoProcesso;
        $this->numeroProcesso = $numeroProcesso;
        $this->dataDistribuicao = $dataDistribuicao;
        $this->nomePartes = $nomePartes;
        $this->advogados = $advogados;
        $this->juizResponsavel = $juizResponsavel;
        $this->tribunal = $tribunal;
        $this->dataPeticaoInicial = $dataPeticaoInicial;
        $this->dataContestacao = $dataContestacao;
        $this->dataAudienciaConciliacao = $dataAudienciaConciliacao;
        $this->decisoesInterlocutorias = $decisoesInterlocutorias;
        $this->dataSentenca = $dataSentenca;
        $this->valorCausa = $valorCausa;
        $this->dataIntimacao = $dataIntimacao;
        $this->situacao = $situacao;
        $this->descricao = $descricao;
    }

    public function getType() {
        return $this->tipoProcesso;
    }

    public function getConflictObject() {
        return $this->descricao;
    }

    public function getParties() {
        return $this->nomePartes;
    }

    public function getCourt() {
        return $this->tribunal;
    }

    public function getSituation() {
        return $this->situacao;
    }
}
?>