
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<div class="container">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<div class="container">
<form action="listaProfissionalArea.php" method="POST">
<td class='DETALHAR'><input type="submit" class="button" name="teste" value="LISTAR PROFISSIONAIS POR AREA NO XML ATUAL"/></td>
</form>
<form action="listaUBS.php" method="POST">
<td class='DETALHAR'><input type="submit" class="button" name="teste" value="LISTAR TODAS AS UNIDADES DE SAÚDE NO XML ATUAL (incluindo as não ESF)"/></td>
</form>
</div>

<table class="table">
<thead>
<tr>
<th class='CNESt'>CNES&nbsp&nbsp&nbsp&nbsp</th>
<th class='POSTO'>NOME DO POSTO</th>
<th class='INE'>INE</th>
<th class='AREA'>ÁREA</th>
<th class='NAREA'>NOME DA ÁREA</th>
</tr>
</thead>
</table>


<style>
    table{ text-align: left;}
    .CNES{ width: 1px;}
    .UBS{ width: 2000px;}
    .INE{ width: 500px;}
    .AREA{ width: 100px;}
    .DS_AREA{ width: 600px;}

    .CNESt{ width: 1px;}
    .POSTO{ width: 2000px;}
    .INE{ width: 500px;}
    .INE{ width: 100px;}
    .NAREA{ width: 600px;}


</style>

<?php
    $xml = simplexml_load_file("cnes.XML");
    $DadosUBS = ""; 
    foreach ($xml->ESTABELECIMENTOS->DADOS_GERAIS_ESTABELECIMENTOS as $DadosCNES) {
        foreach ($DadosCNES->EQUIPES->DADOS_EQUIPES as $equipe) { 
            ?>
            <table class="table">
                    <tr>
                        <td class='CNES'><b><?= $DadosCNES['CNES'] ?></b></td>
                        <td class='UBS'><b><?= $DadosCNES['NOME_FANTA'] ?></b></td>
                        <td class='INE'><b><?= $equipe['CO_EQUIPE'] ?></b></td>
                        <td class='AREA'><b><?= $equipe['COD_AREA'] ?></b></td>
                        <td class='DS_AREA'><b><?= $equipe['DS_AREA'] ?></b></td>
                    </tr>
            </table>
            <?php
        }
    }
       
    
?>
</div>