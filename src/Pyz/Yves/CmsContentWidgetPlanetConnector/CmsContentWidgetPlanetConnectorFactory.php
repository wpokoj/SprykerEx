<?php

namespace Pyz\Yves\CmsContentWidgetPlanetConnector;

use Pyz\Client\Planet\PlanetClientInterface;
use Spryker\Yves\Kernel\AbstractFactory;

class CmsContentWidgetPlanetConnectorFactory extends AbstractFactory {
    /**
     * @return \Pyz\Client\Planet\PlanetClientInterface
     */
    public function getPlanetClient(): PlanetClientInterface {
        return $this->getProvidedDependency(
            CmsContentWidgetPlanetConnectorDependencyProvider::CLIENT_PLANET
        );
    }
}
