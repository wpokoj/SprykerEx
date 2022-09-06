<?php

namespace Pyz\Client\Planet;

use Generated\Shared\Transfer\PlanetTransfer;
use Pyz\Client\Planet\Plugin\Elasticsearch\Query\PlanetQueryPlugin;
use Pyz\Client\Planet\Plugin\Elasticsearch\Query\RecommendedPlanetQueryPlugin;
use Spryker\Client\Kernel\AbstractFactory;

class PlanetFactory extends AbstractFactory {

    /**
     * @param string $name
     *
     * @return \Pyz\Client\Planet\Plugin\Elasticsearch\Query\PlanetQueryPlugin
     */
    public function createPlanetQueryPlugin(string $name) {

        return new PlanetQueryPlugin($name);
    }

    public function createRecommendPlanetQueryPlugin(PlanetTransfer $data): RecommendedPlanetQueryPlugin {
        return new RecommendedPlanetQueryPlugin($data);
    }

    /**
     * @return array
     */
    public function getSearchQueryFormatters() {
        return $this->getProvidedDependency(PlanetDependencyProvider::PLANET_RESULT_FORMATTER_PLUGINS);
    }

    /**
     * @return \Spryker\Client\Search\SearchClientInterface
     */
    public function getSearchClient() {
        return $this->getProvidedDependency(PlanetDependencyProvider::CLIENT_SEARCH);
    }
}
