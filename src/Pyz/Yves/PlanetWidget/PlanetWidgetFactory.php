<?php

namespace Pyz\Yves\PlanetWidget;

use Pyz\Client\Planet\PlanetClientInterface;
use Spryker\Yves\Kernel\AbstractFactory;

class PlanetWidgetFactory extends AbstractFactory {

    /**
     * @return \Pyz\Client\Planet\PlanetClientInterface
     */
    public function getPlanetClient(): PlanetClientInterface {
        return $this->getProvidedDependency(PlanetWidgetDependencyProvider::CLIENT_PLANET);
    }
}
