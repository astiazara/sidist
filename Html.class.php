<?php
class Html
{
    public static function imprimirOption($array_entidades)
    {
        foreach($array_entidades as $entidade)
        {
            echo "<option value=\"".$entidade->getId()."\">".$entidade->getNome()."</option> ";
        }
    }
}
?>
