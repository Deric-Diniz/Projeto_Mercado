<?php
if (isset($_POST["cxid"]) && isset($_POST["cxproduto"]) && trim($_POST["cxproduto"]) != "") {
    include_once "factory/conexao.php";

    $id = (int)$_POST['cxid'];
    $produto = mysqli_real_escape_string($conn, $_POST['cxproduto']);
    $lote = (int)$_POST['cxlote'];
    $validade = mysqli_real_escape_string($conn, $_POST['cxvalidade']);

    $sql = "UPDATE tb_produtos SET nome_produto = '$produto', lote = $lote, validade = '$validade' WHERE codigo = $id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Dados do produto atualizados com sucesso!');
                window.location.href = 'produto.php';
              </script>";
    } else {
        echo "Erro ao atualizar produto: " . mysqli_error($conn);
    }
    mysqli_close($conn);
} else {
    header("Location: produto.php");
}
?>