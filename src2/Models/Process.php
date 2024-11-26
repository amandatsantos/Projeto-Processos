<?php

interface Prototype {
    public function clone();
    
}

class Process implements Prototype {
    private $id;  // declarar a propriedade id
    private $tipoProcesso;
    private $autorNome;
    private $autorIdentificacao;
    private $reuNome;
    private $reuIdentificacao;
    private $descricaoCaso;
    private $fatos;
    private $direitoViolado;
    private $pedido;
    private $juizo;
    private $varaTribunal;
    private $comarca;
    private $valorCausa;
    private $advogadoNome;
    private $advogadoOAB;
    private $advogadoContato;
    private $dataProtocolacao;
    private $objetoConflito; 

   
    
    public function __construct(
        $tipoProcesso, $autorNome, $autorIdentificacao, $reuNome, $reuIdentificacao, $descricaoCaso, 
        $fatos, $direitoViolado, $pedido, $juizo, $varaTribunal, $comarca, $valorCausa, $advogadoNome, 
        $advogadoOAB, $advogadoContato, $dataProtocolacao, $objetoConflito
    ) {
        $this->tipoProcesso = $tipoProcesso;
        $this->autorNome = $autorNome;
        $this->autorIdentificacao = $autorIdentificacao;
        $this->reuNome = $reuNome;
        $this->reuIdentificacao = $reuIdentificacao;
        $this->descricaoCaso = $descricaoCaso;
        $this->fatos = $fatos;
        $this->direitoViolado = $direitoViolado;
        $this->pedido = $pedido;
        $this->juizo = $juizo;
        $this->varaTribunal = $varaTribunal;
        $this->comarca = $comarca;
        $this->valorCausa = $valorCausa;
        $this->advogadoNome = $advogadoNome;
        $this->advogadoOAB = $advogadoOAB;
        $this->advogadoContato = $advogadoContato;
        $this->dataProtocolacao = $dataProtocolacao;
        $this->objetoConflito = $objetoConflito;
    }

    public function clone() {
        return new self(
            $this->tipoProcesso,
            $this->autorNome,
            $this->autorIdentificacao,
            $this->reuNome,
            $this->reuIdentificacao,
            $this->descricaoCaso,
            $this->fatos,
            $this->direitoViolado,
            $this->pedido,
            $this->juizo,
            $this->varaTribunal,
            $this->comarca,
            $this->valorCausa,
            $this->advogadoNome,
            $this->advogadoOAB,
            $this->advogadoContato,
            $this->dataProtocolacao,
            $this->objetoConflito
        );
    }
    public function __toString() {
        return "Processo do tipo '{$this->tipoProcesso}',
                 Cliente: '{$this->autorNome}',
                 CPF: '{$this->autorIdentificacao}', 
                 Oponente: '{$this->reuNome}',
                 CPF Oponente: '{$this->reuIdentificacao}', 
                Descrição: '{$this->descricaoCaso}', 
                 Fatos: '{$this->fatos}', 
                Direito Violado: '{$this->direitoViolado}',
                 Pedido: '{$this->pedido}', 
                Juízo: '{$this->juizo}'
                , Instância: '{$this->varaTribunal}',      
                 Comarca: '{$this->comarca}', 
                Valor da Causa: '{$this->valorCausa}',
                 Advogado: '{$this->advogadoOAB}',
                Contato Advogado: '{$this->advogadoContato}', 
                Data de Cadastro: '{$this->dataProtocolacao}', 
                Objeto de Conflito: '{$this->objetoConflito}'";
    }

    public function setId($id) {
        $this->id = $id;
    }


    public function getId() {
        return $this->id;
    }
    
    public function getTipoProcesso() {
        return $this->tipoProcesso;
    }

    public function setTipoProcesso($tipoProcesso) {
        $this->tipoProcesso = $tipoProcesso;
    }

    public function getAutorNome() {
        return $this->autorNome;
    }

    public function setAutorNome($autorNome) {
        $this->autorNome = $autorNome;
    }

    public function getAutorIdentificacao() {
        return $this->autorIdentificacao;
    }

    public function setAutorIdentificacao($autorIdentificacao) {
        $this->autorIdentificacao = $autorIdentificacao;
    }

    public function getReuNome() {
        return $this->reuNome;
    }

    public function setReuNome($reuNome) {
        $this->reuNome = $reuNome;
    }

    public function getReuIdentificacao() {
        return $this->reuIdentificacao;
    }

    public function setReuIdentificacao($reuIdentificacao) {
        $this->reuIdentificacao = $reuIdentificacao;
    }

    public function getDescricaoCaso() {
        return $this->descricaoCaso;
    }

    public function setDescricaoCaso($descricaoCaso) {
        $this->descricaoCaso = $descricaoCaso;
    }

    public function getFatos() {
        return $this->fatos;
    }

    public function setFatos($fatos) {
        $this->fatos = $fatos;
    }

    public function getDireitoViolado() {
        return $this->direitoViolado;
    }

    public function setDireitoViolado($direitoViolado) {
        $this->direitoViolado = $direitoViolado;
    }

    public function getPedido() {
        return $this->pedido;
    }

    public function setPedido($pedido) {
        $this->pedido = $pedido;
    }

    public function getJuizo() {
        return $this->juizo;
    }

    public function setJuizo($juizo) {
        $this->juizo = $juizo;
    }

    public function getVaraTribunal() {
        return $this->varaTribunal;
    }

    public function setVaraTribunal($varaTribunal) {
        $this->varaTribunal = $varaTribunal;
    }

    public function getComarca() {
        return $this->comarca;
    }

    public function setComarca($comarca) {
        $this->comarca = $comarca;
    }

    public function getValorCausa() {
        return $this->valorCausa;
    }

    public function setValorCausa($valorCausa) {
        $this->valorCausa = $valorCausa;
    }

    public function getAdvogadoNome() {
        return $this->advogadoNome;
    }

    public function setAdvogadoNome($advogadoNome) {
        $this->advogadoNome = $advogadoNome;
    }

    public function getAdvogadoOAB() {
        return $this->advogadoOAB;
    }

    public function setAdvogadoOAB($advogadoOAB) {
        $this->advogadoOAB = $advogadoOAB;
    }

    public function getAdvogadoContato() {
        return $this->advogadoContato;
    }

    public function setAdvogadoContato($advogadoContato) {
        $this->advogadoContato = $advogadoContato;
    }

    public function getDataProtocolacao() {
        return $this->dataProtocolacao;
    }

    public function setDataProtocolacao($dataProtocolacao) {
        $this->dataProtocolacao = $dataProtocolacao;
    }

    public function getObjetoConflito() {
        return $this->objetoConflito;
    }

    public function setObjetoConflito($objetoConflito) {
        $this->objetoConflito = $objetoConflito;
    }

    //  retorna as partes envolvidas no processo se precisar dps :/
    public function getParties() {
        return [$this->autorNome, $this->reuNome];
    }
}
?>
