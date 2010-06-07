<?php
require_once "Cidade.class.php";
require_once "libs/snoopy/Snoopy.class.php";

class Cidades
{
    public static function buscar($idEstado)
    {
        $resultado = Cidades::buscarLocal($idEstado);
        if($resultado == null)
        {
            $resultado = Cidades::buscarRemoto($idEstado);
        }                
        return $resultado;
    }
    
    public static function buscarLocal($idEstado)
    {
        $arquivo = "cidades_de_" . $idEstado . ".xml";
        if(!file_exists($arquivo))
            return null;

        $resultado = array();
        $xml = simplexml_load_file($arquivo);
        return Cidades::materializar($xml);
    }
    
    public static function buscarRemoto($idEstado)
    {
        $arquivo = "http://ws.geonames.org/children?style=short&maxRows=1000&lang=en&geonameId=" . $idEstado;
        $snoopy = new Snoopy;
        $snoopy->fetch($arquivo);
        $xml = simplexml_load_string($snoopy->results);
        return Cidades::materializar($xml);
    }
    
    private static function materializar($xml_geonames)
    {
    	foreach($xml_geonames->geoname as $geoname)
        {
            $cidade = new Cidade();
            $cidade->setId($geoname->geonameId);
            $cidade->setNome($geoname->name);
            $cidade->podarNome();
            $resultado[sizeof($resultado)] = $cidade;
        }
        usort($resultado, "Cidade::compararPorNome");
        return $resultado;
	}
}

?>
