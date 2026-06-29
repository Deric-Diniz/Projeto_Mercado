<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    include_once "factory/conexao.php";
    
    $id = (int)$_GET['id'];
    $sql = "DELETE FROM tb_clientes WHERE codigo = $id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Cliente removido com sucesso!');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "Erro ao excluir cliente: " . mysqli_error($conn);
    }
    mysqli_close($conn);
} else {
    header("Location: index.php");
}
?>