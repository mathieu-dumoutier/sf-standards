<?php

namespace App\Controller;

use App\Handler\CsvResultHandler;

/**
 * Class WinApiController
 * @package App\Controller
 *  @Route("/resultats", name="results", methods={"GET"})
 */

class WinApiController
{
    // Fournir une API qui donne le dernier résultat à l'EuroMillions

    function showResults(CsvResultHandler : $csvResultHandler): Response
    {
        return $this->json(
            $csvResultHandler->lastResult()['boules_gagnantes_en_ordre_croissant']
        );
    }
}