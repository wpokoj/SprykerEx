<?php

namespace Pyz\Client\Planet;

interface PlanetClientInterface {
    /**
     * @param string $name
     *
     * @return array
     */
    public function getPlanetByName(string $name): array;

}
