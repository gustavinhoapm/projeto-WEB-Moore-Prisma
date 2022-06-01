<?php
// Conectando ao banco de dados:
include 'controllers/controllerAvaliados.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/1ab94d0eba.js" crossorigin="anonymous"></script> 
    <title>Avaliados</title>

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
                
                <form action="?act=save" method="POST" name="form1"  >
                    
                    <input type="hidden" name="idAvaliado"  <?php                                  
                    // Preenche o idAvaliado no campo idAvaliado com um valor "value"
                    if (isset($idAvaliado) && $idAvaliado != null || $idAvaliado != "") {
                        echo "value=\"{$idAvaliado}\"";
                    }
                    ?> />


                    <b>Avaliado:</b>
                    <input type="text" name="avaliado" class="form-control" <?php
        
                    // Preenche o avaliado no campo avaliado com um valor "value"
                    if (isset($avaliado) && $avaliado != null || $avaliado != "") {
                        echo "value=\"{$avaliado}\"";
                    }
                    ?> />


                    <!-- ----------------------------------------------------->

                    <br>


                    <?PHP
                        $conexao->exec('SET CHARACTER SET utf8');

                        $pegaCargo = $conexao->prepare("SELECT DISTINCT * FROM cargos ORDER BY cargo");
                        $pegaCargo->execute();

                            $fetchAll = $pegaCargo->fetchAll();
                    ?>
                        <b>Cargo:</b> 
                        <select name="idCargoFK" class="form-control">
                            <?php
                                $temp=1; 
                                foreach ($fetchAll as $cargos) : ?>
                                <?php if($temp == 1){           
                                    echo '<option>  </option>';
                                    $temp =0;
                                    } ?>
                                <option value="<?php echo $cargos['idCargo']; ?>"
                                    <?php if ($cargos['idCargo'] == $idCargoFK) : ?>
                                        selected
                                    <?php endif; ?>
                                ><?php echo $cargos['cargo']; ?></option>
                            <?php endforeach; ?>
                        </select> 
                    <br>
                    <b>CRC:</b>

                    <input type="text" name="crc" class="form-control" <?php
        
                    // Preenche o crc no campo crc com um valor "value"
                    if (isset($crc) && $crc != null || $crc != "") {
                        echo "value=\"{$crc}\"";
                    }
                    ?> />
                    <br>

                    <b>Certificação:</b>
                    <input type="text" name="certificacao" class="form-control" <?php
        
                    // Preenche o certificacao no campo certificacao com um valor "value"
                    if (isset($certificacao) && $certificacao != null || $certificacao != "") {
                        echo "value=\"{$certificacao}\"";
                    }
                    ?> />


                                    


                        <br>
                <div>
                    <input type="submit" value="salvar">
                                                                                           
                    <input type="reset" value="">
                </div>
                    <hr>
                </form>

                <label for="filtroAvaliados">Busca:</label>
                <input id="filtroAvaliados" type="text">
                <table id="tabelaAvaliados" class="table table-striped table-font-size">
                    <thread>   
                        <tr class="table-secondary">
            
                            <th>Avaliado</th>
                            <th>Cargo</th>                                                  
                        
                            
                        
                        </tr>
                
                    </thread>
                    <tbody>                 
                        <?php               

                            // TABELA COM A LISTA DAS AVALIADOS E OP PRA ALTERAR OU EXCLUIR
                           try {
                            
                                $stmt = $conexao->prepare("SELECT ao.avaliado, ao.idAvaliado, ao.idCargoFK, ao.crc, ao.certificacao, c.idCargo, c.cargo  FROM avaliados ao  
                                INNER JOIN cargos c ON ao.idCargoFK=c.idCargo ORDER BY ao.avaliado ASC" );
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        $rs->idCargoFK;
                                        echo "<tr>";
                                        echo "<td>".$rs->avaliado."</td><td>".
                                                    $rs->cargo."</td><</td><td><center><a href=\"?act=upd&idAvaliado=".$rs->idAvaliado."\">[Alterar]</a>"
                                                ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                                                ."<a href=\"?act=del&idAvaliado=".$rs->idAvaliado."\">[Excluir]</a></center></td>";
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
$(document).ready(function(){
  $("#filtroAvaliados").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tabelaAvaliados tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<script>
    $(document).ready( function () {
        $('#tabelaAvaliados').DataTable();
    } );
</script>
