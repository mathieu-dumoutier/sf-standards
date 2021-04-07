<?php

namespace App\Handler;

use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class CsvResultHandler
 * @package App\Handler
 */

class CsvResultHandler
{
    // Dans cette classe on gérera la lecture du fichier CSV de résultats à l'EuroMillions

    private SerializerInterface : $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function lastResult() : array
    {
        return $this->serializer->decode(
            file_get_contents("../strorage/euromillions_202002.csv",
            'csv',
            ['csv_delimiter' => ';']
            )[1];
        )
    }

}