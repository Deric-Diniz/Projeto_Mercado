<?php
if (isset($_POST["cxid"]) && isset($_POST["cxnome"]) && trim($_POST["cxnome"]) != "") {
    include_once "factory/conexao.php";

    $id = (int)$_POST['cxid'];
    $nome = mysqli_real_escape_string($conn, $_POST['cxnome']);
    $idade = (int)$_POST['cxidade'];
    $email = mysqli_real_escape_string($conn, $_POST['cxemail']);

    $sql = "UPDATE tb_clientes SET nome = '$nome', email = '$email', idade = $idade WHERE codigo = $id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Dados do cliente atualizados com sucesso!');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "Erro ao atualizar dados: " . mysqli_error($conn);
    }
    mysqli_close($conn);
} else {
    header("Location: index.php");
}
?>