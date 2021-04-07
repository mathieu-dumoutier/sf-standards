<?php

namespace App\Handler;

/**
 * Class CsvResultHandler
 * @package App\Handler
 */

class CsvResultHandler
{
    // Dans cette classe on gérera la lecture du fichier CSV de résultats à l'EuroMillions

    function lireCsv()
    {
        $csv = new \SplFileObject('storage/euromillions.csv','r');

        foreach($csv as $ligne) {
            // on passe la ligne d'entete
            return $ligne[1];
        }
    }


}