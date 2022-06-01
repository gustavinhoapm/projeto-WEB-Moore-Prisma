<?php





// Cria a conexão com o banco de dados
try {
    $conexao = new PDO("mysql:host=localhost;dbname=db_avaliacoes", "root", "Ck#fr2843");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "Erro na conexão:".$erro->getMessage();
}

?>