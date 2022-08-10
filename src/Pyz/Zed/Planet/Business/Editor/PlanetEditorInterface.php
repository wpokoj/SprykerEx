<?php

namespace Pyz\Zed\Planet\Business\Editor;

use Generated\Shared\Transfer\PlanetTransfer;

interface PlanetEditorInterface {

    public function editPlanetEntity(PlanetTransfer $transfer): PlanetTransfer;
}
