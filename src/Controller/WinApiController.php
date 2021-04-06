<?php

namespace App\Controller;

use App\Handler\CsvResultHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WinApiController extends AbstractController
{
    // Fournir une API qui donne le dernier résultat à l'EuroMillions
    /**
     * @Route("/api/win/last-result")
     */
    public function lastResult(CsvResultHandler $csv_resultHandler): Response
    {
        return $this->json(
            $csv_resultHandler->read_last_result()['boules_gagnantes_en_ordre_croissant']
            . $csv_resultHandler->read_last_result()['etoiles_gagnantes_en_ordre_croissant']
        );
    }
}