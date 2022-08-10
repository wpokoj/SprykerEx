<?php

namespace Pyz\Zed\Planet\Business\Editor;

use Generated\Shared\Transfer\PlanetTransfer;
use Pyz\Zed\Planet\Persistence\PlanetEntityManagerInterface;

class PlanetEditor implements PlanetEditorInterface {

    protected PlanetEntityManagerInterface $entityManager;

    public function __construct(PlanetEntityManagerInterface $entityManager) {

        $this->entityManager = $entityManager;
    }

    public function editPlanetEntity(PlanetTransfer $transfer): PlanetTransfer {

        return $this->entityManager->editEntity($transfer);
    }

}
