<?php
class Html
{
    public static function imprimirOption($array_entidades, $idSelecionado)
    {
        foreach($array_entidades as $entidade)
        {
            echo "<option value=\"" . $entidade->getId()."\""
            . ($entidade->getId() == $idSelecionado ? " selected=\"selected\"" : "") . ">"
            . $entidade->getNome() . "</option> ";
        }
    }
}
?>
