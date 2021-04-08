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
	
	public function getLastTirage()
	{
		string $fullFileName = "../storage/euromillions_202002.csv";
		$result = getResult($fullFileName, 2);
		
		if(!is_array($result))
		{
			return null;
		}
		
		string $numeros = getValueFromLine($result[0], $result[1], "boules_gagnantes_en_ordre_croissant");
		string $etoiles = getValueFromLine($result[0], $result[1], "etoiles_gagnantes_en_ordre_croissant");
		
		return $numeros." // ".$etoiles;
	}
	
	public function isNullOrEmptyString($str)
	{
		return (!isset($str) || '' === trim($str));
	}
	
	/**
     * Obtenir les N derniers résultats (les N premièles lignes du fichier csv)
     *
     * @param string $csvFullName   Chemin et nom complet du fichier CSV
     * @param int	 $nbLastResults Nombre de lignes maximum souhaitées
     *
     * @return array|null Retourne les N premières lignes du CSV dans un tableau
     */
    private function getResult(string $csvFullName, int $nbLastResults)
    {
		// la ligne 1 contient les entêtes donc la 2ère ligne contient les premières valeurs 
		if(isNullOrEmptyString($csvFullName) || $nbLastResults < 2)
		{
			return null;
		}
				
		$filesystem = new Filesystem();
		if(!$filesystem->exists($csvFullName))
		{
			return null;
		}
		
		$serializer = $container->get('serializer');
		$data = $serializer->decode(file_get_contents($csvFullName), 'csv');
		
		if(!is_array($data))
		{
			return null;
		}
		
		int $sizeArray = count($data);
		int $nbReturnedLines = $sizeArray > $nbLastResults ? $nbLastResults : $sizeArray;
		
		return array_slice($data, 0, $nbReturnedLines);
    }
	
	/**
     * Obtenir une valeur spécifique dans une ligne
     *
     * @param array  $dataHeader 	Ligne des entêtes
     * @param array	 $dataLine		Ligne de recherche
	 * @param string $columnName    Colonne recherchée
     *
     * @return array|null Retourne la valeur de la ligne pour la colonne recherchée
     */
	
	private function getValueFromLine($dataHeader, $dataLine, string $columnName)
	{		
		if(!is_array($dataHeader) || !is_array($dataLine) || isNullOrEmptyString($columnName))
		{
			return null;
		}
			
		int $indice = 0;
		foreach ($dataHeader as $value)
		{
			if($value == $columnName))
			{
				return $dataLine[$indice];
			}
			$indice = $indice + 1 ;
		}
		
		return null;
	}	
}