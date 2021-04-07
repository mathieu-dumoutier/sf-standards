<?php

namespace App\Controller;

/**
 * Class WinApiController
 * @package App\Controller
 *  @Route("/resultats", name="results", methods={"GET"})
 */

class WinApiController
{
    // Fournir une API qui donne le dernier résultat à l'EuroMillions

    function afficheResultats() {
        return $this->render('results.html.twig', [
            'liste' => lireCsv(),
        ]);
    }
}