<?php
/**
 * Neap (http://neap.io/)
 *
 * @link      http://github.com/e7d/neap for the canonical source repository
 * @copyright Copyright (c) 2015 e7d (http://e7d.io)
 * @license   https://github.com/e7d/neap/blob/master/LICENSE.md The MIT License
 */

namespace Application\Authorization;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AuthorizationListenerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $authorizationListener = new AuthorizationListener();
        $authorizationListener->setServiceManager($services);

        return $authorizationListener;
    }
}
