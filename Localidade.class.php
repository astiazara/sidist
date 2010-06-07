<?php
require_once "Entidade.class.php";

class Localidade extends Entidade
{
    public function podarNome()
    {
        $nome = $this->getNome();
        $nome = eregi_replace(
            '^(estado da |estado de |estado do |estado del |departamento de |departamento del |state of |province of |província de |província da |província do |provincia de |provincia da |provincia do |provincia del )|( department| province)$', 
            '', 
            $nome);
        $nome = eregi_replace(
            '^(município |município de |cidade de )|( county| condado)$', 
            '', 
            $nome);
        $this->setNome($nome);
    }
}
?>
