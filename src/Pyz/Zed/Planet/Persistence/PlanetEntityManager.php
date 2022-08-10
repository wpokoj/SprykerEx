<?php

namespace Pyz\Zed\Planet\Persistence;

use Generated\Shared\Transfer\PlanetTransfer;
use Generated\Shared\Transfer\PyzPlanetEntityTransfer;
use Orm\Zed\Planet\Persistence\PyzPlanet;
use Orm\Zed\Planet\Persistence\PyzPlanetQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

class PlanetEntityManager extends AbstractEntityManager implements PlanetEntityManagerInterface {

    public function saveEntity(PlanetTransfer $transfer) : PlanetTransfer {

        $ent = new PyzPlanet();
        $ent->fromArray($transfer->toArray());
        $ent->save();

        return $transfer->fromArray($ent->toArray(), true);
    }

    public function editEntity(PlanetTransfer  $transfer) : PlanetTransfer {

        /*$ent = new PyzPlanet();
        $ent->fromArray($transfer->toArray())
        $ent->postUpdate();
        $ent->save();*/

        $res = $this
            ->getFactory()
            ->createPlanetQuery()
            ->filterByIdPlanet($transfer->getIdPlanet())
            ->update([
                'InterestingFact'   => $transfer->getInterestingFact(),
                'OrbitTime'         => $transfer->getOrbitTime(),
                'Name'              => $transfer->getName(),
            ]);

        return $transfer;
    }

    public function deleteEntity(PlanetTransfer $transfer): void {
        $res = $this
            ->getFactory()
            ->createPlanetQuery()
            ->filterByIdPlanet($transfer->getIdPlanet())
            ->delete();

        return;
    }
}
