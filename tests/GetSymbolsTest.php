<?php

namespace App\Tests;

use App\Dto\Command;
use App\Form\ApplyType;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Form\Test\TypeTestCase;

class GetSymbolsTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = [
            'companySymbol' => 'AAPL',
            'email' => 'test@gmail.com',
            'dateStart' => '2019-12-20',
            'dateEnd' => '2019-12-25'
        ];

        $objectToCompare = new Command();
        $form = $this->factory->create(ApplyType::class, $objectToCompare);

        $object = new Command();

        $form->submit($formData);

        $this->assertTrue($form->isSubmitted());
        $this->assertTrue($form->isValid());

        $this->assertEquals($object, $objectToCompare);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
