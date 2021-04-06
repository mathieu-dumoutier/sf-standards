<?php

namespace App\Handler;

use Symfony\Component\Serializer\SerializerInterface;

class CsvResultHandler
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    // Dans cette classe on gérera la lecture du fichier CSV de résultats à l'EuroMillions
    public function read_last_result() {
        return
            $this->serializer->decode(file_get_contents('../storage/euromillions_202002.csv'), 'csv', ['csv_delimiter' => ';'])[1];
    }
}