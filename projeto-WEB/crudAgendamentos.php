<?php
// Conectando ao banco de dados:
include 'controllers/controllerAgendamentos.php';
include 'controllers/conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/1ab94d0eba.js" crossorigin="anonymous"></script>
    <title>Agendamento</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>

    <link rel="stylesheet" href="assets\styles\style_form.css" />


  </head>


  <body>

    <div class="header">

      <a href="#default"><img src="./assets/img/img_logo.jfif" alt="logo" /></a>
      <div class="header-right">
          <a class="active" href="#home">Inicio</a>
          <a href="#contact">Contato</a>
          <a href="#about">Sobre</a>
          <a href="#help">Ajuda</a>
      </div>
    </div>


    <main class="container">
      <h2>Agendamento</h2>

      <form action="?act=save" method="POST" name="form1"  >
                    
                    <input type="hidden" name="idAgendamento"  
                    <?php                                  
                        // Preenche o idAgendamento no campo idAgendamento com um valor "value"
                        if (isset($idAgendamento) && $idAgendamento != null || $idAgendamento != "") {
                            echo "value=\"{$idAgendamento}\"";
                        }
                    ?> />
                    <br>

                    <?PHP
                        $conexao->exec('SET CHARACTER SET utf8');

                        $pegaAvaliador = $conexao->prepare("SELECT DISTINCT * FROM avaliadores ORDER BY avaliador");
                        $pegaAvaliador->execute();

                            $fetchAll = $pegaAvaliador->fetchAll();
                    ?>
                        <b>Avaliador:</b> <br>
                        <select name="idAvaliadorFK" class="form-control">
                            <?php
                                $temp=1; 
                                foreach ($fetchAll as $avaliadores) : ?>
                                <?php if($temp == 1){           
                                    echo '<option>  </option>';
                                    $temp =0;
                                    } ?>
                                <option value="<?php echo $avaliadores['idAvaliador']; ?>"
                                    <?php if ($avaliadores['idAvaliador'] == $idAvaliadorFK) : ?>
                                        selected
                                    <?php endif; ?>
                                ><?php echo $avaliadores['avaliador']; ?></option>
                            <?php endforeach; ?>
                        </select> 
                    <br>

                    <?PHP
                        $conexao->exec('SET CHARACTER SET utf8');

                        $pegaAvaliado = $conexao->prepare("SELECT DISTINCT * FROM avaliados ORDER BY avaliado");
                        $pegaAvaliado->execute();

                            $fetchAll = $pegaAvaliado->fetchAll();
                    ?>
                        <b>Avaliado:</b> <br>
                        <select name="idAvaliadoFK" class="form-control">
                            <?php
                                $temp=1; 
                                foreach ($fetchAll as $avaliados) : ?>
                                <?php if($temp == 1){           
                                    echo '<option>  </option>';
                                    $temp =0;
                                    } ?>
                                <option value="<?php echo $avaliados['idAvaliado']; ?>"
                                    <?php if ($avaliados['idAvaliado'] == $idAvaliadoFK) : ?>
                                        selected
                                    <?php endif; ?>
                                ><?php echo $avaliados['avaliado']; ?></option>
                            <?php endforeach; ?>
                        </select> 
                    <br>
                            <!-- ----------------------------------------------------->

                    <?PHP
                        $conexao->exec('SET CHARACTER SET utf8');

                        $pegaCliente = $conexao->prepare("SELECT DISTINCT * FROM clientes ORDER BY cliente");
                        $pegaCliente->execute();

                            $fetchAll = $pegaCliente->fetchAll();
                    ?>
                        <b>Cliente:</b> <br>
                        <select name="idClienteFK" class="form-control">
                            <?php
                                $temp=1; 
                                foreach ($fetchAll as $clientes) : ?>
                                <?php if($temp == 1){           
                                    echo '<option>  </option>';
                                    $temp =0;
                                    } ?>
                                <option value="<?php echo $clientes['idCliente']; ?>"
                                    <?php if ($clientes['idCliente'] == $idClienteFK) : ?>
                                        selected
                                    <?php endif; ?>
                                ><?php echo $clientes['cliente']; ?></option>
                            <?php endforeach; ?>
                        </select> 
                    <br>
                            <!-- ----------------------------------------------------->
                    <?PHP
                        $conexao->exec('SET CHARACTER SET utf8');

                        $pegaCompromisso = $conexao->prepare("SELECT DISTINCT * FROM compromissos ORDER BY compromisso");
                        $pegaCompromisso->execute();

                            $fetchAll = $pegaCompromisso->fetchAll();
                    ?>
                        <b>Compromisso:</b> <br>
                        <select name="idCompromissoFK" class="form-control">
                            <?php
                                $temp=1; 
                                foreach ($fetchAll as $compromissos) : ?>
                                <?php if($temp == 1){           
                                    echo '<option>  </option>';
                                    $temp =0;
                                    } ?>
                                <option value="<?php echo $compromissos['idCompromisso']; ?>"
                                    <?php if ($compromissos['idCompromisso'] == $idCompromissoFK) : ?>
                                        selected
                                    <?php endif; ?>
                                ><?php echo $compromissos['compromisso']; ?></option>
                            <?php endforeach; ?>
                        </select> 
                    <br>


                    <b>Semana:</b>
                    <input type="date" name="semana" class="form-control" <?php
        
                    // Preenche o semana no campo semana com um valor "value"
                    if (isset($semana) && $semana != null || $semana != "") {
                        echo "value=\"{$semana}\"";
                    }
                    ?> />


                    <!-- ----------------------------------------------------->




    <div>
        <input type="submit" value="salvar">
                                                                               
        <input type="reset" value="">
    </div>
        <hr>
    </form>

    <label for="filtroAgendamentos">Busca:</label>
    <input id="filtroAgendamentos" type="text">
    <table id="tabelaAgendamentos" class="table table-striped table-font-size">
        <thread>   
            <tr class="table-secondary">

                <th>Avaliado</th>
                <th>Avaliador</th>
                <th>Compromisso</th>       
                <th>Cliente</th>   
                           
            </tr>
    
        </thread>
        <tbody>                 
            <?php               

                // TABELA COM A LISTA DAS AVALIADOS E OP PRA ALTERAR OU EXCLUIR
               try {
                
                    $stmt = $conexao->prepare(
                    "SELECT * FROM agendamentos ag  
                    INNER JOIN avaliados ao ON ag.idAvaliadoFK=ao.idAvaliado 
                    INNER JOIN clientes cl ON ag.idClienteFK=cl.idCliente 
                    INNER JOIN avaliadores ar ON ag.idAvaliadorFK=ar.idAvaliador  
                    INNER JOIN compromissos cs ON ag.idCompromissoFK=cs.idCompromisso 
                                      
                    
                    ORDER BY ar.avaliador ASC" );
                    if ($stmt->execute()) {
                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                            $rs->idAvaliadoFK;
                            $rs->idAvaliadorFK;
                            $rs->idCompromissoFK;
                            $rs->idClienteFK;
                            echo "<tr>";
                            echo "<td>".$rs->avaliado."</td><td>".
                                        $rs->avaliador."</td><td>".
                                        $rs->compromisso."</td><td>".
                                        $rs->cliente."</td><td><center><a href=\"?act=upd&idAgendamento=".$rs->idAgendamento."\">[Alterar]</a>"
                                    ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                                    ."<a href=\"?act=del&idAgendamento=".$rs->idAgendamento."\">[Excluir]</a></center></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                    }
                } catch (PDOException $erro) {
                    echo "Erro: ".$erro->getMessage();
                }
        
            ?>
        </tbody>
    </table>
    </main>
  </body>
</html>


<script>
    $(document).ready(function() {
        $("#filtroAgendamentos").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tabelaAgendamentos tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>