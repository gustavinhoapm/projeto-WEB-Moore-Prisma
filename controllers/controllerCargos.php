<?php 

require("conexao.php");
 
// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idCargo = (isset($_POST["idCargo"]) && $_POST["idCargo"] != null) ? $_POST["idCargo"] : ""; //verifica se foi iniciada, se é diferente de zero - "?" serve como uma espécie de condicional, pega $_POST ou " "
    $cargo = (isset($_POST["cargo"]) && $_POST["cargo"] != null) ? $_POST["cargo"] : "";

} else if (!isset($idCargo)) {
    // Se não se não foi setado nenhum valor para variável $idCargo
    $idCargo = (isset($_GET["idCargo"]) && $_GET["idCargo"] != null) ? $_GET["idCargo"] : "";
    $cargo = NULL;
   
}

// Bloco If que Salva os dados no Banco - atua como Create e Update
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $cargo != "") {
    try {
        if ($idCargo != "") {
            $stmt = $conexao->prepare("UPDATE cargos SET cargo=? WHERE idCargo = ?"); //stmt prepara uma declaração sql para execução
            $stmt->bindParam(1, $cargo, PDO::PARAM_STR, 40); //bindParam vincula o índice (parâmetro) indicado com a variável
            $stmt->bindParam(2, $idCargo, PDO::PARAM_INT);
        } else {
            $stmt = $conexao->prepare("INSERT INTO cargos (cargo) VALUES (?)");            
            $stmt->bindParam(1, $cargo, PDO::PARAM_STR, 40);            
        }
              
       
 
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) { //verifica se a contagem de linhas do resultado da expressão acima é maior que zero
                echo "Dados cadastrados com sucesso!";
                $idCargo = null; //seta os selects novamente como null após o update ou create
                $cargo = null;
               
            } else {
                echo "Erro ao tentar efetivar cadastro";
            }
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}

 
// Bloco if que recupera as informações no formulário, etapa utilizada pelo Update
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $idCargo != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM cargos WHERE idCargo = ?");
        $stmt->bindParam(1, $idCargo, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $idCargo = $rs->idCargo;
            $cargo = $rs->cargo;
            
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}

 
// Bloco if utilizado pela etapa Delete
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $idCargo != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM cargos WHERE idCargo = ?");
        $stmt->bindParam(1, $idCargo, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "Registo foi excluído com êxito";
            $idCargo = null;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}
?>