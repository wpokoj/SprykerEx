<?php

namespace Pyz\Client\PlanetSearch;

use Pyz\Client\PlanetSearch\Plugin\Elasticsearch\Query\PlanetSearchQueryPlugin;
use Spryker\Client\Catalog\Plugin\Elasticsearch\ResultFormatter\RawCatalogSearchResultFormatterPlugin;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method PlanetSearchFactory getFactory()
 */
class PlanetSearchClient extends AbstractClient {

    public function getRes() {

        $searchQuery = new PlanetSearchQueryPlugin(3);/*$this
            ->getFactory()
            ->createPersonalizedProductsQueryPlugin($limit);*/

        $searchQueryFormatters = new RawCatalogSearchResultFormatterPlugin();/*$this
            ->getFactory()
            ->getSearchQueryFormatters();*/

        return $this->getFactory()
            ->createSearchClient()
            ->search(
                $searchQuery,
                []
            );
    }
}
