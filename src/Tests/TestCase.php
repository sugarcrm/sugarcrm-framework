<?php

namespace DRI\SugarCRM\Tests;

use \DRI\SugarCRM\Module\BeanFactory;
use \DRI\SugarCRM\Module\Tests\MockBeanFactory;;

/**
 * @author Emil Kilhage
 */
abstract class TestCase extends \PHPUnit_Framework_TestCase
{

    /**
     *
     */
    protected function setUp()
    {
        global $beanList;
        parent::setUp();

        foreach ($beanList as $moduleName => $object_name) {
            $this->setUpBeanFactory($moduleName);
        }
    }

    /**
     * @param $moduleName
     */
    private function setUpBeanFactory($moduleName)
    {
        $instance = MockBeanFactory::factory($moduleName);
        BeanFactory::setInstance($moduleName, $instance);
    }

    /**
     *
     */
    protected function tearDown()
    {
        global $beanList;
        parent::tearDown();

        foreach ($beanList as $moduleName => $object_name) {
            $this->getBeanFactory($moduleName)->removeAllCreated();
            $this->tearDownBeanFactory($moduleName);
        }
    }

    /**
     * @param $moduleName
     */
    private function tearDownBeanFactory($moduleName)
    {
        $instance = BeanFactory::factory($moduleName);
        BeanFactory::setInstance($moduleName, $instance);
    }

    /**
     * @param string $moduleName
     * @return BeanFactory
     */
    public function getBeanFactory($moduleName)
    {
        return BeanFactory::getInstance($moduleName);
    }

    /**
     * @param $moduleName
     * @param array $fields
     * @return \SugarBean
     */
    public function create($moduleName, array $fields = array())
    {
        return $this->getBeanFactory($moduleName)->create($fields);
    }

}
