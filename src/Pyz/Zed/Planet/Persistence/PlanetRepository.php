<?php

namespace Pyz\Zed\Planet\Persistence;

use Generated\Shared\Transfer\MoonTransfer;
use Generated\Shared\Transfer\PlanetCollectionTransfer;
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
            ->leftJoinWithPyzMoon()
            ->find();

        return $data;
    }

    public function findMoonById(int $id): ?MoonTransfer {
        $res = $this
            ->getFactory()
            ->createMoonQuery()
            ->filterByIdMoon($id)
            ->findOne();

        if(!$res) {
            return null;
        }

        return (new MoonTransfer())
            ->fromArray($res->toArray(),true);

    }

    public function getPlanetCollection(
        PlanetCollectionTransfer $transfer,
        ?int $planetId = null
    ): PlanetCollectionTransfer
    {
        $query = $this->getFactory()->createPlanetQuery();

        if($planetId !== null) {
            $query = $query->filterByIdPlanet($planetId);
        }

        $res = $query->leftJoinWithPyzMoon()->find();

        foreach ($res->getData() as $planet) {
            $planetTrans = (new PlanetTransfer())->fromArray(
                    $planet->toArray(),
                );

            $moons = $planet->getPyzMoons();

            foreach ($moons->getData() as $moon) {
                $planetTrans->addPyzMoons((new MoonTransfer())
                    ->fromArray($moon->toArray()));
            }

            $transfer->addPlanet($planetTrans);
        }

        return $transfer;
    }


    public function findMoons(): ObjectCollection {
        // TODO: Implement findMoons() method.
    }


    // TODO: Remove this
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

    // TODO: Remove this
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
