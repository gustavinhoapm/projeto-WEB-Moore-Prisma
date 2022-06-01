<?php

require("conexao.php");
 
// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idAvaliado = (isset($_POST["idAvaliado"]) && $_POST["idAvaliado"] != null) ? $_POST["idAvaliado"] : "";
    $idCargoFK = (isset($_POST["idCargoFK"]) && $_POST["idCargoFK"] != null) ? $_POST["idCargoFK"] : "";
    $avaliado = (isset($_POST["avaliado"]) && $_POST["avaliado"] != null) ? $_POST["avaliado"] : "";
    $crc = (isset($_POST["crc"]) && $_POST["crc"] != null) ? $_POST["crc"] : "";
    $certificacao = (isset($_POST["certificacao"]) && $_POST["certificacao"] != null) ? $_POST["certificacao"] : "";

    
    

} else if (!isset($idAvaliado)) {
    // Se não se não foi setado nenhum valor para variável $idAvaliado
    $idAvaliado = (isset($_GET["idAvaliado"]) && $_GET["idAvaliado"] != null) ? $_GET["idAvaliado"] : "";
    $idCargoFK = NULL;
    $avaliado = NULL;
    $crc = NULL;
    $certificacao= NULL;

   
}


// Bloco If que Salva os dados no Banco - atua como Create e Update
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $avaliado != "") {
    try {
        if ($idAvaliado != "") {
            $stmt = $conexao->prepare("UPDATE avaliados SET idCargoFK=?, avaliado=?, crc=?, certificacao=?  WHERE idAvaliado = ?");
            $stmt->bindParam(1, $idCargoFK, PDO::PARAM_INT);
            $stmt->bindParam(2, $avaliado, PDO::PARAM_STR, 60);
            $stmt->bindParam(3, $crc, PDO::PARAM_STR, 200);
            $stmt->bindParam(4, $certificacao, PDO::PARAM_STR, 200);
            $stmt->bindParam(5, $idAvaliado, PDO::PARAM_INT);

           
        } else {
            $stmt = $conexao->prepare("INSERT INTO avaliados (idCargoFK, avaliado, crc, certificacao) VALUES (?,?,?,?)");            
            $stmt->bindParam(1, $idCargoFK, PDO::PARAM_INT);
            $stmt->bindParam(2, $avaliado, PDO::PARAM_STR, 60);
            $stmt->bindParam(3, $crc, PDO::PARAM_STR, 300);
            $stmt->bindParam(4, $certificacao, PDO::PARAM_STR, 300);
            
                        
        }
              
       
 
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "Dados cadastrados com sucesso!";
                $idAvaliado = null;
                $idCargoFK = null;
                $avaliado = null;
                $crc = null;
                $certificacao = null;
            
               
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
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $idAvaliado != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM avaliados WHERE idAvaliado = ?");

        
        $stmt->bindParam(1, $idAvaliado, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $idAvaliado = $rs->idAvaliado;
            $idCargoFK = $rs->idCargoFK;
            $avaliado = $rs->avaliado;
            $crc = $rs->crc;
            $certificacao = $rs->certificacao;

            
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}




 
// Bloco if utilizado pela etapa Delete
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $idAvaliado != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM avaliados WHERE idAvaliado = ?");
        $stmt->bindParam(1, $idAvaliado, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "Registo foi excluído com êxito";
            $idAvaliado = null;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}
?>
