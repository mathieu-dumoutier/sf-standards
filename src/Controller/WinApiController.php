<?php

namespace App\Controller;

use App\Handler\CsvResultHandler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WinApiController extends AbstractController
{
    // Fournir une API qui donne le dernier résultat à l'EuroMillions
	
    /**
     * @Route("/dernier-tirage", methods={"GET"})
     */
    public function index(CsvResultHandler $csvResultHandler): Response
    {
		string $dernierResultat = $csvResultHandler->getLastTirage();
        $response = new Response($dernierResultat);

        return $response;
    }
}