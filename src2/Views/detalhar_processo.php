<?php
// Incluindo o controlador
require_once __DIR__ . '/../Controller/ProcessController.php';

// Verificando se o ID foi fornecido
if (!isset($_GET['id'])) {
    die("ID do processo não fornecido.");
}

try {
    // Criando uma instância do ProcessController
    $controller = new ProcessController();

    // Usando o método getProcessById para buscar o processo
    $processo = $controller->getProcessById($_GET['id']);

    // Verificando se o processo existe
    if (!$processo) {
        die("Processo não encontrado.");
    }
} catch (Exception $e) {
    die("Erro ao buscar o processo: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Processo</title>
</head>
<body>
    <h1>Detalhes do Processo</h1>
    <table border="1">
        <tr>
            <th>Tipo de Processo</th>
            <td><?= htmlspecialchars($processo['tipoProcesso']) ?></td>
        </tr>
        <tr>
            <th>Nome do Autor</th>
            <td><?= htmlspecialchars($processo['autorNome']) ?></td>
        </tr>
        <tr>
            <th>Identificação do Autor</th>
            <td><?= htmlspecialchars($processo['autorIdentificacao']) ?></td>
        </tr>
        <tr>
            <th>Nome do Réu</th>
            <td><?= htmlspecialchars($processo['reuNome']) ?></td>
        </tr>
        <tr>
            <th>Identificação do Réu</th>
            <td><?= htmlspecialchars($processo['reuIdentificacao']) ?></td>
        </tr>
        <tr>
            <th>Objeto de Conflito</th>
            <td><?= htmlspecialchars($processo['objetoConflito']) ?></td>
        </tr>
        <tr>
            <th>Descrição do Caso</th>
            <td><?= htmlspecialchars($processo['descricaoCaso']) ?></td>
        </tr>
        <tr>
            <th>Fatos</th>
            <td><?= htmlspecialchars($processo['fatos']) ?></td>
        </tr>
        <tr>
            <th>Direito Violado</th>
            <td><?= htmlspecialchars($processo['direitoViolado']) ?></td>
        </tr>
        <tr>
            <th>Pedido</th>
            <td><?= htmlspecialchars($processo['pedido']) ?></td>
        </tr>
        <tr>
            <th>Juízo</th>
            <td><?= htmlspecialchars($processo['juizo']) ?></td>
        </tr>
        <tr>
            <th>Vara do Tribunal</th>
            <td><?= htmlspecialchars($processo['varaTribunal']) ?></td>
        </tr>
        <tr>
            <th>Comarca</th>
            <td><?= htmlspecialchars($processo['comarca']) ?></td>
        </tr>
        <tr>
            <th>Valor da Causa</th>
            <td>R$ <?= htmlspecialchars(number_format($processo['valorCausa'], 2, ',', '.')) ?></td>
        </tr>
        <tr>
            <th>Nome do Advogado</th>
            <td><?= htmlspecialchars($processo['advogadoNome']) ?></td>
        </tr>
        <tr>
            <th>OAB do Advogado</th>
            <td><?= htmlspecialchars($processo['advogadoOAB']) ?></td>
        </tr>
        <tr>
            <th>Contato do Advogado</th>
            <td><?= htmlspecialchars($processo['advogadoContato']) ?></td>
        </tr>
        <tr>
        <th>Data de Protocolação</th>
    <td>
        <?php 
        if (!empty($processo['dataProtocolacao'])) {
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $processo['dataProtocolacao']);
            
            if ($date) {
                echo htmlspecialchars($date->format('d/m/Y'));
            } else {
                echo "Data inválida";
            }
        } else {
            echo "Data não fornecida";
        }
        ?>
    </td>
        </tr>
    </table>
    <br>
    <a href="visualizar_processos.php">Voltar à Visualização</a>
</body>
</html>
