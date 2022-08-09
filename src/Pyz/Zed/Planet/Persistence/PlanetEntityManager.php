<?php

namespace Pyz\Zed\Planet\Persistence;

use Generated\Shared\Transfer\PyzPlanetEntityTransfer;
use Orm\Zed\Planet\Persistence\PyzPlanet;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

class PlanetEntityManager extends AbstractEntityManager implements PlanetEntityManagerInterface {

    public function saveEntity(PyzPlanetEntityTransfer $transfer) : PyzPlanetEntityTransfer {

        $ent = new PyzPlanet();
        $ent->fromArray($transfer->toArray());
        $ent->save();

        return $transfer->fromArray($ent->toArray(), true);
    }
}
