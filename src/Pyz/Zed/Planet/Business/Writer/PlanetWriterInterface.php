<?php

namespace Pyz\Zed\Planet\Business\Writer;

use Generated\Shared\Transfer\PlanetTransfer;
use Generated\Shared\Transfer\PyzPlanetEntityTransfer;

interface PlanetWriterInterface {

    public function savePlanetEntity(PlanetTransfer $transfer) : PlanetTransfer;
}
