<?php

namespace Pyz\Zed\Planet\Business\Reader;

use Generated\Shared\Transfer\MoonTransfer;
use Generated\Shared\Transfer\PlanetTransfer;
use Propel\Runtime\Collection\ObjectCollection;

interface MoonReaderInterface {

    public function getMoonById(int $id): ?MoonTransfer;
    public function getMoons() : ObjectCollection;
}
