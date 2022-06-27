<!DOCTYPE html>
<html lang="pt_BR">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
  <!-- CSS only -->
  <link rel="stylesheet" href="assets/styles/style_avaliadores.css"/>
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
  <title>Avaliadores</title>
</head>

<!-- corpo do projeto -->

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="https://www.moorebrasil.com.br/escritorios/ribeirao-preto---sp" target="_blank">
            <img src="assets/img/img_logo.jfif" class="img" width="35"  height="35" alt="" right="700px"> Moore Prisma
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
                <div class="col-lg-6 px-5 py-3">
                    <h1 class="font-weight-bold"><span style="color: #1ba4ff">Moore </span> Prisma</h1>
                    <h3>Avaliadores:</h3>
                    <form>
                                                    
                        <div class="col-lg-7 my-3">
                            <label for="exampleFormControlInput1" class="form-label">Avaliador:</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="digite aqui">
                          </div>

                        <div class="col-lg-7">
                            <select class="form-select my-3 p-2">
                                
                                <option selected disabled value="">Cargo:</option>
                                <option value="1">Auditoria</option>
                                <option value="2">Gerencia</option>
                                <option value="3">Outsourcing</option>
                            </select>                             
                        </div>

                        <div class="col-lg-7 my-3">
                            <label for="exampleFormControlInput1" class="form-label">CRC:</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="digite aqui">
                          </div>

                        <div class="col-lg-7">
                            <select class="form-select my-3 p-2">
                                
                                <option selected disabled value="">compromisso:</option>
                                <option value="1">Auditoria das DFs (Controle interno)</option>
                                <option value="2">Auditoria das DFs / Revisão limitada (preliminar)</option>
                                <option value="3">Revisão contábil (final)</option>
                            </select>                             
                        </div>

                   
                        <div class="form-row">
                            <div class="col-lg-7">
                                <button type="button" class="btn1 mt-3">Salvar</button>
                            </div> 
                        </div>

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
                  
                        
                        </div>

        
                    </form>
                </div>
            </div>
        </div>
    </section>

</body>

</html>