<?php

namespace Pyz\Zed\Planet\Business\Reader;

use Generated\Shared\Transfer\PlanetTransfer;

interface PlanetReaderInterface {

    public function getPlanetById(int $id): ?PlanetTransfer;
}
