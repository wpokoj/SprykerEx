<?php

namespace Pyz\Zed\Planet\Persistence;

use Generated\Shared\Transfer\MoonTransfer;
use Generated\Shared\Transfer\PlanetTransfer;
use Generated\Shared\Transfer\PyzPlanetEntityTransfer;

interface PlanetEntityManagerInterface {

    public function savePlanetEntity(PlanetTransfer $transfer) : PlanetTransfer;
    public function editPlanetEntity(PlanetTransfer $transfer) : PlanetTransfer;
    public function deletePlanetEntity(PlanetTransfer  $transfer) : void;

    public function saveMoonEntity(MoonTransfer $transfer) : MoonTransfer;
    public function editMoonEntity(MoonTransfer $transfer) : MoonTransfer;
    public function deleteMoonEntity(MoonTransfer  $transfer) : void;

}
