<?php
require_once "Estado.class.php";
require_once "libs/snoopy/Snoopy.class.php";

class Estados
{
    public static function buscar($idPais)
    {
        $resultado = Estados::buscarLocal($idPais);
        if($resultado == null)
        {
            $resultado = Estados::buscarRemoto($idPais);
        }                
        return $resultado;
    }
    
    public static function buscarLocal($idPais)
    {
        $arquivo = "estados_de_" . $idPais . ".xml";
        if(!file_exists($arquivo))
            return null;

        $resultado = array();
        $xml = simplexml_load_file($arquivo);
        return Estados::materializar($xml);
    }
    
    public static function buscarRemoto($idPais)
    {
        $arquivo = "http://ws.geonames.org/children?style=short&lang=en&geonameId=" . $idPais;
        $snoopy = new Snoopy;
        $snoopy->fetch($arquivo);
        $xml = simplexml_load_string($snoopy->results);
        return Estados::materializar($xml);
    }
    
    private static function materializar($xml_geonames)
    {
    	foreach($xml_geonames->geoname as $geoname)
        {
            $estado = new Estado();
            $estado->setId($geoname->geonameId);
            $estado->setNome($geoname->name);
            $estado->podarNome();
            $resultado[sizeof($resultado)] = $estado;
        }
        usort($resultado, "Estado::compararPorNome");
        return $resultado;
	}
}

?>
