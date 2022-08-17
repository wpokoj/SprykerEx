<?php

namespace Pyz\Glue\PlanetsRestApi\Processor\Mapper;

use Generated\Shared\Transfer\PlanetTransfer;
use Generated\Shared\Transfer\RestMoonResponseAttributesTransfer;
use Generated\Shared\Transfer\RestPlanetsResponseAttributesTransfer;

class PlanetsResourceMapper implements PlanetsResourceMapperInterface {

    public function mapPlanetDataToPlanetRestAttributes(PlanetTransfer $planetData): RestPlanetsResponseAttributesTransfer {

        $restPlanetAttributesTransfer
            = (new RestPlanetsResponseAttributesTransfer())
            ->fromArray($planetData->toArray(), true);


        foreach ($planetData->getPyzMoons() as $moon) {
            $restPlanetAttributesTransfer
                ->addMoons(
                    (new RestMoonResponseAttributesTransfer())
                        ->fromArray($moon->toArray(), true)
                );
        }


        //var_dump($restPlanetAttributesTransfer);
        //die();

        return $restPlanetAttributesTransfer;
    }
}
