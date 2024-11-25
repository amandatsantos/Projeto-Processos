<?php
// ProcessFactory.php
require_once __DIR__ . '/Process.php';


class ProcessFactory {
    public function createProcess($postData) {
        // REVER ISSO DAI
        if (!is_array($postData)) {
            throw new Exception("Os dados do processo devem ser passados como um array.");
        }

        switch ($postData['tipo_processo']) {
            case 'Civil':
                return new Process(
                    $postData['tipo_processo'],
                    $postData['nome_cliente'],
                    $postData['cpf_cliente'],
                    $postData['oponente'],
                    $postData['cpf_oponente'],
                    $postData['descricao'],
                    $postData['fatos'],
                    $postData['direito_violado'],
                    $postData['pedido'],
                    $postData['juizo'],
                    $postData['cortes'],
                    $postData['comarca'],
                    $postData['valor_causa'],
                    $postData['advogado'],
                    $postData['oab'],
                    $postData['contato_advogado'],
                    $postData['data_protocolacao'] ?? date('Y-m-d'),
                    $postData['objeto_conflito']
                );
            case 'Criminal':
                return new Process(
                    $postData['tipo_processo'],
                    $postData['nome_cliente'],
                    $postData['cpf_cliente'],
                    $postData['oponente'],
                    $postData['cpf_oponente'],
                    $postData['descricao'],
                    $postData['fatos'],
                    $postData['direito_violado'],
                    $postData['pedido'],
                    $postData['juizo'],
                    $postData['cortes'],
                    $postData['comarca'],
                    $postData['valor_causa'],
                    $postData['advogado'],
                    $postData['oab'],
                    $postData['contato_advogado'],
                    $postData['data_protocolacao'] ?? date('Y-m-d'),
                    $postData['objeto_conflito']
                );
            case 'Familiar':
                return new Process(
                    $postData['tipo_processo'],
                    $postData['nome_cliente'],
                    $postData['cpf_cliente'],
                    $postData['oponente'],
                    $postData['cpf_oponente'],
                    $postData['descricao'],
                    $postData['fatos'],
                    $postData['direito_violado'],
                    $postData['pedido'],
                    $postData['juizo'],
                    $postData['cortes'],
                    $postData['comarca'],
                    $postData['valor_causa'],
                    $postData['advogado'],
                    $postData['oab'],
                    $postData['contato_advogado'],
                    $postData['data_protocolacao'] ?? date('Y-m-d'),
                    $postData['objeto_conflito']
                );
            case 'Trabalhista':
                return new Process(
                    $postData['tipo_processo'],
                    $postData['nome_cliente'],
                    $postData['cpf_cliente'],
                    $postData['oponente'],
                    $postData['cpf_oponente'],
                    $postData['descricao'],
                    $postData['fatos'],
                    $postData['direito_violado'],
                    $postData['pedido'],
                    $postData['juizo'],
                    $postData['cortes'],
                    $postData['comarca'],
                    $postData['valor_causa'],
                    $postData['advogado'],
                    $postData['oab'],
                    $postData['contato_advogado'],
                    $postData['data_protocolacao'] ?? date('Y-m-d'),
                    $postData['objeto_conflito']
                );
            default:
                throw new Exception("Tipo de processo inválido");
        }
    }
}
?>
