<?php

namespace Pyz\Glue\PlanetsRestApi\Plugin;


use Generated\Shared\Transfer\RestPlanetsResponseAttributesTransfer;
use Pyz\Glue\PlanetsRestApi\PlanetsRestApiConfig;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

/**
 * @method \Pyz\Glue\PlanetsRestApi\PlanetsRestApiFactory getFactory()
 */
class PlanetsResourceRoutePlugin
    extends AbstractPlugin
    implements ResourceRoutePluginInterface {


    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection): ResourceRouteCollectionInterface
    {
        $resourceRouteCollection
            ->addGet('get', false);

        return $resourceRouteCollection;
    }

    public function getResourceType(): string
    {
        return PlanetsRestApiConfig::RESOURCE_PLANETS;
    }

    public function getController(): string
    {
        return 'planets-resource';
    }

    public function getResourceAttributesClassName(): string
    {
        return RestPlanetsResponseAttributesTransfer::class;
    }
}
