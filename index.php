<?php
require_once("Html.class.php");
require_once("Paises.class.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us" lang="en-us">

<head>
	<title>Health Web Pages Recomendation (Prototype)</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="estilo.css" />
</head>

<body>
	<h2>Health Web Pages Recomendation</h2>
	<p>Protótipo desenvolvido para a disciplina de Sistemas de Informação Distribuídos.</p>
	<div id="div_perfil">
		<h3>Your Profile</h3>
		<p>
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
                <option value="2">Treatments & symptoms</option>
                <option value="3">Patient Care</option>
                <option value="4">Diagnosis & prevention</option>
                <option value="5">Alternative treatments</option>
            </select>
            <br />
            Location:
            <select id="select_localizacao">
                <?php
                    Html::imprimirOption(Paises::buscarTodos());
                ?>
            </select>
        </p>
	</div>
	
	<div id="div_pesquisa">
		<h3>Your Search Terms</h3>
		<p>
		    <input type="text" id="text_termos" size="40" />
		    <button type="button">Search!</button>
		</p>
	</div>
	
	<div id="div_resultados">
		<h3>Results</h3>
	</div>
</body>
</html>
