<?php
/* PROCESSADOR BACKEND - INSERÇÃO DE CLIENTES
 * Executa as transações SQL de persistência. */

if (isset($_POST["cxnome"]) && trim($_POST["cxnome"]) != "") {
    
    // __DIR__ garante que o PHP procure a pasta 'factory' a partir de onde este arquivo está salvo
    $caminhoConexao = __DIR__ . "/factory/conexao.php";

    if (!file_exists($caminhoConexao)) {
        die("<script>
                alert('Erro crítico: O arquivo conexao.php não foi encontrado na pasta factory. Verifique a estrutura de diretórios!');
                window.location.href = 'index.php';
             </script>");
    }

    // Inclusão segura da conexão
    include_once $caminhoConexao;

    // SOLUÇÃO DO ERRO CRÍTICO:
    // Se o arquivo conexao.php usou o nome '$conexao', nós a copiamos para '$conn'.
    // Isso une as duas versões e impede que o script pare com o "Erro crítico".
    if (isset($conexao) && !isset($conn)) {
        $conn = $conexao;
    }

    // Dupla checagem de segurança
    if (!isset($conn) || !$conn) {
        die("Erro crítico: A variável de conexão (\$conn ou \$conexao) não foi inicializada corretamente no arquivo factory/conexao.php.");
    }

    // Proteção contra ataques de SQL Injection nas strings recebidas
    $nome  = mysqli_real_escape_string($conn, $_POST['cxnome']);
    $idade = (int)$_POST['cxidade'];
    $email = mysqli_real_escape_string($conn, $_POST['cxemail']);

    // Query com mapeamento ajustado para a tabela do Minimercado
    $sql = "INSERT INTO tb_clientes (nome, email, idade) VALUES ('$nome', '$email', $idade)";
    
    if (mysqli_query($conn, $sql)) {
        echo "
        <script>
            alert('Cliente cadastrado com sucesso no sistema do Minimercado!');
            window.location.href = 'index.php';
        </script>
        ";
    } else {
        echo "Erro ao cadastrar dados no banco: " . mysqli_error($conn);
    }
    
    // Libera os recursos de conexão ativos
    mysqli_close($conn);

} else {
    echo "<script>
            alert('Erro: O campo Nome não pode estar em branco.');
            window.location.href = 'index.php';
          </script>";
}
?>