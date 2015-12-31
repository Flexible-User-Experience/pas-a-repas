<?php

namespace AppBundle\Tests\Form\Type;

use AppBundle\Form\Type\ContactType;
use AppBundle\Entity\Contact;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Class ContactTypeTest
 *
 * @category Test
 * @package  AppBundle\Tests\Form\Type
 * @author   David Romaní <david@flux.cat>
 */
class ContactTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = array(
            'name' => 'test name',
            'email' => 'test email',
            'phone' => 'test phone',
            'message' => 'test message',
        );

        $type = new ContactType();
        $form = $this->factory->create($type);

        $object = Contact::fromArray($formData);

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($object->getName(), $form->getData()['name']);
        $this->assertEquals($object->getEmail(), $form->getData()['email']);
        $this->assertEquals($object->getPhone(), $form->getData()['phone']);
        $this->assertNotEquals($object->getPhone(), $form->getData()['message']);
        $this->assertEquals($object->getMessage(), $form->getData()['message']);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
