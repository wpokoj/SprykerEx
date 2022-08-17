<?php

namespace Pyz\Zed\Planet\Business;

use Generated\Shared\Transfer\MoonTransfer;
use Generated\Shared\Transfer\PlanetTransfer;
use Generated\Shared\Transfer\PyzPlanetEntityTransfer;
use Propel\Runtime\Collection\ObjectCollection;

interface PlanetFacadeInterface {

    public function createPlanetEntity(PlanetTransfer $transfer) : PlanetTransfer;
    public function editPlanetEntity(PlanetTransfer $transfer) : PlanetTransfer;
    public function findPlanetEntity(int $id) : ?PlanetTransfer;
    public function getPlanetEntities() : ObjectCollection;
    public function deletePlanetEntity(PlanetTransfer $transfer): void;


    public function createMoonEntity(MoonTransfer $transfer) : MoonTransfer;
    public function editMoonEntity(MoonTransfer $transfer) : MoonTransfer;
    public function findMoonEntity(int $id) : ?MoonTransfer;
    public function getMoonEntities() : ObjectCollection;
    public function deleteMoonEntity(MoonTransfer $transfer): void;
}
