<?php

namespace Pyz\Zed\Planet\Communication;

use Orm\Zed\Planet\Persistence\PyzPlanetQuery;
use Pyz\Zed\Planet\PlanetDependencyProvider;
use Pyz\Zed\Planet\Communication\Table\PlanetTable;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

class PlanetCommunicationFactory extends AbstractCommunicationFactory {

    public function __construct() {

    }

    /**
     * @return \Pyz\Zed\Planet\Communication\Table\PlanetTable
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function createPlanetTable(): PlanetTable {
        return new PlanetTable($this->getPlanetPropelQuery());
    }

    /**
     * @return \Orm\Zed\Planet\Persistence\PyzPlanetQuery
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    private function getPlanetPropelQuery(): PyzPlanetQuery {
        return $this->getProvidedDependency(PlanetDependencyProvider::QUERY_PLANET);
    }
}
