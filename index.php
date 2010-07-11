<?php
require_once "IpRealVisitante.class.php";
require_once "Html.class.php";
require_once "Paises.class.php";
require_once "Estados.class.php";
require_once "Cidades.class.php";
include_once "libs/geolocation/geolocation.class.php";
require_once "libs/snoopy/Snoopy.class.php";
 
//Set geolocation cookie
if(!$_COOKIE["geolocation"]){
  $geolocation = new geolocation(true);
  $geolocation->setTimeout(2);
  $geolocation->setIP(IpRealVisitante::obter());
  list($visitorGeolocation) = $geolocation->getGeoLocation();
  if ($visitorGeolocation['Status'] == 'OK') {
    $data = base64_encode(serialize($visitorGeolocation));
    setcookie("geolocation", $data, time()+3600*24); //set cookie for 1 day
  }
}else{
  $visitorGeolocation = unserialize(base64_decode($_COOKIE["geolocation"]));
}
/* Depuração 
$visitorGeolocation["CountryName"] = "Brazil";
$visitorGeolocation["RegionName"] = "Rio grande do sul";
$visitorGeolocation["City"] = "porto alegre";
*/
//var_dump($visitorGeolocation);

// Procurando o país pelo IP.
$paises = Paises::buscarTodos();
$paisSelecionado = new Pais();
$estadoSelecionado = new Estado();
$cidadeSelecionada = new Cidade();
if($visitorGeolocation["Status"] == "OK")
{
    $resultadoBusca = Pais::array_filter($paises, $visitorGeolocation["CountryName"]);
    if(count($resultadoBusca) != 0)
    {
        $paisSelecionado = $resultadoBusca[0];
        // Procurando o Estado.
        $estados = Estados::buscar($paisSelecionado->getId());
        $resultadoBusca = Estado::array_filter($estados, $visitorGeolocation["RegionName"]);
        if(count($resultadoBusca) != 0)
        {
            $estadoSelecionado = $resultadoBusca[0];
            // Procurando a cidade.
            $cidades = Cidades::buscar($estadoSelecionado->getId());
            $resultadoBusca = Cidade::array_filter($cidades, $visitorGeolocation["City"]);
            if(count($resultadoBusca) != 0)
            {
                $cidadeSelecionada = $resultadoBusca[0];
            }
        }
    }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en-us">

<head>
	<title>Health Web Pages Recomendation (Prototype)</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="estilo.css" />
	<script type="text/javascript" src="libs/prototype/prototype.js"></script>
	<script type="text/javascript" src="localizacao.js"></script>
</head>

<body>
	<h2>Health Web Pages Recommendation</h2>
	<p>Protótipo desenvolvido para a disciplina de Sistemas de Informação Distribuídos.</p>
	<div id="div_perfil">
		<h3>Your Profile</h3>
        Scholarity Level:
        <select id="select_escolaridade">
            <option value="1">Primary Education (1st-8th grade) - incomplete</option>
            <option value="2">Primary Education (1st-8th grade) - complete</option>
            <option value="3">Higher Education - incomplete</option>
            <option value="4">Higher Education - complete</option>
            <option value="5">College/University - incomplete</option>
            <option value="6">College/University - complete</option>
            <option value="7">M.Sc./pH.D. - incomplete</option>
            <option value="8">M.Sc./pH.D. - complete</option>
        </select>
        <br />
        Age Group (years):
        <select id="select_faixa_etaria">
            <option value="1">0 to 22</option>
            <option value="2">23 to 50</option>
            <option value="3">50 or older</option>
        </select>
        <br />
        Interest:
        <select id="select_objetivo">
            <option value="1">Disease overview</option>
            <option value="2">Treatments and symptoms</option>
            <option value="3">Patient Care</option>
            <option value="4">Diagnosis and prevention</option>
            <option value="5">Alternative treatments</option>
        </select>
        <br />
        Country:
        <select id="select_pais" onchange="atualizarEstados()">
            <option value="0">(no selected)</option>
            <?php 
                Html::imprimirOption($paises, $paisSelecionado->getId());
            ?>
        </select>
        <br />
        <div id="div_estado" class="div_ajax">
            State/Province:
            <select id="select_estado" onchange="atualizarCidades()">
                <option value="0">(no selected)</option>
                <?php 
                    Html::imprimirOption($estados, $estadoSelecionado->getId());
                ?>
            </select>
            <img id="img_ajax_estado" alt="Aguarde" src="ajax-loader.gif" class="ajax-loader"/>
        </div>
        <div id="div_cidade" class="div_ajax">
            City:
            <select id="select_cidade">
                <option value="0">(no selected)</option>
                <?php 
                    Html::imprimirOption($cidades, $cidadeSelecionada->getId());
                ?>
            </select>
            <img id="img_ajax_cidade" alt="Aguarde" src="ajax-loader.gif" class="ajax-loader"/>
        </div>
	</div>
	
	<div id="div_pesquisa">
		<h3>Your Search Terms</h3>
        <input type="text" id="text_termos" size="40" />
        <button type="button">Search!</button>
	</div>
	
	<div id="div_resultados">
		<h3>Results</h3>
	</div>
	
</body>
</html>
