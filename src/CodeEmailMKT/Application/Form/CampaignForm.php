<?php

namespace CodeEmailMKT\Application\Form;

use CodeEmailMKT\Application\InputFilter\CustomerInputFilter;
use CodeEmailMKT\Domain\Entity\Customer;
use CodeEmailMKT\Domain\Entity\Tag;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Form\Element\ObjectSelect;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Hydrator\ClassMethods;

class CampaignForm extends Form implements ObjectManagerAwareInterface
{

    private $objectManager;

    public function __construct($name = 'campaign', array $options = [])
    {
        parent::__construct($name, $options);
    }

    public function init()
    {

        $this->add([
            'name' => 'id',
            'type' => Element\Hidden::class,
        ]);

        $this->add([
            'name' => 'name',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Nome'
            ],
            'attributes' => [
                'id'    =>  'name'
            ]
        ]);

        $this->add([
            'name' => 'tags',
            'type' => ObjectSelect::class,
            'attributes' => [
                'multiple' => 'multiple'
            ],
            'options' => [
                'object_manager' => $this->getObjectManager(),
                'target_class' => Tag::class,
                'property' => 'name',
                'label' => 'Tags'

            ]
        ]);

        $this->add([
            'name' => 'template',
            'type' => Element\Textarea::class,
            'options' => [
                'label' => 'Template'
            ],
            'attributes' => [
                'id' => 'template'
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => Element\Button::class,
            'attributes' => [
                'type' => 'submit'
            ],
            'options' => [
                'label' => 'Submit'
            ],
        ]);
    }

    /**
     * Set the object manager
     *
     * @param ObjectManager $objectManager
     */
    public function setObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * Get the object manager
     *
     * @return ObjectManager
     */
    public function getObjectManager() : ObjectManager
    {
        return $this->objectManager;
    }
}
