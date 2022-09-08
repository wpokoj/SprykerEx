<?php

namespace Pyz\Yves\PlanetWidget;

use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;

class PlanetWidgetDependencyProvider extends AbstractBundleDependencyProvider {

    public const CLIENT_PLANET = 'CLIENT_PLANET';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container) {

        $container = $this->addPlanetClient($container);
        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addPlanetClient(Container $container) {

        $container[self::CLIENT_PLANET] = function (Container $container) {
            return $container->getLocator()->planet()->client();
        };

        return $container;
    }
}
