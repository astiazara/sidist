City:
<select id="select_cidade">
    <option value="0">(no selected)</option>
    
    <?php
    require_once "Html.class.php";
    require_once "Cidades.class.php";
    
    if(!filter_var($_GET["idestado"], FILTER_VALIDATE_INT))
        return;
    $idEstado = (int)$_GET["idestado"];
    if($idEstado < 1)
        return;
    Html::imprimirOption(Cidades::buscar($idEstado));
    ?>

</select>
<img id="img_ajax_cidade" src="ajax-loader.gif" class="ajax-loader"/>
