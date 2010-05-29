<?php
require_once "Pais.class.php";
require_once "libs/snoopy/Snoopy.class.php";

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
        return Paises::materializar($xml);
    }
    
    public static function buscarTodosRemoto()
    {
        $arquivo = "http://ws.geonames.org/countryInfo?style=short&lang=en";
        $snoopy = new Snoopy;
        $snoopy->fetch($arquivo);
        $xml = simplexml_load_string($snoopy->results);
        return Paises::materializar($xml);
    }
    
    private static function materializar($xml_geonames)
    {
    	foreach($xml_geonames->country as $country)
        {
            $pais = new Pais();
            $pais->setId($country->geonameId);
            $pais->setNome($country->countryName);
            $resultado[sizeof($resultado)] = $pais;
        }
        usort($resultado, "Pais::compararPorNome");
        return $resultado;
	}
}

?>
