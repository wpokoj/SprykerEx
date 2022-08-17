<?php

namespace Pyz\Zed\Planet\Communication\Controller;

use Generated\Shared\Transfer\PlanetCollectionTransfer;
use Generated\Shared\Transfer\PlanetTransfer;
use Generated\Shared\Transfer\RestPlanetsResponseAttributesTransfer;
use Propel\Runtime\Collection\ObjectCollection;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \Pyz\Zed\Planet\Business\PlanetFacade getPlanetEntities
 */
class GatewayController extends AbstractGatewayController {

    public function getPlanetCollectionAction(PlanetCollectionTransfer $transfer) : PlanetCollectionTransfer{

        $res = new PlanetCollectionTransfer();

        /*$res->addPlanet((new PlanetTransfer())->fromArray([
            'name' => 'jupiter',
            'idPlanet' => 6,
            'interestingFact' => '',
            'orbitTime' => ''
        ],true));*/

        $data = $this->getFacade()->getPlanetEntities();

        if(!$data instanceof ObjectCollection)
            return new PlanetCollectionTransfer();

        foreach ($data->getData() as $planet) {
            $res->addPlanet(
                (new PlanetTransfer())
                    ->fromArray(
                        $planet->toArray(),
                        true
                    )
            );
        }

        return $res;

        return new PlanetCollectionTransfer();
    }
}
