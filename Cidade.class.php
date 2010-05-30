<?php
require_once "Entidade.class.php";

class Cidade extends Entidade
{
    public function podarNome()
    {
        $this->setNome(eregi_replace(
            '^(município |município de |cidade de )|( county| condado)$', 
            '', 
            $this->getNome() ));
    }
}
?>
