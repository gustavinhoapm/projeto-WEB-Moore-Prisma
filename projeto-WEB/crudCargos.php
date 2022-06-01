<?php
// Conectando ao banco de dados:
include 'controllers/controllerCargos.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cargos</title>

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

        <form action="?act=save" method="POST" name="form1">



            <input type="hidden" name="idCargo" <?php

                                                // Preenche o idCargo no campo idCargo com um valor "value"
                                                if (isset($idCargo) && $idCargo != null || $idCargo != "") {
                                                    echo "value=\"{$idCargo}\"";
                                                }
                                                ?> />
            Cargo:
            <input type="text" name="cargo" class="form-control" <?php

                                                                    // Preenche o cargo no campo cargo com um valor "value"
                                                                    if (isset($cargo) && $cargo != null || $cargo != "") {
                                                                        echo "value=\"{$cargo}\"";
                                                                    }
                                                                    ?> />

            <input type="submit" value="salvar" class="btn btn-info format-div-top btn-outline-secondary">

            <hr>
        </form>

        <label for="filtroCargos">Busca:</label>
        <input id="filtroCargos" type="text">
        <table id="tabelaCargos" class="table table-striped table-font-size">
            <tr>

                <th>Cargo</th>
            </tr>
            <?php

            // Bloco que realiza o papel do Read - recupera os dados e apresenta na tela
            try {
                $stmt = $conexao->prepare("SELECT * FROM cargos ORDER BY cargo ASC");
                if ($stmt->execute()) {
                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                        echo "<tr>";
                        echo "<td>" . $rs->cargo . "</td><td><center><a href=\"?act=upd&idCargo=" . $rs->idCargo . "\">[Alterar]</a>"
                            . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                            . "<a href=\"?act=del&idCargo=" . $rs->idCargo . "\">[Excluir]</a></center></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "Erro: Não foi possível recuperar os dados do banco de dados";
                }
            } catch (PDOException $erro) {
                echo "Erro: " . $erro->getMessage();
            }
            ?>
        </table>
    </main>


</body>

</html>

<script>
    $(document).ready(function() {
        $("#filtroCargos").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tabelaCargos tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>