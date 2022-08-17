<?php

namespace Pyz\Glue\PlanetsRestApi\Processor\Mapper;

use Generated\Shared\Transfer\PlanetTransfer;
use Generated\Shared\Transfer\RestPlanetsResponseAttributesTransfer;

interface PlanetsResourceMapperInterface
{
    public function mapPlanetDataToPlanetRestAttributes(PlanetTransfer $planetData): RestPlanetsResponseAttributesTransfer;
}
