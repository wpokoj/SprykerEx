<?php

namespace Pyz\Zed\Planet\Persistence;

use Generated\Shared\Transfer\PlanetTransfer;
use Propel\Runtime\Collection\ObjectCollection;

interface PlanetRepositoryInterface {

    public function findPlanetById(int $id): ?PlanetTransfer;
    public function findPlanets() : ObjectCollection;
}
