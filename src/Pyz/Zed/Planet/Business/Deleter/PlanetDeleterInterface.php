<?php

namespace Pyz\Zed\Planet\Business\Deleter;

use Generated\Shared\Transfer\PlanetTransfer;

interface PlanetDeleterInterface {

    public function deletePlanetEntity(PlanetTransfer $planetTransfer): void ;
}
