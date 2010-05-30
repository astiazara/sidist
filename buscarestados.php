State/Province:
<select id="select_estado" onchange="atualizarCidades()">
    <option value="0">(no selected)</option>
    
    <?php
    require_once "Html.class.php";
    require_once "Estados.class.php";
    
    if(!filter_var($_GET["idpais"], FILTER_VALIDATE_INT))
        return;
    $idPais = (int)$_GET["idpais"];
    if($idPais < 1)
        return;
    Html::imprimirOption(Estados::buscar($idPais), 0);
    ?>

</select>
<img id="img_ajax_estado" src="ajax-loader.gif" class="ajax-loader"/>
