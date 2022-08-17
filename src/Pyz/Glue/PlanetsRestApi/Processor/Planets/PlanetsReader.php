<?php

namespace Pyz\Glue\PlanetsRestApi\Processor\Planets;

use Generated\Shared\Transfer\PlanetCollectionTransfer;
use Pyz\Client\PlanetsRestApi\PlanetsRestApiClientInterface;
use Pyz\Glue\PlanetsRestApi\PlanetsRestApiConfig;
use Pyz\Glue\PlanetsRestApi\Processor\Mapper\PlanetsResourceMapperInterface;
use Pyz\Glue\PlanetsRestApi\Processor\Mapper\PlanetsResourceMapper;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class PlanetsReader implements PlanetsReaderInterface
{
    /** @var \Pyz\Client\PlanetsRestApi\PlanetsRestApiClientInterface */
    private PlanetsRestApiClientInterface $planetsRestApiClient;

    /** @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface */
    private RestResourceBuilderInterface $restResourceBuilder;

    /** @var \Pyz\Glue\PlanetsRestApi\Processor\Mapper\PlanetsResourceMapper */
    private PlanetsResourceMapper $planetMapper;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \Pyz\Glue\PlanetsRestApi\Processor\Mapper\PlanetsResourceMapperInterface $planetMapper
     */
    public function __construct(
        PlanetsRestApiClientInterface $planetsRestApiClient,
        RestResourceBuilderInterface   $restResourceBuilder,
        PlanetsResourceMapperInterface $planetMapper
    )
    {
        $this->planetsRestApiClient = $planetsRestApiClient;
        $this->restResourceBuilder = $restResourceBuilder;
        $this->planetMapper = $planetMapper;
    }

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getPlanets(RestRequestInterface $restRequest): RestResponseInterface
    {

        $restResponse = $this->restResourceBuilder->createRestResponse();

        $planetCollectionTransfer =
            $this->planetsRestApiClient->getPlanetCollection(new PlanetCollectionTransfer());

        //var_dump($planetCollectionTransfer);
        //die();

        foreach ($planetCollectionTransfer->getPlanets() as $planetTransfer) {
            $restResource = $this->restResourceBuilder->createRestResource(
                PlanetsRestApiConfig::RESOURCE_PLANETS,
                $planetTransfer->getIdPlanet(),
                $this->planetMapper->mapPlanetDataToPlanetRestAttributes($planetTransfer)
            );
            $restResponse->addResource($restResource);
        }

        return $restResponse;
    }
}


