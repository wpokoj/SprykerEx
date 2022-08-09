<?php

namespace Pyz\Zed\Planet\Business;

use Generated\Shared\Transfer\PyzPlanetEntityTransfer;
use Pyz\Zed\Planet\Persistence\PlanetEntityManager;

class PlanetFacade implements PlanetFacadeInterface {

    public function createPlanetEntity(PyzPlanetEntityTransfer $transfer): PyzPlanetEntityTransfer {

        //$transfer->setInterestingFact(strrev($transfer->getInterestingFact()));

        return ((new PlanetEntityManager())->saveEntity($transfer));
    }
}
