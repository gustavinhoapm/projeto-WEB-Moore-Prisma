<?php
// Conectando ao banco de dados:
session_start();
include 'controllers/controllerAgendamentos.php';
include 'verificaLogin.php';
?>

<!DOCTYPE html>
<html lang="pt_BR">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
  <!-- CSS only -->
  <link rel="stylesheet" href="assets\styles\style_agenda.css"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

  <!-- JavaScript Bundle with Popper -->


  <!-- CSS -->
  <!-- <link rel="stylesheet" type="text/css" href="assets/styles/style_avaliacao.css" media="screen"> -->

  <!-- Titulo -->
  <title>Agendamento</title>
</head>

<!-- corpo do projeto -->

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="https://www.moorebrasil.com.br/escritorios/ribeirao-preto---sp" target="_blank">
            <img src="assets/img/img_logo.jfif" class="img" width="35"  height="35" alt="" right="200px"> Moore Prisma
        </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="home_page_users.html" target="_blank">Página Inicial</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="contato.html" target="_blank">Contato/Ajuda</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="https://www.moorebrasil.com.br/escritorios/ribeirao-preto---sp" target="_blank">Sobre nós</a>
              </li>
            </ul>
            
          </div>
        </div>
      </nav>


    <section class="Form my-4 mx-5">
        <div class="container">
            <div class="row no-gutters">
                
                <div class="col-lg-5">
                    <img src="https://png.pngtree.com/element_our/png_detail/20181123/technology-blue-light-background-png_246525.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-5 px-4 py-3">
                    
                    <h1 class="font-weight-bold"><span style="color: #1ba4ff">Moore </span> Prisma</h1>
                    <h3>Agendamentos:</h3>

                    <form action="?act=save" method="POST" name="form1">
                                                    
                            <div class="col-lg-7">  

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

                            <select name="idAvaliadorFK" class="form-select my-3 p-2">
                              <option selected disabled value="">Avaliador:</option>
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
                        </div>

                        <div class="col-lg-7">
                          <?PHP
                        $conexao->exec('SET CHARACTER SET utf8');

                        $pegaAvaliado = $conexao->prepare("SELECT DISTINCT * FROM avaliados ORDER BY avaliado");
                        $pegaAvaliado->execute();

                            $fetchAll = $pegaAvaliado->fetchAll();
                    ?>
                            <select name="idAvaliadoFK" class="form-select my-3 p-2">
                                
                                <option selected disabled value="">Avaliado:</option>
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
                        </div>

                        <div class="col-lg-7">
                          <?PHP
                          $conexao->exec('SET CHARACTER SET utf8');
  
                          $pegaCliente = $conexao->prepare("SELECT DISTINCT * FROM clientes ORDER BY cliente");
                          $pegaCliente->execute();
  
                              $fetchAll = $pegaCliente->fetchAll();
                      ?>
                          <select name="idClienteFK" class="form-select my-3 p-2">
                                
                                <option selected disabled value="">Cliente:</option>
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
                        </div>

                        <div class="col-lg-7">
                          <?PHP
                        $conexao->exec('SET CHARACTER SET utf8');

                        $pegaCompromisso = $conexao->prepare("SELECT DISTINCT * FROM compromissos ORDER BY compromisso");
                        $pegaCompromisso->execute();

                            $fetchAll = $pegaCompromisso->fetchAll();
                    ?>
                    <select name="idCompromissoFK" class="form-select my-3 p-2">
                                
                                <option selected disabled value="">compromisso:</option>
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
                        </div>

                        <div class="col-lg-7">
                            
                        <label for="date">Semana:</label>
                        <input type="date" id="date" name="date" <?php
        
                        // Preenche o semana no campo semana com um valor "value"
                        if (isset($semana) && $semana != null || $semana != "") {
                            echo "value=\"{$semana}\"";
                        }
                        ?> />
                        </div>

                   <br>
                        
                            <div class="col-lg-5">
                           
                            <div class="btn-group" role="group" aria-label="Basic example">
  <button type="submit" class="btn btn-primary">Enviar</button>
  <button type="reset" class="btn btn-primary">Limpar</button>
 
</div>
<br>
				   <div class="input-group">
    <input type="text" id="filtroAgendamentos" class="form-control" placeholder="Buscar">
    <div class="input-group-btn">
      <button class="btn btn-default" type="submit">
        <i class="glyphicon glyphicon-search"></i>
      </button>
    </div>
  </div>
				</div>
                            </div> 
                            
              
                   
                    </div>
                        </div>
                        
                    
        
                    </form>
                    
                </div>

                
            </div>
            
        </div>
    </section>

<section class="Form my-4 mx-5">
        <div class="container">
        	
        <table id="tabelaAgendamentos" class="table table-dark">
        <thread>   
            <tr class="table-secondary">

                <th>Avaliado</th>
                <th>Avaliador</th>
                <th>Compromisso</th>       
                <th>Cliente</th> 
                <th>Semana</th> 
                <th>Mudanças</th> 
                           
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
                            $rs->semana;
                            echo "<tr>";
                            echo "<td>".$rs->avaliado."</td><td>".
                                        $rs->avaliador."</td><td>".
                                        $rs->compromisso."</td><td>".
                                        $rs->cliente."</td><td>".
                                        $rs->semana."</td><td><center><a href=\"?act=upd&idAgendamento=".$rs->idAgendamento."\">[Alterar]</a>"
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
 
  </div>
   </section>
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