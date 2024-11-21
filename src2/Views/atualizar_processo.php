<?php
// Incluindo o controlador
require_once __DIR__ . '/../Controller/ProcessController.php';

// Verificando se o ID foi fornecido
if (!isset($_GET['id'])) {
    die("ID do processo não fornecido.");
}

$controller = new ProcessController();

try {
    // Buscando os detalhes do processo
    $processo = $controller->getProcessById($_GET['id']);
    if (!$processo) {
        die("Processo não encontrado.");
    }

    // Verifica se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->updateProcess($_POST);
        header("Location: visualizar_processos.php"); // Redireciona aDPs atualização
        exit();
    }
} catch (Exception $e) {
    die("Erro: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Processo</title>
</head>
<body>
    <h1>Atualizar Processo</h1>
    <form action="visualizar_processos.php" method="POST">
    <input type="hidden" name="update_id" value="<?= htmlspecialchars($processo['id']) ?>">

        <label for="tipo_processo">Tipo de Processo:</label>
        <input type="text" name="tipo_processo" value="<?= htmlspecialchars($processo['tipoProcesso']) ?>"><br>

        <label for="nome_cliente">Nome do Cliente:</label>
        <input type="text" name="nome_cliente" value="<?= htmlspecialchars($processo['autorNome']) ?>"><br>

        <label for="cpf_cliente">CPF do Cliente:</label>
        <input type="text" name="cpf_cliente" value="<?= htmlspecialchars($processo['autorIdentificacao']) ?>"><br>

        <label for="oponente">Nome do Oponente:</label>
        <input type="text" name="oponente" value="<?= htmlspecialchars($processo['reuNome']) ?>"><br>

        <label for="cpf_oponente">CPF do Oponente:</label>
        <input type="text" name="cpf_oponente" value="<?= htmlspecialchars($processo['reuIdentificacao']) ?>"><br>

        <label for="descricao">Descrição do Caso:</label>
        <textarea name="descricao"><?= htmlspecialchars($processo['descricaoCaso']) ?></textarea><br>

        <label for="valor_causa">Valor da Causa:</label>
        <input type="text" name="valor_causa" value="<?= htmlspecialchars($processo['valorCausa']) ?>"><br>

        <button type="submit">Atualizar Processo</button>
    </form>
</body>
</html>
