<?php
// ProcessFactory.php
require_once __DIR__ . '/Process.php';

class ProcessFactory {
        public function createProcess($data) {
            // os dados já incluem o tipo do processo, usamos ele diretamente
            $tipoProcesso = $data['tipo_processo'];
    
            //objeto Process com todos os dados
            return new Process(
                $tipoProcesso, 
                $data['nome_cliente'],
                $data['cpf_cliente'], 
                $data['oponente'], 
                $data['cpf_oponente'], 
                $data['descricao'], 
                $data['fatos'], 
                $data['direito_violado'], 
                $data['pedido'], 
                $data['juizo'], 
                $data['cortes'], 
                $data['comarca'], 
                $data['valor_causa'], 
                $data['advogado'], 
                $data['oab'], 
                $data['contato_advogado'], 
                $data['data_protocolacao'], 
                $data['objeto_conflito']
            );
        }
    }
    