<?php

namespace Pyz\Client\Planet\Plugin\Elasticsearch\ResultFormatter;

use Elastica\ResultSet;
use Spryker\Client\SearchElasticsearch\Plugin\ResultFormatter\AbstractElasticsearchResultFormatterPlugin;

class PlanetResultFormatterPlugin extends AbstractElasticsearchResultFormatterPlugin {

    public const NAME = 'planet';

    /**
    * @return string
    */
    public function getName() {
        return static::NAME;
    }

    /**
    * @param \Elastica\ResultSet $searchResult
    * @param array $requestParameters
    *
    * @return array
    */

    protected function formatSearchResult(ResultSet $searchResult, array $requestParameters) {
        $res = [];

        foreach ($searchResult->getResults() as $document) {
            $res[] = $document->getSource();
        }

        return $res;
    }
}


