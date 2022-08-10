<?php

namespace Pyz\Zed\Planet\Persistence;

use Generated\Shared\Transfer\PlanetTransfer;
use Generated\Shared\Transfer\PyzPlanetEntityTransfer;

interface PlanetEntityManagerInterface {

    public function saveEntity(PlanetTransfer $transfer) : PlanetTransfer;
    public function editEntity(PlanetTransfer $transfer) : PlanetTransfer;
    public function deleteEntity(PlanetTransfer  $transfer) : void;
}
