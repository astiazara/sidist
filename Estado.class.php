<?php
require_once "Entidade.class.php";

class Estado extends Entidade
{
    public function podarNome()
    {
        $this->setNome(eregi_replace(
            '^(estado da |estado de |estado do |departamento de |state of |province of )|( department| province)$', 
            '', 
            $this->getNome() ));
    }
}
?>
