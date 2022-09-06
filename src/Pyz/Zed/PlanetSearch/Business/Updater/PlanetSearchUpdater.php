<?php

namespace Pyz\Zed\PlanetSearch\Business\Updater;

use Generated\Shared\Transfer\PlanetTransfer;
use Orm\Zed\Planet\Persistence\PyzPlanetQuery;
use Orm\Zed\PlanetSearch\Persistence\PyzPlanetSearchQuery;

class PlanetSearchUpdater {

    public function update(int $idPlanet): void {

        $planetEntity = PyzPlanetQuery::create()
            ->filterByIdPlanet($idPlanet)
            ->findOne();

        $planetTransfer = new PlanetTransfer();
        $planetTransfer->fromArray($planetEntity->toArray());

        $searchEntity = PyzPlanetSearchQuery::create()
            ->filterByFkPlanet($idPlanet)
            ->findOneOrCreate();

        $searchEntity->setFkPlanet($idPlanet);
        $searchEntity->setData($planetTransfer->toArray());
        $searchEntity->save();
    }
}
