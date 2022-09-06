<?php

namespace Pyz\Zed\PlanetSearch\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method PlanetSearchBusinessFactory getFactory()
 */
class PlanetSearchFacade extends AbstractFacade implements PlanetSearchFacadeInterface {

    public function publish(int $idPlanet): void {
        $this->getFactory()
            ->createPlanetSearchWriter()
            ->publish($idPlanet);
    }

    public function delete(int $idPlanet): void {
        $this->getFactory()
            ->createPlanetSearchDeleter()
            ->delete($idPlanet);
    }

    public function update(int $idPlanet): void {
        $this->getFactory()
            ->createPlanetSearchUpdater()
            ->update($idPlanet);
    }
}
