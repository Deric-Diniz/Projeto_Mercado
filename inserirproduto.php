<?php
/**
 * PROCESSADOR BACKEND - INSERÇÃO DE PRODUTOS
 * Valida o payload de entrada do estoque do minimercado e insere no banco de dados.
 */

if (isset($_POST["cxproduto"]) && trim($_POST["cxproduto"]) != "") {
    
    // Inclusão da conexão única
    include_once "factory/conexao.php";

    // Coleta e higienização dos dados do produto contra manipulação de queries
    $produto  = mysqli_real_escape_string($conn, $_POST['cxproduto']);
    $lote     = (int)$_POST['cxlote'];
    $validade = mysqli_real_escape_string($conn, $_POST['cxvalidade']);

    // Correção: Mapeamento da query alterado para 'tb_produtos' e coluna 'nome_produto'
    $sql = "INSERT INTO tb_produtos (nome_produto, lote, validade) VALUES ('$produto', $lote, '$validade')";
    
    if (mysqli_query($conn, $sql)) {
        echo "
        <script>
            alert('Produto inserido com sucesso no estoque do minimercado!');
            window.location.href = 'produto.php';
        </script>
        ";
    } else {
        echo "Erro de execução de inserção: " . mysqli_error($conn);
    }

    mysqli_close($conn);

} else {
    echo "<script>
            alert('Erro: O nome do produto não pode estar vazio.');
            window.location.href = 'produto.php';
          </script>";
}
?>