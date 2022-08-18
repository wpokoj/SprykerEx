<?php

namespace Pyz\Zed\Planet\Communication\Controller;

use Generated\Shared\Transfer\MoonTransfer;
use Generated\Shared\Transfer\PlanetCollectionTransfer;
use Generated\Shared\Transfer\PlanetTransfer;
use Generated\Shared\Transfer\RestPlanetsResponseAttributesTransfer;
use Propel\Runtime\Collection\ObjectCollection;
use Pyz\Zed\Planet\Business\PlanetFacade;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method PlanetFacade getFacade()
 */
class GatewayController extends AbstractGatewayController {

    public function getPlanetCollectionAction(PlanetCollectionTransfer $transfer) : PlanetCollectionTransfer{

        return $this->getFacade()->getPlanetCollection($transfer);
    }
}
