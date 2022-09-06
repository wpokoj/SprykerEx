<?php

namespace Pyz\Yves\Planet\Plugin\Router;

use Spryker\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin;
use Spryker\Yves\Router\Route\RouteCollection;

class PlanetRouteProviderPlugin extends AbstractRouteProviderPlugin {
    public const PLANET_SEARCH_INDEX = 'planet-search-index';
    public const PLANET_RECOMMEND_INDEX = 'planet-recommend-index';

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
        $routeCollection = $this->addRecommendPlanetRoute($routeCollection);

        return $routeCollection;
    }

    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    protected function addPlanetRoute(RouteCollection $routeCollection): RouteCollection {
        $route = $this->buildRoute(
            '/planet/{name}',
            'Planet',
            'Index',
            'indexAction'
        );

        $routeCollection->add(static::PLANET_SEARCH_INDEX, $route);

        return $routeCollection;
    }

    public function addRecommendPlanetRoute(RouteCollection $routeCollection): RouteCollection {

        $route = $this->buildRoute(
            '/recommend-planet',
            'Planet',
            'Recommend',
            'indexAction'
        );

        $routeCollection->add(static::PLANET_RECOMMEND_INDEX, $route);

        return $routeCollection;
    }
}
