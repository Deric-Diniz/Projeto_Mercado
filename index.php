<?php include_once "factory/conexao.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minimercado - Gestão de Clientes</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Estilos para a tabela CRUD se integrarem ao layout card */
        .crud-table { width: 100%; border-collapse: collapse; margin-top: 25px; font-size: 14px; }
        .crud-table th, .crud-table td { padding: 10px; text-align: left; border-bottom: 1px solid #eef2f5; }
        .crud-table th { background-color: #f8f9fa; color: #34495e; font-weight: 600; }
        .btn-action { text-decoration: none; padding: 5px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; margin-right: 5px; }
        .btn-edit { background-color: #f1c40f; color: #fff; }
        .btn-delete { background-color: #e74c3c; color: #fff; }
    </style>
</head>
<body>
    <div class="container" style="max-width: 700px;"> <nav class="nav-bar">
            <a href="index.php" class="nav-link active">Clientes</a>
            <a href="produto.php" class="nav-link">Produtos</a>
        </nav>

        <header class="form-header">
            <h2>Cadastro de Cliente (Fidelidade)</h2>
            <p>Insira os dados do cliente para o programa de vantagens do minimercado.</p>
        </header>

        <form action="inserircliente.php" method="POST" onsubmit="return validarCliente();">
            <div class="form-group">
                <label for="nome">Nome Completo:</label>
                <input type="text" id="nome" name="cxnome" placeholder="Ex: João Silva">
            </div>

            <div class="form-group">
                <label for="idade">Idade:</label>
                <input type="number" id="idade" name="cxidade" placeholder="Ex: 25">
            </div>

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="cxemail" placeholder="Ex: joao@email.com">
            </div>

            <button type="submit" class="btn-submit">Registrar Cliente</button>
        </form>

        <h3 style="margin-top: 30px; color: #2c3e50;">Clientes Registrados</h3>
        <table class="crud-table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Idade</th>
                    <th>E-mail</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM tb_clientes ORDER BY codigo DESC");
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                    echo "<td>" . $row['idade'] . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>
                            <a href='editarcliente.php?id=" . $row['codigo'] . "' class='btn-action btn-edit'>Editar</a>
                            <a href='excluircliente.php?id=" . $row['codigo'] . "' class='btn-action btn-delete' onclick=\"return confirm('Deseja mesmo remover este cliente do sistema?');\">Excluir</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function validarCliente() {
            const nome = document.getElementById('nome').value.trim();
            const idade = document.getElementById('idade').value.trim();
            const email = document.getElementById('email').value.trim();

            if (nome === "") { alert("O campo Nome é obrigatório."); return false; }
            if (idade === "" || isNaN(idade) || parseInt(idade) <= 0) { alert("Por favor, insira uma idade válida."); return false; }
            if (email === "") { alert("O campo E-mail é obrigatório."); return false; }
            return true;
        }
    </script>
</body>
</html>