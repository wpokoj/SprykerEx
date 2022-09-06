<?php

namespace Pyz\Client\Planet;

use Spryker\Client\Kernel\AbstractClient;
/**
 * @method \Pyz\Client\Planet\PlanetFactory getFactory()
 */
class PlanetClient extends AbstractClient implements PlanetClientInterface {

    /**
     * @param string $name
     *
     * @return array
     */
    public function getPlanetByName(string $name): array {

        $searchQuery = $this->getFactory()
            ->createPlanetQueryPlugin($name);

        $resultFormatters = $this->getFactory()
            ->getSearchQueryFormatters();

        $searchResults = $this->getFactory()
            ->getSearchClient()
            ->search(
                $searchQuery,
                $resultFormatters
            );

        return $searchResults['planet'] ?? [];
    }
}


