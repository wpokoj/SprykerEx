<?php

namespace Pyz\Zed\Planet\Business\Writer;

use Generated\Shared\Transfer\PyzPlanetEntityTransfer;
use Pyz\Zed\Planet\Persistence\PlanetEntityManagerInterface;

class PlanetWriter implements PlanetWriterInterface {
    protected PlanetEntityManagerInterface $entityManager;

    public function __construct(PlanetEntityManagerInterface $entityManager) {

        $this->entityManager = $entityManager;
    }

    public function savePlanetEntity(PyzPlanetEntityTransfer $transfer) : PyzPlanetEntityTransfer {

        return $this->entityManager->saveEntity($transfer);
    }
}
