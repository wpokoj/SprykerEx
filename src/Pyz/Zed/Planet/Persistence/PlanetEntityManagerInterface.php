<?php

namespace Pyz\Zed\Planet\Persistence;

use Generated\Shared\Transfer\PyzPlanetEntityTransfer;

interface PlanetEntityManagerInterface {

    public function saveEntity(PyzPlanetEntityTransfer $transfer) : PyzPlanetEntityTransfer;
}
