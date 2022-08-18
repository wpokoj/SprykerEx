<?php

namespace Pyz\Zed\Planet\Business\Deleter;

use Generated\Shared\Transfer\PlanetTransfer;
use Pyz\Zed\Planet\Business\Reader\PlanetReaderInterface;
use Pyz\Zed\Planet\Persistence\PlanetEntityManager;
use Pyz\Zed\Planet\Persistence\PlanetEntityManagerInterface;

class PlanetDeleter implements PlanetDeleterInterface {

    protected PlanetEntityManagerInterface $manager;

    public function __construct(PlanetEntityManagerInterface $manager) {

        $this->manager = $manager;
    }

    public function deletePlanetEntity(PlanetTransfer $planetTransfer): void {

        $this->manager->deletePlanetEntity($planetTransfer);
    }
}
