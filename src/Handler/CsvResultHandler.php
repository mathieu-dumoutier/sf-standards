<?php

namespace App\Handler;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class CsvResultHandler
{
    // Dans cette classe on gérera la lecture du fichier CSV de résultats à l'EuroMillions
	public function __construct()
    {
    }
	
	public function GetLastTirage()
	{
		$strFullFileName = "D:\PHP\premierTest\sf-standards\storage\euromillions_202002.csv";
		$result = GetResult($strFullFileName, 2);
		
		if(!is_array($result))
			return null;
		
		$numeros = GetValueFromLine($result[0], $result[1], "boules_gagnantes_en_ordre_croissant");
		$etoiles = GetValueFromLine($result[0], $result[1], "etoiles_gagnantes_en_ordre_croissant");
		
		return $numeros." // ".$etoiles;
	}
	
	public function IsNullOrEmptyString($str){
		return (!isset($str) || '' === trim($str));
	}
	
	/**
     * Obtenir les N derniers résultats (les N premièles lignes du fichier csv)
     *
     * @param string $strCsvFullName   Chemin et nom complet du fichier CSV
     * @param int	 $intNbLastResults Nombre de lignes maximum souhaitées
     *
     * @return array|null Retourne les N premières lignes du CSV dans un tableau
     */
    private function GetResult($strCsvFullName, $intNbLastResults)
    {
		// la ligne 1 contient les entêtes donc la 2ère ligne contient les premières valeurs 
		if(IsNullOrEmptyString($strCsvFullName) || $intNbLastResults < 2)
			return null;
				
		$filesystem = new Filesystem();
		if(!$filesystem->exists($strCsvFullName))
			return null;
		
		//$serializer = new Serializer([new ObjectNormalizer()], [new CsvEncoder()]);
		$serializer = $container->get('serializer');
		$data = $serializer->decode(file_get_contents($strCsvFullName), 'csv');
		
		if(!is_array($data))
			return null;
		
		$intSizeArray = count($data);
		$intNbReturnedLines = $intSizeArray > $intNbLastResults ? $intNbLastResults : $intSizeArray;
		
		return array_slice($data, 0, $intNbReturnedLines);
    }
	
	/**
     * Obtenir une valeur spécifique dans une ligne
     *
     * @param array  $dataHeader 	Ligne des entêtes
     * @param array	 $dataLine		Ligne de recherche
	 * @param string $strColumnName Colonne recherchée
     *
     * @return array|null Retourne la valeur de la ligne pour la colonne recherchée
     */
	
	private function GetValueFromLine($dataHeader, $dataLine, $strColumnName)
	{		
		if(!is_array($dataHeader) || !is_array($dataLine) || IsNullOrEmptyString($strColumnName))
			return null;
			
		$intIndice = 0;
		foreach ($dataHeader as $value)
		{
			if($value == $strColumnName))
			{
				return $dataLine[$intIndice];
			}
			$intIndice = $intIndice + 1 ;
		}
		
		return null;
	}	
}