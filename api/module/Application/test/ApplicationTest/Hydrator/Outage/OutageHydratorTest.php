<?php
/**
 * Neap (http://neap.io/)
 *
 * @package   Neap
 * @author    Michaël "e7d" Ferrand <michael@e7d.io>
 * @copyright 2017 Michaël "e7d" Ferrand (http://github.com/e7d)
 * @license   https://github.com/e7d/neap/blob/master/LICENSE.txt The MIT License
 * @link      https://github.com/e7d/neap
 *
 * PHP version 7.1
 */

namespace ApplicationTest\Hydrator\Outage;

use Zend\Test\PHPUnit\Controller\AbstractControllerTestCase;

class OutageHydratorTest extends AbstractControllerTestCase
{
    private $serviceManager;

    public function setUp()
    {
        $this->setApplicationConfig(
            include './config/tests.config.php'
        );
        parent::setUp();
        $this->serviceManager = $this->getApplicationServiceLocator();
        $this->serviceManager->setAllowOverride(true);
    }

    public function testClassType()
    {
        $outageHydrator = $this->serviceManager->get('Application\Hydrator\Outage\OutageHydrator');

        $this->assertInstanceOf('Application\Hydrator\Outage\OutageHydrator', $outageHydrator);
    }

    public function testBuildEntity()
    {
        $outageHydrator = $this->serviceManager->get('Application\Hydrator\Outage\OutageHydrator');
        $outageModel = $this->serviceManager->get('Application\Database\Outage\OutageModel');

        $outageId = '2c8132bc-479a-4dbb-99a4-773fa451b27b'; // Neap ingest first outage id
        $outage = $outageModel->fetch($outageId);
        $outageEntity = $outageHydrator->buildEntity($outage);

        $this->assertInstanceOf('ZF\Hal\Entity', $outageEntity);
        $this->assertInstanceOf('ZF\Hal\Link\Link', $outageEntity->getLinks()->get('self'));
    }

    public function testBuildEntityWithLinkIngest()
    {
        $outageHydrator = $this->serviceManager->get('Application\Hydrator\Outage\OutageHydrator');
        $outageModel = $this->serviceManager->get('Application\Database\Outage\OutageModel');

        $outageId = '2c8132bc-479a-4dbb-99a4-773fa451b27b'; // Neap ingest first outage id
        $outage = $outageModel->fetch($outageId);
        $outageHydrator->setParam('linkIngest', true);
        $outageEntity = $outageHydrator->buildEntity($outage);

        $this->assertInstanceOf('ZF\Hal\Link\Link', $outageEntity->getLinks()->get('ingest'));
    }
}
