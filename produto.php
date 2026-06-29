<?php include_once "factory/conexao.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minimercado - Gestão de Produtos</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .crud-table { width: 100%; border-collapse: collapse; margin-top: 25px; font-size: 14px; }
        .crud-table th, .crud-table td { padding: 10px; text-align: left; border-bottom: 1px solid #eef2f5; }
        .crud-table th { background-color: #f8f9fa; color: #34495e; font-weight: 600; }
        .btn-action { text-decoration: none; padding: 5px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; margin-right: 5px; }
        .btn-edit { background-color: #f1c40f; color: #fff; }
        .btn-delete { background-color: #e74c3c; color: #fff; }
    </style>
</head>
<body>
    <div class="container" style="max-width: 700px;">
        <nav class="nav-bar">
            <a href="index.php" class="nav-link">Clientes</a>
            <a href="produto.php" class="nav-link active">Produtos</a>
        </nav>

        <header class="form-header">
            <h2>Cadastro de Produto (Estoque)</h2>
            <p>Gerencie a entrada de novos itens no estoque do minimercado.</p>
        </header>

        <form action="inserirproduto.php" method="POST" onsubmit=\"return validarProduto();\">
            <div class="form-group">
                <label for="produto">Nome do Produto:</label>
                <input type="text" id="produto" name="cxproduto" placeholder="Ex: Arroz Integral 1kg">
            </div>

            <div class="form-group">
                <label for="lote">Número do Lote:</label>
                <input type="number" id="lote" name="cxlote" placeholder="Ex: 202601">
            </div>

            <div class="form-group">
                <label for="validade">Data de Validade:</label> 
                <input type="date" id="validade" name="cxvalidade">
            </div>

            <button type="submit" class="btn-submit">Cadastrar Produto</button>
        </form>

        <h3 style="margin-top: 30px; color: #2c3e50;">Produtos em Estoque</h3>
        <table class="crud-table">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Lote</th>
                    <th>Validade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM tb_produtos ORDER BY codigo DESC");
                while ($row = mysqli_fetch_array($result)) {
                    // Inverte a data de YYYY-MM-DD para DD/MM/YYYY na exibição da tabela
                    $data_formatada = date('d/m/Y', strtotime($row['validade']));
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['nome_produto']) . "</td>";
                    echo "<td>" . $row['lote'] . "</td>";
                    echo "<td>" . $data_formatada . "</td>";
                    echo "<td>
                            <a href='editarproduto.php?id=" . $row['codigo'] . "' class='btn-action btn-edit'>Editar</a>
                            <a href='excluirproduto.php?id=" . $row['codigo'] . "' class='btn-action btn-delete' onclick=\"return confirm('Deseja mesmo remover permanentemente este produto do estoque?');\">Excluir</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function validarProduto() {
            const produto = document.getElementById('produto').value.trim();
            const lote = document.getElementById('lote').value.trim();
            const validade = document.getElementById('validade').value.trim();

            if (produto === "") { alert("O campo Nome do Produto é obrigatório."); return false; }
            if (lote === "" || isNaN(lote)) { alert("Insira um número de lote válido."); return false; }
            if (validade === "") { alert("A data de validade deve ser selecionada."); return false; }
            return true;
        }
    </script>
</body>
</html>