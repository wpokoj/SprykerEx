<?php

namespace Pyz\Yves\HelloWorld\Plugin\Router;

use Spryker\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin;
use Spryker\Yves\Router\Route\RouteCollection;

class HelloWorldRouteProviderPlugin extends AbstractRouteProviderPlugin
{
    protected const ROUTE_HELLO_WORLD_INDEX = 'hello-world-index';

    /**
     * Specification:
     * - Adds Routes to the RouteCollection.
     *
     * @param RouteCollection $routeCollection
     *
     * @return RouteCollection
     * @api
     *
     */
    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    {
        $routeCollection = $this->addHelloWorldIndexRoute($routeCollection);

        return $routeCollection;
    }

    /**
     * @param RouteCollection $routeCollection
     *
     * @return RouteCollection
     */
    protected function addHelloWorldIndexRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildRoute('/aabbcc', 'HelloWorld', 'Index', 'indexAction');
        $routeCollection->add(static::ROUTE_HELLO_WORLD_INDEX, $route);

        return $routeCollection;
    }
}
