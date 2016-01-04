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

        $object = new Contact();
        $object
            ->setName($formData['name'])
            ->setEmail($formData['email'])
            ->setPhone($formData['phone'])
            ->setMessage($formData['message']);

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($object->getName(), $form->get('name'));
        $this->assertEquals($object->getEmail(), $form->get('email'));
        $this->assertEquals($object->getPhone(), $form->get('phone'));
        $this->assertNotEquals($object->getPhone(), $form->get('message'));
        $this->assertEquals($object->getMessage(), $form->get('message'));

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
