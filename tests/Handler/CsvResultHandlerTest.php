<?php

namespace App\Tests\Handler;

use App\Handler\CsvResultHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Serializer\SerializerInterface;

class CsvResultHandlerTest extends KernelTestCase
{
    /**
     * @var CsvResultHandler
     */
    private $csvResultHandler;

    public function setUp(): void
    {
        self::bootKernel();

        $this->csvResultHandler = new CsvResultHandler(
            self::$container->get(SerializerInterface::class)
        );
    }

    public function testReadLastResult(): void
    {
        $this->csvResultHandler->read_last_result();
    }


}
