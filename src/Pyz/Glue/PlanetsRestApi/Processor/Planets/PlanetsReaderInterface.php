<?php

namespace Pyz\Glue\PlanetsRestApi\Processor\Planets;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;


interface PlanetsReaderInterface {

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getPlanets(RestRequestInterface $restRequest): RestResponseInterface;
}
