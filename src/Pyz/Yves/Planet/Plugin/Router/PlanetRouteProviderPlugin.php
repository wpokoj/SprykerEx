<?php

namespace Pyz\Yves\Planet\Plugin\Router;

use Spryker\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin;
use Spryker\Yves\Router\Route\RouteCollection;

class PlanetRouteProviderPlugin extends AbstractRouteProviderPlugin {
    public const PERSONALIZED_PRODUCT_INDEX = 'personalized-product-index';

    /**
     * Specification:
     * - Adds Routes to the RouteCollection.
     *
     * @api
     *
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    public function addRoutes(RouteCollection $routeCollection): RouteCollection {
        $routeCollection = $this->addPlanetRoute($routeCollection);

        return $routeCollection;
    }

    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    protected function addPlanetRoute(RouteCollection $routeCollection): RouteCollection {
        $route = $this->buildRoute(
            '/planet',
            'Planet',
            'Index',
            'indexAction'
        );

        $routeCollection->add(static::PERSONALIZED_PRODUCT_INDEX, $route);

        return $routeCollection;
    }
}
