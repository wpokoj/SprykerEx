<?php

namespace Pyz\Glue\PlanetsRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestPlanetsResponseAttributesTransfer;

interface PlanetsResourceMapperInterface
{
    public function mapPlanetDataToPlanetRestAttributes(array $planetData): RestPlanetsResponseAttributesTransfer;
}
