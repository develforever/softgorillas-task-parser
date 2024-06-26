<?php

namespace App\Tests;

use App\Task\Model\Accident;
use App\Task\Parser;
use App\Task\Parser\InstanceFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ParserTest extends KernelTestCase
{

    public function testParseIncidentDuplicatesAndStructures()
    {

        self::bootKernel();

        $parser = self::getContainer()->get(Parser::class);
        $instanceFactory = self::getContainer()->get(InstanceFactory::class);

        $parsedItems = $parser->parse([
            [
                "number" => 1,
                "description" => "Awaria klimatyzacji. Na salonie temperatura wzrosła do 27 stopni. Pozdrawiam Ela.",
                "dueDate" => "2020-01-04 13:30:00",
                "phone" => ""
            ],
            [
                "number" => 2,
                "description" => "Awaria klimatyzacji. Na salonie temperatura wzrosła do 27 stopni. Pozdrawiam Ela.",
                "dueDate" => "",
                "phone" => ""
            ],
        ]);

        $models =  $instanceFactory->makeInstances($parsedItems);
        $duplications = $instanceFactory->getByField('duplicate', true, $parsedItems->getResults());

        $this->assertCount(1,  $models);
        $this->assertCount(1,  $duplications);

        $this->assertObjectHasProperty('type', $models[0]);
        $this->assertObjectHasProperty('serviceVisitDate', $models[0]);
        $this->assertObjectHasProperty('status', $models[0]);

        $this->assertTrue($models[0]->type === Accident::TYPE);
        $this->assertTrue($models[0]->serviceVisitDate === '2020-01-04');
        $this->assertTrue($models[0]->status === Accident::STATUS_DATE_OF_INSPECTION);
    }
}
