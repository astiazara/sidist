<?php
class Entidade
{
    private $id = 0;
    private $nome = "";
    
    public static function compararPorNome($a, $b)
    {
        return strnatcasecmp($a->getNome(), $b->getNome());
    }
    
    public function getId()
    {
        return $this->id;
    }
    public function setId($value)
    {
        $this->id = $value;
    }
    
    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($value)
    {
        $this->nome = $value;
    }
}
?>
