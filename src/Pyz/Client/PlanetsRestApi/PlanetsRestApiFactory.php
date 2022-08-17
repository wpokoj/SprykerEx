<?php

namespace Pyz\Client\PlanetsRestApi;

use Pyz\Client\PlanetsRestApi\Zed\PlanetsRestApiZedStub;
use Pyz\Client\PlanetsRestApi\Zed\PlanetsRestApiZedStubInterface;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;

class PlanetsRestApiFactory extends AbstractFactory{

    public function createPlanetZedStub(): PlanetsRestApiZedStubInterface
    {
        return new PlanetsRestApiZedStub($this->getZedRequestClient());
    }

    /**
     * @return \Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected function getZedRequestClient(): ZedRequestClientInterface
    {
        return $this->getProvidedDependency(PlanetsRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
