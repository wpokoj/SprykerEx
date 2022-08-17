<?php

namespace Pyz\Client\PlanetsRestApi;

use Generated\Shared\Transfer\PlanetCollectionTransfer;

interface PlanetsRestApiClientInterface
{
    /**
     * @api
     * @return \Generated\Shared\Transfer\PlanetCollectionTransfer
     */
    public function getPlanetCollection(PlanetCollectionTransfer $planetCollectionTransfer): PlanetCollectionTransfer;
}
