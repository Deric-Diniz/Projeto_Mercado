<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    include_once "factory/conexao.php";
    
    $id = (int)$_GET['id'];
    $sql = "DELETE FROM tb_produtos WHERE codigo = $id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Produto removido do estoque com sucesso!');
                window.location.href = 'produto.php';
              </script>";
    } else {
        echo "Erro ao excluir produto: " . mysqli_error($conn);
    }
    mysqli_close($conn);
} else {
    header("Location: produto.php");
}
?>