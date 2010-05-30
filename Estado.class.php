<?php
require_once "Entidade.class.php";

class Estado extends Entidade
{
    public function podarNome()
    {
        $this->setNome(eregi_replace(
            '^(estado da |estado de |estado do |estado del |departamento de |departamento del |state of |province of |província de |província da |província do |provincia de |provincia da |provincia do |provincia del )|( department| province)$', 
            '', 
            $this->getNome() ));
    }
}
?>
