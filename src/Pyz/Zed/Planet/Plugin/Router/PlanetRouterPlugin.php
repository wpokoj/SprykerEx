<?php

namespace Spryker\Zed\Router\Communication\Plugin\Router;

use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\RouterExtension\Dependency\Plugin\RouterPluginInterface;
use Symfony\Component\Routing\RouterInterface;
//use Spryker\Zed\Router\Business\Router\RouterInterface;
use Spryker\Zed\Router\Business\Router\Router;

/**
* @method \Spryker\Zed\Router\Business\RouterFacade getFacade()
* @method \Spryker\Zed\Router\RouterConfig getConfig()
* @method \Spryker\Zed\Router\Communication\RouterCommunicationFactory getFactory()
*/
class PlanetRouterPlugin extends AbstractPlugin implements RouterPluginInterface {

    public function getRouter(): RouterInterface {
        return new Router();
    }
}
