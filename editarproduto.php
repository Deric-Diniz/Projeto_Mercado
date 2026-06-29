<?php
include_once "factory/conexao.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: produto.php");
    exit;
}

$id = (int)$_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tb_produtos WHERE codigo = $id");
$produto = mysqli_fetch_array($query);

if (!$produto) {
    echo "<script>alert('Produto não encontrado!'); window.location.href='produto.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minimercado - Editar Produto</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header class="form-header">
            <h2>Editar Registro de Produto</h2>
            <p>Modifique as propriedades do lote ou item selecionado.</p>
        </header>

        <form action="atualizarproduto.php" method="POST">
            <input type="hidden" name="cxid" value="<?php echo $produto['codigo']; ?>">

            <div class="form-group">
                <label for="produto">Nome do Produto:</label>
                <input type="text" id="produto" name="cxproduto" value="<?php echo htmlspecialchars($produto['nome_produto']); ?>" required>
            </div>

            <div class="form-group">
                <label for="lote">Número do Lote:</label>
                <input type="number" id="lote" name="cxlote" value="<?php echo $produto['lote']; ?>" required>
            </div>

            <div class="form-group">
                <label for="validade">Data de Validade:</label>
                <input type="date" id="validade" name="cxvalidade" value="<?php echo $produto['validade']; ?>" required>
            </div>

            <button type="submit" class="btn-submit">Salvar Alterações</button>
            <a href="produto.php" style="display: block; text-align: center; margin-top: 15px; color: #7f8c8d; text-decoration: none;">Cancelar</a>
        </form>
    </div>
</body>
</html>