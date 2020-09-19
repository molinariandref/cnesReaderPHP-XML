
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<div class="container">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<div class="container">

<form action="listaAREA.php" method="POST">
<td class='DETALHAR'><input type="submit" class="button" name="teste" value="LISTAR APENAS UNIDADES E AREAS NO XML ATUAL"/></td>
</form>
<form action="listaUBS.php" method="POST">
<td class='DETALHAR'><input type="submit" class="button" name="teste" value="LISTAR TODAS AS UNIDADES DE SAÚDE NO XML ATUAL (incluindo as não ESF)"/></td>
</form>
</div>
<table class="table">
<thead>
<tr>
<th class='CBO'>CBO        </th>
<th class='CNS'>CNS                       </th>
<th class='CPF'>CPF               </th>
<th class='NOME'>NOME DO PROFISSIONAL</th>
<th class='MICROAREA'>MICROAREA</th>
</tr>
</thead>
</table>
<style>
    table{ text-align: left;}
    .CNES{ width: 50px;}
    .UBS{ width: 300px;}
    .INE{ width: 1px;}
    .AREA{ width: 1px;}
    .DS_AREA{ width: 1px;}

    .CBO{ width: 500px;}
    .CNS{ width: 50px;}
    .CPF{ width: 50px;}
    .NOME{ width: 2500px;}   
    .MICROAREA{ width: 10px;}  
</style>

<?php
    $xml = simplexml_load_file("cnes.XML");
    $DadosUBS = ""; 
    foreach ($xml->ESTABELECIMENTOS->DADOS_GERAIS_ESTABELECIMENTOS as $DadosCNES) {
        foreach ($DadosCNES->EQUIPES->DADOS_EQUIPES as $equipe) { 
            ?>
            <table class="table">
                    <tr>
                        <td width="20" class='CNES'><b><?= $DadosCNES['CNES'] ?></b></td>
                        <td width="20" class='UBS'><b><?= $DadosCNES['NOME_FANTA'] ?></b></td>
                        <td width="20" class='INE'><b><?= $equipe['CO_EQUIPE'] ?></b></td>
                        <td width="20" class='AREA'><b><?= $equipe['COD_AREA'] ?></b></td>
                        <td width="20" class='DS_AREA'><b><?= $equipe['DS_AREA'] ?></b></td>
                    </tr>
            </table>
            <?php
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
                                $cbo = "223810 - FONO";
                            break;

                            case "223605":
                                $cbo = "223605 - FISIO";
                            break;

                            case "223710":
                                $cbo = "223710 - NUTRI";
                            break;

                            case "225125":
                                $cbo = "225125 - MED. CLI";
                            break;

                            case "251510":
                                $cbo = "251510 - PSICOL.";
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

                            default:
                                $cbo = $cbo . " - NÃO LISTADO";
                        }
                        ?>
                        <form action="detalheCNES.php" method="POST">
                        <table class="table">
                            <tr>
                                <td width="20" class='CBO'><?= $cbo?></b></td>
                                <td width="20" class='CNS'><?= $profissional2['COD_CNS'] ?></td>
                                <td width="20" class='CPF'><?= $profissional2['CPF_PROF'] ?></td>
                                <td width="20" class='NOME'><?= $profissional2['NOME_PROF'] ?></td>

                        <?php
                        if ($microarea != "") { ?>
                            <td width="20" class='MICROAREA'><?= $microarea ?></td>
                            <?php
                        } else { ?>
                            <td width="20" class='MICROAREA'>-</td>
                            <?php
                        }
                        
                        ?>
                        <td width="20" ><input type="radio" name="detalhar" value=<?=$profissional2['PROF_ID']?>></td>
                        <td width="20" class='DETALHAR'><input type="submit" class="button" name="teste" value="→"/></td>
                        </tr>
                        </table>
                        <?php

                    }
                }
            }
        }
    }
?>
</div>