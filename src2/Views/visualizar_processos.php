<?php
require_once __DIR__ . '/../Controller/ProcessController.php';

try {
    // Criando uma instância do Controller
    $processController = new ProcessController();

    if (isset($_GET['search']) && !empty($_GET['search'])) {
        // Realiza a busca
        $searchTerm = $_GET['search'];
        $processos = $processController->searchProcess($searchTerm);

        if (empty($processos)) {
            $error = "Nenhum processo encontrado com o termo '$searchTerm'.";
        }
    } else {
        // Exibe todos os processos
        $processos = $processController->getAllProcesses();
    }
} catch (Exception $e) {
    $error = "Erro ao buscar processos: " . $e->getMessage();
}

// Verificando se o formulário de exclusão foi submetido
if (isset($_POST['delete_id'])) {
    try {
        // Excluindo o processo
        $processController->deleteProcess($_POST['delete_id']);
        header("Location: visualizar_processos.php");
        exit;
    } catch (Exception $e) {
        $error = "Erro ao excluir o processo: " . $e->getMessage();
    }
}

// Verificando se o formulário de atualização foi submetido
if (isset($_POST['update_id'])) {
    try {
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        $processController->updateProcess($_POST);
        header("Location: visualizar_processos.php");
        exit;
    } catch (Exception $e) {
        $error = "Erro ao atualizar o processo: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Processos</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/src2/Views/css/visualizacao_processos.css">
</head>
<body>
    <div class="container">
        <h1>Processos Cadastrados</h1>

        <!-- Exibição de erros -->
        <?php if (isset($error)): ?>
            <div class="error-message" style="color: red; margin-bottom: 20px;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <!-- Formulário de busca -->
        <form method="GET" action="visualizar_processos.php">
            <label for="search">Buscar processo por ID ou número:</label>
            <input type="text" name="search" id="search" placeholder="Digite o ID ou número do processo">
            <button type="submit">Buscar</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo de Processo</th>
                    <th>Nome do Cliente</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($processos)): ?>
                    <?php foreach ($processos as $processo): ?>
                        <tr>
                            <td><?= htmlspecialchars($processo['id']) ?></td>
                            <td><?= htmlspecialchars($processo['tipoProcesso']) ?></td>
                            <td><?= htmlspecialchars($processo['autorNome']) ?></td>
                            <td><?= htmlspecialchars($processo['descricaoCaso']) ?></td>
                            <td class="actions">
                                <!-- Detalhar -->
                                <button class="detalhar-button" onclick="openModal(<?= $processo['id'] ?>, 'detalhar')">Detalhar</button>

                                <!-- Atualizar -->
                                <button class="atualizar-button" onclick="openModal(<?= $processo['id'] ?>, 'atualizar')">Atualizar</button>

                                <!-- Excluir -->
                                <form action="visualizar_processos.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="delete_id" value="<?= $processo['id'] ?>">
                                    <button type="submit" class="delete-button" onclick="return confirm('Tem certeza que deseja excluir este processo?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">Nenhum processo encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="index.php" class="button">Voltar à Home</a>
    </div>

    <!-- Modal de Detalhamento -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div id="modalContent"></div>
        </div>
    </div>

    <script>
        // Função para abrir o modal
        function openModal(id, tipo) {
            let url = tipo === 'detalhar' ? 'detalhar_processo.php?id=' + id : 'atualizar_processo.php?id=' + id;

            fetch(url)
                .then(response => response.text())
                .then(data => {
                    // Preenche o conteúdo do modal
                    document.getElementById('modalContent').innerHTML = data;
                    
                    // Exibe o modal
                    document.getElementById('modal').style.display = "block";
                })
                .catch(error => {
                    console.error('Erro ao carregar o conteúdo do modal:', error);
                });
        }

        // Função para fechar o modal
        function closeModal() {
            document.getElementById('modal').style.display = "none";
        }
    </script>
</body>
</html>
