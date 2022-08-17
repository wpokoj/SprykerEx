<?php

namespace Pyz\Client\PlanetsRestApi\Zed;

use Generated\Shared\Transfer\PlanetCollectionTransfer;

interface PlanetsRestApiZedStubInterface {
    public function getPlanetCollection(
        PlanetCollectionTransfer $planetCollectionTransfer
    ): PlanetCollectionTransfer;
}
