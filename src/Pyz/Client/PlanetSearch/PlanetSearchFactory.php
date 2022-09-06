<?php

namespace Pyz\Client\PlanetSearch;

use Spryker\Client\Kernel\AbstractFactory;

class PlanetSearchFactory extends AbstractFactory {

    public function createSearchClient() {
        return $this->getProvidedDependency(PlanetSearchDependencyProvider::CLIENT_SEARCH);
    }
}
