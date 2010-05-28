<?php
require_once("Pais.class.php");

class Paises
{
    public static function buscarTodos()
    {
        $resultado = Paises::buscarTodosLocal();
        if($resultado == null)
        {
            $resultado = Paises::buscarTodosRemoto();
        }                
        return $resultado;
    }
    
    public static function buscarTodosLocal()
    {
        $arquivo = "paises.xml";
        if(!file_exists($arquivo))
            return null;

        $resultado = array();
        $xml = simplexml_load_file($arquivo);
        foreach($xml->country as $country)
        {
            $pais = new Pais();
            $pais->setId($country->geonameId);
            $pais->setNome($country->countryName);
            $resultado[sizeof($resultado)] = $pais;
        }
        return $resultado;
    }
    
    public static function buscarTodosRemoto()
    {
        $resultado = array();
        for($i = 1; $i < 6; $i++)
        {
            $pais = new Pais($i, "País ");
            $pais->setId($i);
            $pais->setNome("País " . $i);
            $resultado[sizeof($resultado)] = $pais;
        }
        return $resultado;
    }
}
?>
