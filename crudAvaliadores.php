<?php
// Conectando ao banco de dados:
session_start();
include 'controllers/controllerAvaliadores.php';
include 'verificaLogin.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/1ab94d0eba.js"
      crossorigin="anonymous"
    ></script>
    <title>Avaliador</title>
    <link rel="stylesheet" href="assets\styles\style_form.css" />
  </head>


  <div class="header">
    
    <a href="#default" ><img src="./assets/img/img_logo.jfif" alt="logo" /></a>
    <div class="header-right">
      <a class="active" href="#home">Inicio</a>
      <a href="#contact">Contato</a>
      <a href="#about">Sobre</a>
      <a href="#help">Ajuda</a>
    </div>
  </div>

  <body>
    <main class="container">
         <h2>Avaliadores</h2>
                
      <form action="?act=save" method="POST" name="form1"  >
          
          <input type="hidden" name="idAvaliador"  <?php                                  
          // Preenche o idAvaliador no campo idAvaliador com um valor "value"
          if (isset($idAvaliador) && $idAvaliador != null || $idAvaliador != "") {
              echo "value=\"{$idAvaliador}\"";
          }
          ?> />


          <b>Avaliador:</b>
          <input type="text" name="avaliador" class="form-control" <?php

          // Preenche o avaliador no campo avaliador com um valor "value"
          if (isset($avaliador) && $avaliador != null || $avaliador != "") {
              echo "value=\"{$avaliador}\"";
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

      <label for="filtroAvaliadores">Busca:</label>
      <input id="filtroAvaliadores" type="text">
      <table id="tabelaAvaliadores" class="table table-striped table-font-size">
          <thread>   
              <tr class="table-secondary">
  
                  <th>Avaliador</th>
                  <th>Cargo</th>                                                  
              
                  
              
              </tr>
      
          </thread>
          <tbody>                 
              <?php               

                  // TABELA COM A LISTA DAS AVALIADOres E OP PRA ALTERAR OU EXCLUIR
                 try {
                  
                      $stmt = $conexao->prepare("SELECT ar.avaliador, ar.idAvaliador, ar.idCargoFK, ar.crc, ar.certificacao, c.idCargo, c.cargo  FROM avaliadores ar  
                      INNER JOIN cargos c ON ar.idCargoFK=c.idCargo ORDER BY ar.avaliador ASC" );
                      if ($stmt->execute()) {
                          while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                              $rs->idCargoFK;
                              echo "<tr>";
                              echo "<td>".$rs->avaliador."</td><td>".
                                          $rs->cargo."</td><</td><td><center><a href=\"?act=upd&idAvaliador=".$rs->idAvaliador."\">[Alterar]</a>"
                                      ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                                      ."<a href=\"?act=del&idAvaliador=".$rs->idAvaliador."\">[Excluir]</a></center></td>";
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
