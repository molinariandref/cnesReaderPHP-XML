<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<div class="container">
<form action="listaProfissionalArea.php" method="POST">
<td class='DETALHAR'><input type="submit" class="button" name="teste" value="LISTAR PROFISSIONAIS POR AREA NO XML ATUAL"/></td>
</form>
<form action="listaAREA.php" method="POST">
<td class='DETALHAR'><input type="submit" class="button" name="teste" value="LISTAR APENAS UNIDADES E AREAS NO XML ATUAL"/></td>
</form>
<form action="listaUBS.php" method="POST">
<td class='DETALHAR'><input type="submit" class="button" name="teste" value="LISTAR TODAS AS UNIDADES DE SAÚDE NO XML ATUAL (incluindo as não ESF)"/></td>
</form>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<div class="container">
<div class="container">

<?php

    $detalhar=$_POST['detalhar'];
    //echo $detalhar;
    $xml = simplexml_load_file("cnes.XML");
    $DadosUBS = ""; 
    foreach ($xml->ESTABELECIMENTOS->DADOS_GERAIS_ESTABELECIMENTOS as $DadosCNES) {
        foreach ($DadosCNES->EQUIPES->DADOS_EQUIPES as $equipe) { 
                foreach($equipe->PROF_EQUIPE->DADOS_PROF_EQUIPE as $profissional) {
                $microarea = $profissional['MICROAREA'];
                $cbo = $profissional['COD_CBO'];
                foreach ($DadosCNES->PROFISSIONAIS->DADOS_PROFISSIONAIS as $profissional2) {
                    $comparadorProfissionalEquipe = $profissional['PROF_ID'];
                    $comparadorProfissionalGeral = $profissional2['PROF_ID'];
                    $comparador = strcmp($comparadorProfissionalGeral, $comparadorProfissionalEquipe);
                    if ($comparador == 0){
                        switch ($cbo) {
                            case "322245":
                                $cbo = "322245 - TEC. ESF";
                            break;

                            case "223565":
                                $cbo = "223565 - ENF. ESF";
                            break;

                            case "225142":
                                $cbo = "225142 - MED. ESF";
                            break;

                            case "515105":
                                $cbo = "515105 - ACS ESF";
                            break;

                            case "223810":
                                $cbo = "223810 - FONO GERAL";
                            break;

                            case "223605":
                                $cbo = "223605 - FISIO GERAL";
                            break;

                            case "223710":
                                $cbo = "223710 - NUTRICIONISTA";
                            break;

                            case "225125":
                                $cbo = "225125 - MED. CLINICO";
                            break;

                            case "251510":
                                $cbo = "251510 - PSICÓLOGO CLINICO";
                            break;

                            case "322250":
                                $cbo = "322250 - AUX. ESF";
                            break;

                            case "322430":
                                $cbo = "322430 - AUX. BUCAL";
                            break;

                            case "223208":
                                $cbo = "223208 - CIR. DENTISTA";
                            break;

                            case "251605":
                                $cbo = "251605 - ASSISTENTE SOCIAL";
                            break;

                            case "225133":
                                $cbo = "225133 - MEDICO PSIQUIATRA";
                            break;

                            case "131210":
                                $cbo = "131210 - GERENTE DE SAUDE";
                            break;
                        }
                        $comparador2 = strcmp($comparadorProfissionalGeral, $detalhar);
                        if ($comparador2 == 0) {
                            echo "<b>".$DadosCNES['NOME_FANTA']."</b>";
                            echo "<br><b>CBO: </b> ".$cbo ." <b>ÁREA: </b>". $equipe['COD_AREA'] ."<b> MICRO: </b> $microarea ";
                            echo "<br><b>NOME COMPLETO: </b>".$profissional2['NOME_PROF'];
                            echo "<br><b>CARTÃO SUS (C.N.S): </b>".$profissional2['COD_CNS'];
                            echo "<br><b>C.P.F: </b>".$profissional2['CPF_PROF'];
                            echo "<br><b>NOME DA MÃE: </b>".$profissional2['NOME_MAE'];
                            echo "<br><b>NOME DO PAI: </b>".$profissional2['NOME_PAI'];
                            echo "<br><b>DATA DE NASCIMENTO: </b>" .$profissional2['DATA_NASC'];
                            echo "<br><b>ENDEREÇO:</b> RUA ". $profissional2['LOGRADOURO'] . ", NUMERO " . $profissional2['NUMERO'] . ", BAIRRO " . $profissional2['BAIRRODIST'];
                        }

                    }
                }
            }
        }
    }
        
?>






