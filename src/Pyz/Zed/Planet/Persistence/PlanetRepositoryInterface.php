<?php

namespace Pyz\Zed\Planet\Persistence;

use Generated\Shared\Transfer\PlanetTransfer;

interface PlanetRepositoryInterface {

    public function findPlanetById(int $id): ?PlanetTransfer;
}
