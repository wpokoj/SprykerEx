<?php

namespace Pyz\Zed\Planet\Persistence;

use Generated\Shared\Transfer\PlanetTransfer;
use Generated\Shared\Transfer\PyzPlanetEntityTransfer;
use Orm\Zed\Planet\Persistence\PyzPlanetQuery;
use Propel\Runtime\Collection\ObjectCollection;
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

    public function findPlanets() : ObjectCollection {

        $data = $this
            ->getFactory()
            ->createPlanetQuery()
            ->joinWithPyzMoon()
            ->find();



        //var_dump($data->getData());
        //die()
        //;

        return $data;
    }

    public function moonPlanetGet() : array {

        $res = new PyzPlanetQuery();

        $data = $res->leftJoinWithPyzMoon()->find();

        $res = [];

        foreach($data as $entry) {
            $res[] = (new PyzPlanetEntityTransfer())->fromArray($entry);
        }

        return $res;

        var_dump($data);
        die();
    }

    public function moonPlanetGetById($planetId) : ObjectCollection {

        $res = new PyzPlanetQuery();

        return $data = $res->filterByIdPlanet($planetId)->leftJoinWithPyzMoon()->find();

        //echo 'Data:<br><br>';
        //var_dump($data->toArray());
        //die();


        $res = [];

        foreach($data->toArray() as $entry) {
            $res[] = (new PyzPlanetEntityTransfer())->fromArray($entry);
        }

        return $res;


    }
}
