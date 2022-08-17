<?php

namespace Pyz\Client\PlanetsRestApi\Zed;

use Generated\Shared\Transfer\PlanetCollectionTransfer;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;

class PlanetsRestApiZedStub implements PlanetsRestApiZedStubInterface {

    /**
     * @var \Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \Spryker\Client\ZedRequest\ZedRequestClientInterface $zedRequestClient
     */
    public function __construct(ZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param PlanetCollectionTransfer $planetCollectionTransfer
     * @return \Generated\Shared\Transfer\PlanetCollectionTransfer
     */
    public function getPlanetCollection(PlanetCollectionTransfer $planetCollectionTransfer): PlanetCollectionTransfer
    {
        /** @var \Generated\Shared\Transfer\PlanetCollectionTransfer $planetCollectionTransfer */
        //$planetCollectionTransfer = $this->zedRequestClient->call('/planets-rest-api/gateway/get-planet-collection', $planetCollectionTransfer);
        $planetCollectionTransfer = $this->zedRequestClient->call(
            '/planet/gateway/get-planet-collection',
            $planetCollectionTransfer
        );

        //var_dump($planetCollectionTransfer);
        //die();

        return $planetCollectionTransfer;
    }
}
