<?php

namespace Pyz\Zed\Planet\Business;

use Generated\Shared\Transfer\PyzPlanetEntityTransfer;

interface PlanetFacadeInterface {

    public function createPlanetEntity(PyzPlanetEntityTransfer $transfer) : PyzPlanetEntityTransfer;
}
