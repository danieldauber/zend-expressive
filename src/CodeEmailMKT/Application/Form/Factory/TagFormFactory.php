<?php

namespace CodeEmailMKT\Application\Form\Factory;

use CodeEmailMKT\Application\Form\CustomerForm;
use CodeEmailMKT\Application\Form\TagForm;
use CodeEmailMKT\Application\InputFilter\CustomerInputFilter;
use CodeEmailMKT\Domain\Entity\Customer;
use Interop\Container\ContainerInterface;
use Zend\Hydrator\ClassMethods;

class TagFormFactory
{
    public function __invoke(ContainerInterface $container) : TagForm
    {

        $form = new TagForm();
        $form->setHydrator(new ClassMethods());
        $form->setObject(new Customer());
        $form->setInputFilter(new CustomerInputFilter());

        return $form;
    }
}
