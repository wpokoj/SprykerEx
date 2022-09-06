<?php

namespace Pyz\Zed\PlanetSearch\Business;

interface PlanetSearchFacadeInterface {

    /**
     * @param int $idPlanet
     *
     * @return void
     */
    public function publish(int $idPlanet): void;
    public function delete(int $idPlanet): void;
    public function update(int $idPlanet): void;
}
