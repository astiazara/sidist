<?php
class Entidade
{
    private $id = 0;
    private $nome = "";
    
    public static function array_filter($array_entidades, $nome)
    {
        $resultado = array();
        foreach($array_entidades as $entidade)
        {
            if(0 == strnatcasecmp($entidade->getNome(), $nome))
                $resultado[count($resultado)] = $entidade;
        }
        return $resultado;
    }
    
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
