<?php

namespace Pyz\Zed\Planet\Persistence;

use Generated\Shared\Transfer\MoonTransfer;
use Generated\Shared\Transfer\PlanetTransfer;
use Propel\Runtime\Collection\ObjectCollection;

interface PlanetRepositoryInterface {

    public function findPlanetById(int $id): ?PlanetTransfer;
    public function findPlanets() : ObjectCollection;

    public function findMoonById(int $id): ?MoonTransfer;
    public function findMoons() : ObjectCollection;
}
