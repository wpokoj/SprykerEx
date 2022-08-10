<?php

namespace Pyz\Zed\Planet\Persistence;

use Generated\Shared\Transfer\PlanetTransfer;
use Orm\Zed\Planet\Persistence\PyzPlanetQuery;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\Planet\Persistence\PlanetPersistenceFactory getFactory()
 */
class PlanetRepository extends AbstractRepository implements PlanetRepositoryInterface {

    public function findPlanetById(int $id): ?PlanetTransfer {
        $res = $this
            ->getFactory()
            ->createPlanetQuery()
            ->filterByIdPlanet($id)
            ->findOne();

        //q = new PyzPlanetQuery();
        //$q->upd

        if(!$res) {
            return null;
        }

        return (new PlanetTransfer())
            ->fromArray($res->toArray(),true);
    }
}
