<?php

namespace Pyz\Zed\Planet\Persistence;

use Generated\Shared\Transfer\MoonTransfer;
use Generated\Shared\Transfer\PlanetTransfer;
use Generated\Shared\Transfer\PyzPlanetEntityTransfer;
use Orm\Zed\Planet\Persistence\PyzMoon;
use Orm\Zed\Planet\Persistence\PyzPlanet;
use Orm\Zed\Planet\Persistence\PyzPlanetQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method PlanetPersistenceFactory getFactory()
 */
class PlanetEntityManager extends AbstractEntityManager implements PlanetEntityManagerInterface {

    public function savePlanetEntity(PlanetTransfer $transfer) : PlanetTransfer {

        $ent = new PyzPlanet();
        $ent->fromArray($transfer->toArray());
        $ent->save();

        return $transfer->fromArray($ent->toArray(), true);
    }

    public function editPlanetEntity(PlanetTransfer  $transfer) : PlanetTransfer {


        /*$res = $this
            ->getFactory()
            ->createPlanetQuery()
            ->filterByIdPlanet($transfer->getIdPlanet())
            ->update([
                'InterestingFact'   => $transfer->getInterestingFact(),
                'OrbitTime'         => $transfer->getOrbitTime(),
                'Name'              => $transfer->getName(),
            ]);*/

        $planetEntity =
            $this
            ->getFactory()
            ->createPlanetQuery()
            ->filterByIdPlanet($transfer->getIdPlanet())
            ->findOneOrCreate();


        $planetEntity->fromArray($transfer->toArray());
        $planetEntity->save();

        return $transfer;
    }

    public function deletePlanetEntity(PlanetTransfer $transfer): void {
        $res = $this
            ->getFactory()
            ->createPlanetQuery()
            ->filterByIdPlanet($transfer->getIdPlanet())
            ->delete();

        return;
    }

    public function saveMoonEntity(MoonTransfer $transfer): MoonTransfer {

        $moon = new PyzMoon();
        $moon->fromArray($transfer->toArray());
        $moon->save();

        return $transfer->fromArray($moon->toArray(), true);
    }

    public function editMoonEntity(MoonTransfer $transfer): MoonTransfer {

        // TODO: Figure out why this works and other methods don't
        $moonEntity =
            $this
                ->getFactory()
                ->createMoonQuery()
                ->filterByIdMoon($transfer->getIdMoon())
                ->update([
                    'IdPlanet'  => $transfer->getIdPlanet(),
                    'Name'      => $transfer->getName(),
                    'OrbitTime' => $transfer->getOrbitTime(),
                ]);

        return $transfer;
        /*
        $moonEntity->setIdPlanet($transfer->getIdPlanet());
        $moonEntity->save();

        var_dump($moonEntity); die();

        $moonEntity->fromArray($transfer->toArray());

        $moonEntity->setPyzPlanet(
            $this->getFactory()->createPlanetQuery()
                ->findOneByIdPlanet($transfer->getIdPlanet())
        );

        return $transfer;
        */
    }

    public function deleteMoonEntity(MoonTransfer $transfer): void {
        $this
            ->getFactory()
            ->createMoonQuery()
            ->filterByIdMoon($transfer->getIdMoon())
            ->delete();
    }
}
