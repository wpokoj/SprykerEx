<?php

namespace Pyz\Client\Planet\Plugin\Elasticsearch\Query;

use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\Exists;
use Elastica\Query\FunctionScore;
use Elastica\Query\Match;
use Elastica\Query\MatchAll;
use Elastica\Query\MultiMatch;
use Elastica\Script\Script;
use Generated\Shared\Search\PageIndexMap;
use Generated\Shared\Transfer\PlanetTransfer;
use Generated\Shared\Transfer\SearchContextTransfer;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\SearchContextAwareQueryInterface;

class RecommendedPlanetQueryPlugin implements QueryInterface, SearchContextAwareQueryInterface {

    protected PlanetTransfer $data;
    protected const SOURCE_IDENTIFIER = 'page';
    protected ?SearchContextTransfer $searchContextTransfer = null;

    public function __construct(PlanetTransfer $data) {
        $this->data = $data;
    }

    public function getSearchQuery() {
        $boolQuery = (new BoolQuery())
            ->addMust(
                (new Exists('id_planet'))
            );

        $function = new FunctionScore( );
        $function->setScoreMode(FunctionScore::SCORE_MODE_AVERAGE);
        $function->setBoostMode(FunctionScore::SCORE_MODE_AVERAGE);
        $function->addScriptScoreFunction(
            new Script("
            double bell(def x) {
                return Math.exp(-(0.001f * x * x))
            }
            bell(doc.average_temperature.empty ? 1000000000 : doc.average_temperature.value)
            ",
            [
                "inf" => 1000.0, // very large number
            ])
        );

        $function->addScriptScoreFunction(
            new Script("
            double bell(def x) {
                return Math.exp(-(0.001f * x * x))
            }
            100 * (doc.average_distance.empty ? 0 : doc.average_distance.value)
            ",
                [
                    "inf" => 1000.0, // very large number
                ])
        );

        $function->setQuery($boolQuery);



        //$this->boostSearchResultByType($boolQuery);
        //$this->boostSearchResultByTemperature($boolQuery);

        $query = (new Query())
            ->setQuery($function)
            ->setSize(5);

        return $query;
    }

    protected function boostSearchResultByType(BoolQuery $boolQuery): void {
        $type = $this->data->getType();

        if (!$type) { return; }

        $functionScoreQuery = new FunctionScore();
        $functionScoreQuery->setScoreMode(FunctionScore::SCORE_MODE_MULTIPLY);
        $functionScoreQuery->setBoostMode(FunctionScore::BOOST_MODE_MULTIPLY);


        $filter = $this->createFulltextSearchQuery($type);
        $functionScoreQuery->addFunction('weight', 20, $filter);
        $boolQuery->addMust($functionScoreQuery);
    }

    protected function boostSearchResultByTemperature(BoolQuery $boolQuery): void {
        $temp = $this->data->getAverageTemperature();

        if (!$temp) { return; }

        $functionScoreQuery = new FunctionScore();
        $functionScoreQuery->setScoreMode(FunctionScore::SCORE_MODE_MULTIPLY);
        $functionScoreQuery->setBoostMode(FunctionScore::BOOST_MODE_MULTIPLY);


        $filter = $this->createFulltextSearchQuery($temp);
        $functionScoreQuery->addFunction('field-value-factor', [
            "field" => "average_temperature",
            "factor" => 1.2,
            "missing" => 1,
        ]);
        $boolQuery->addMust($functionScoreQuery);
    }

    protected function createFulltextSearchQuery($searchString): Match {
        // We search for color in the "full-text" and "full-text-boosted" fields.
        $matchQuery = (new Match('type', $searchString));

        return $matchQuery;
    }

    public function getSearchContext(): SearchContextTransfer {
        if (!$this->hasSearchContext()) {
            $this->setupDefaultSearchContext();
        }

        return $this->searchContextTransfer;
    }

    public function setSearchContext(SearchContextTransfer $searchContextTransfer): void {
        $this->searchContextTransfer = $searchContextTransfer;
    }

    protected function setupDefaultSearchContext(): void {
        $searchContextTransfer = new SearchContextTransfer();
        $searchContextTransfer->setSourceIdentifier(static::SOURCE_IDENTIFIER);
        $this->searchContextTransfer = $searchContextTransfer;
    }

    /**
     * @return bool
     */
    protected function hasSearchContext(): bool  {
        return (bool)$this->searchContextTransfer;
    }


}
