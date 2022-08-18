<?php

namespace Pyz\Zed\Planet\Business\Reader;

use Generated\Shared\Transfer\PlanetCollectionTransfer;
use Generated\Shared\Transfer\PlanetTransfer;
use Propel\Runtime\Collection\ObjectCollection;

interface PlanetReaderInterface {

    public function getPlanetById(int $id): ?PlanetTransfer;
    public function getPlanets() : ObjectCollection;
    public function getPlanetCollection(PlanetCollectionTransfer $transfer) : PlanetCollectionTransfer;

}
