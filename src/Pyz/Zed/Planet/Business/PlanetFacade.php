<?php

namespace Pyz\Zed\Planet\Business;

use Generated\Shared\Transfer\MoonTransfer;
use Generated\Shared\Transfer\PlanetCollectionTransfer;
use Generated\Shared\Transfer\PlanetTransfer;
use Generated\Shared\Transfer\PyzPlanetEntityTransfer;
use Propel\Runtime\Collection\ObjectCollection;
use Pyz\Zed\Planet\Persistence\PlanetEntityManager;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method PlanetBusinessFactory getFactory()
 */
class PlanetFacade extends AbstractFacade implements PlanetFacadeInterface {

    public function createPlanetEntity(PlanetTransfer $transfer): PlanetTransfer {

        return $this
            ->getFactory()
            ->createPlanetWriter()
            ->savePlanetEntity($transfer);
    }

    public function editPlanetEntity(PlanetTransfer $transfer): PlanetTransfer {

        return $this
            ->getFactory()
            ->createPlanetEditor()
            ->editPlanetEntity($transfer);
    }

    public function findPlanetEntity(int $id) : ?PlanetTransfer {

        return $this
            ->getFactory()
            ->createPlanetReader()
            ->getPlanetById($id);
    }

    public function getPlanetEntities(): ObjectCollection {

        return $this
            ->getFactory()
            ->createPlanetReader()
            ->getPlanets();

    }

    public function deletePlanetEntity(PlanetTransfer $transfer): void {

        $this->getFactory()
            ->createPlanetDeleter()
            ->deletePlanetEntity($transfer);
    }

    public function getPlanetCollection(PlanetCollectionTransfer $transfer): PlanetCollectionTransfer {

        return $this->getFactory()
            ->createPlanetReader()
            ->getPlanetCollection($transfer);
    }




    public function createMoonEntity(MoonTransfer $transfer): MoonTransfer {

        return $this->getFactory()
            ->createMoonWriter()
            ->saveMoon($transfer);
    }

    public function editMoonEntity(MoonTransfer $transfer): MoonTransfer {

        return $this->getFactory()
            ->createMoonEditor()
            ->editMoonEntity($transfer);
    }

    public function findMoonEntity(int $id): ?MoonTransfer {

        return $this->getFactory()
            ->createMoonReader()
            ->getMoonById($id);
    }

    public function getMoonEntities(): ObjectCollection {
        return $this->getFactory()
            ->createMoonReader()
            ->getMoons();
    }

    public function deleteMoonEntity(MoonTransfer $transfer): void {
        // TODO: Implement deleteMoonEntity() method.
    }
}
