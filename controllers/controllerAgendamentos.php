<?php

require("conexao.php");

 
// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idAgendamento = (isset($_POST["idAgendamento"]) && $_POST["idAgendamento"] != null) ? $_POST["idAgendamento"] : "";
    $idAvaliadorFK = (isset($_POST["idAvaliadorFK"]) && $_POST["idAvaliadorFK"] != null) ? $_POST["idAvaliadorFK"] : "";
    $idAvaliadoFK = (isset($_POST["idAvaliadoFK"]) && $_POST["idAvaliadoFK"] != null) ? $_POST["idAvaliadoFK"] : "";
    $idCompromissoFK = (isset($_POST["idCompromissoFK"]) && $_POST["idCompromissoFK"] != null) ? $_POST["idCompromissoFK"] : "";
    $idClienteFK = (isset($_POST["idClienteFK"]) && $_POST["idClienteFK"] != null) ? $_POST["idClienteFK"] : "";
    $semana = (isset($_POST["semana"]) && $_POST["semana"] != null) ? $_POST["semana"] : "";
    
    

} else if (!isset($idAgendamento)) {
    // Se não se não foi setado nenhum valor para variável $idAgendamento
    $idAgendamento = (isset($_GET["idAgendamento"]) && $_GET["idAgendamento"] != null) ? $_GET["idAgendamento"] : "";
    $idAvaliadorFK = NULL;
    $idAvaliadoFK = NULL;
    $idCompromissoFK = NULL;
    $idClienteFK= NULL;
    $semana= NULL;

   
}
 
// Bloco If que Salva os dados no Banco - atua como Create e Update
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $idAvaliadoFK != "") {
    try {
        if ($idAgendamento != "") {
            $stmt = $conexao->prepare("UPDATE agendamentos SET idAvaliadorFK=?, idAvaliadoFK=?, idCompromissoFK=?, idClienteFK=?, semana=?  WHERE idAgendamento = ?");
            $stmt->bindParam(1, $idAvaliadorFK, PDO::PARAM_INT);
            $stmt->bindParam(2, $idAvaliadoFK, PDO::PARAM_INT);
            $stmt->bindParam(3, $idCompromissoFK, PDO::PARAM_INT);
            $stmt->bindParam(4, $idClienteFK, PDO::PARAM_INT);
            $stmt->bindParam(5, $semana->date_format, PDO::PARAM_STR, 40);
            $stmt->bindParam(6, $idAgendamento, PDO::PARAM_INT);

           
        } else {
            $stmt = $conexao->prepare("INSERT INTO agendamentos (idAvaliadorFK, idAvaliadoFK, idCompromissoFK, idClienteFK, semana) VALUES (?,?,?,?,?)");            
            $stmt->bindParam(1, $idAvaliadorFK, PDO::PARAM_INT);
            $stmt->bindParam(2, $idAvaliadoFK, PDO::PARAM_INT);
            $stmt->bindParam(3, $idCompromissoFK, PDO::PARAM_INT);
            $stmt->bindParam(4, $idClienteFK, PDO::PARAM_INT);
            $stmt->bindParam(5, $semana, PDO::PARAM_STR, 40);
            
                        
        }
              
       
 
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "Dados cadastrados com sucesso!";
                $idAgendamento = null;
                $idAvaliadorFK = null;
                $idAvaliadoFK = null;
                $idCompromissoFK = null;
                $idClienteFK = null;
                $semana = null;
            
               
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
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $idAgendamento != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM agendamentos WHERE idAgendamento = ?");

        
        $stmt->bindParam(1, $idAgendamento, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $idAgendamento = $rs->idAgendamento;
            $idAvaliadorFK = $rs->idAvaliadorFK;
            $idAvaliadoFK = $rs->idAvaliadoFK;
            $idCompromissoFK = $rs->idCompromissoFK;
            $idClienteFK = $rs->idClienteFK;
            $semana = $rs->semana;

            
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}




 
// Bloco if utilizado pela etapa Delete
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $idAgendamento != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM agendamentos WHERE idAgendamento = ?");
        $stmt->bindParam(1, $idAgendamento, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "Registo foi excluído com êxito";
            $idAgendamento = null;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}
?>
