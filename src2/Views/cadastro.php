<?php
// Importar Validators
require_once __DIR__ . '/../Validators/FamilyValidator.php';
require_once __DIR__ . '/../Validators/CriminalValidator.php';
require_once __DIR__ . '/../Validators/LaborValidator.php';
require_once __DIR__ . '/../Validators/CivilValidator.php';

// Dados dinâmicos
$tipoProcesso = $_POST['tipo_processo'] ?? '';

$objetoConflito = [];
$direitoViolado = [];
$cortes = [];

//carrega do validator os dados com base no tipo selecionado
switch ($tipoProcesso) {
    case 'Familiar':
        $objetoConflito = FamilyValidator::getObjetoConflito();
        $direitoViolado = FamilyValidator::getDireitoViolado();
        $cortes = FamilyValidator::getCortes();
        break;
    case 'Criminal':
        $objetoConflito = CriminalValidator::getObjetoConflito();
        $direitoViolado = CriminalValidator::getDireitoViolado();
        $cortes = CriminalValidator::getCortes();
        break;
    case 'Trabalhista':
        $objetoConflito = LaborValidator::getObjetoConflito();
        $direitoViolado = LaborValidator::getDireitoViolado();
        $cortes = LaborValidator::getCortes();
        break;
    case 'Civil':
        $objetoConflito = CivilValidator::getObjetoConflito();
        $direitoViolado = CivilValidator::getDireitoViolado();
        $cortes = CivilValidator::getCortes();
        break;
    default:
        $tipoProcesso = '';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Processos</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/src2/Views/css/cadastro.css">
</head>
<body>
    <div class="container">
        <h1>Cadastro de Processos</h1>
        <form action="" method="POST">
            <label for="tipo_processo">Tipo de Processo</label><br>
            <select name="tipo_processo" id="tipo_processo" required onchange="this.form.submit()">
                <option value="">-- Selecione --</option>
                <option value="Civil" <?= $tipoProcesso == 'Civil' ? 'selected' : '' ?>>Civil</option>
                <option value="Criminal" <?= $tipoProcesso == 'Criminal' ? 'selected' : '' ?>>Criminal</option>
                <option value="Trabalhista" <?= $tipoProcesso == 'Trabalhista' ? 'selected' : '' ?>>Trabalhista</option>
                <option value="Familiar" <?= $tipoProcesso == 'Familiar' ? 'selected' : '' ?>>Familiar</option>
            </select>

            <?php if ($tipoProcesso): ?>
                <label for="objeto_conflito">Objeto de Conflito</label>
                <select name="objeto_conflito" id="objeto_conflito" required>
                    <option value="">-- Selecione --</option>
                    <?php foreach ($objetoConflito as $item): ?>
                        <option value="<?= $item ?>"><?= $item ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="direito_violado">Direito Violado</label>
                <select name="direito_violado" id="direito_violado" required>
                    <option value="">-- Selecione --</option>
                    <?php foreach ($direitoViolado as $item): ?>
                        <option value="<?= $item ?>"><?= $item ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="cortes">Cortes</label>
                <select name="cortes" id="cortes" required>
                    <option value="">-- Selecione --</option>
                    <?php foreach ($cortes as $item): ?>
                        <option value="<?= $item ?>"><?= $item ?></option>
                    <?php endforeach; ?>
                </select>
              <label for="nome_cliente">Nome do Cliente</label>
            <input type="text" name="nome_cliente" id="nome_cliente" required>

            <label for="cpf_cliente">CPF do Cliente</label>
            <input type="text" name="cpf_cliente" id="cpf_cliente" required>

            <label for="oponente">Nome do Oponente</label>
            <input type="text" name="oponente" id="oponente" required>

            <label for="cpf_oponente">CPF do Oponente</label>
            <input type="text" name="cpf_oponente" id="cpf_oponente" required>

            <label for="descricao">Descrição do Caso</label>
            <textarea name="descricao" id="descricao" required></textarea>

            <label for="fatos">Fatos do Caso</label>
            <textarea name="fatos" id="fatos" required></textarea>

            <label for="pedido">Pedido</label>
            <textarea name="pedido" id="pedido" required></textarea>

            <label for="juizo">Juízo</label>
            <input type="text" name="juizo" id="juizo" required>


            <label for="comarca">Comarca</label>
            <input type="text" name="comarca" id="comarca" required>

            <label for="valor_causa">Valor da Causa</label>
            <input type="number" name="valor_causa" id="valor_causa" required step="0.01">

            <label for="advogado">Nome do Advogado</label>
            <input type="text" name="advogado" id="advogado" required>

            <label for="oab">OAB do Advogado</label>
            <input type="text" name="oab" id="oab" required>

            <label for="contato_advogado">Contato do Advogado</label>
            <input type="text" name="contato_advogado" id="contato_advogado" required>

            <button type="submit" formaction="../process_form.php">Cadastrar Processo</button>
            <?php endif; ?>

        </form>
    </div>
</body>
</html>
