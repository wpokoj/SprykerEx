<?php

namespace Pyz\Zed\Planet\Business;

use Generated\Shared\Transfer\PlanetTransfer;
use Generated\Shared\Transfer\PyzPlanetEntityTransfer;

interface PlanetFacadeInterface {

    public function createPlanetEntity(PlanetTransfer $transfer) : PlanetTransfer;
    public function editPlanetEntity(PlanetTransfer $transfer) : PlanetTransfer;
    public function findPlanetEntity(int $id) : ?PlanetTransfer;
    public function deletePlanetEntity(PlanetTransfer $transfer): void;
}
