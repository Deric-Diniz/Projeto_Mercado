<?php
include_once "factory/conexao.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int)$_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tb_clientes WHERE codigo = $id");
$cliente = mysqli_fetch_array($query);

if (!$cliente) {
    echo "<script>alert('Cliente não encontrado!'); window.location.href='index.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minimercado - Editar Cliente</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header class="form-header">
            <h2>Editar Registro de Cliente</h2>
            <p>Modifique os campos abaixo para atualizar os dados no sistema.</p>
        </header>

        <form action="atualizarcliente.php" method="POST">
            <input type="hidden" name="cxid" value="<?php echo $cliente['codigo']; ?>">

            <div class="form-group">
                <label for="nome">Nome Completo:</label>
                <input type="text" id="nome" name="cxnome" value="<?php echo htmlspecialchars($cliente['nome']); ?>" required>
            </div>

            <div class="form-group">
                <label for="idade">Idade:</label>
                <input type="number" id="idade" name="cxidade" value="<?php echo $cliente['idade']; ?>" required>
            </div>

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="cxemail" value="<?php echo htmlspecialchars($cliente['email']); ?>" required>
            </div>

            <button type="submit" class="btn-submit">Salvar Alterações</button>
            <a href="index.php" style="display: block; text-align: center; margin-top: 15px; color: #7f8c8d; text-decoration: none;">Cancelar</a>
        </form>
    </div>
</body>
</html>