<?php

namespace Pyz\Client\Planet;

use Generated\Shared\Transfer\PlanetTransfer;

interface PlanetClientInterface {
    /**
     * @param string $name
     *
     * @return array
     */
    public function getPlanetByName(string $name): array;

    public function getRecommendedPlanets(PlanetTransfer $data): array;

}
