<?php

namespace Pyz\Zed\Planet\Business;

use Generated\Shared\Transfer\PlanetTransfer;
use Generated\Shared\Transfer\PyzPlanetEntityTransfer;
use Propel\Runtime\Collection\ObjectCollection;
use Pyz\Zed\Planet\Persistence\PlanetEntityManager;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class PlanetFacade extends AbstractFacade implements PlanetFacadeInterface {

    public function createPlanetEntity(PlanetTransfer $transfer): PlanetTransfer {

        //$transfer->setInterestingFact(strrev($transfer->getInterestingFact()));

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
}
