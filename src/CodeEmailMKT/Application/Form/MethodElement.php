<?php

namespace CodeEmailMKT\Application\Form;

use Zend\Form\Element\Hidden;

class MethodElement extends Hidden
{
    public function __construct($value, $options = [])
    {
        parent::__construct('_method', $options);
        $this->setValue($value);
    }
}
