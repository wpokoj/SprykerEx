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


        $function->setQuery($boolQuery);

        $this->boostSearchResultByType($function);
        $this->boostSearchResultByTemperature($function);
        $this->boostSearchResultByDistance($function);

        $query = (new Query())
            ->setQuery($function)
            ->setSize(5);

        return $query;
    }

    protected function boostSearchResultByType(FunctionScore $fn): void {
        if(!($type = $this->data->getType())) {
            return;
        }

        var_dump($type);

        $fn->addScriptScoreFunction(
            (new Script("
            doc.type.empty ? 0.0 : (doc.type.value == params.expected ? params.norm : 0.0)
            "))
                ->setParam('norm', 50.0)
                ->setParam('expected', $type)
        );
    }

    protected function boostSearchResultByTemperature(FunctionScore $fn): void {

        if(($temp = $this->data->getAverageTemperature()) === null) {
            return;
        }

        //var_dump($temp);

        $fn->addScriptScoreFunction(
            (new Script(
            $this->generatePainlessBellCurveFunction()
            ."
            params.norm * bell(
                params.expected - (doc.average_temperature.empty ? params.inf : doc.average_temperature.value)
            )
            "))
                ->setParam('inf', 1000000)
                ->setParam('norm', 100.0)
                ->setParam('expected', $temp)
        );
    }

    protected function boostSearchResultByDistance(FunctionScore  $fn): void {

        if(!($dist = $this->data->getAverageDistance())) {
            return;
        }

        var_dump($dist);

        $fn->addScriptScoreFunction(
            (new Script(
            $this->generatePainlessBellCurveFunction()
            ."
            params.norm * bell(
                params.expected - (doc.average_distance.empty ? params.inf : doc.average_distance.value)
            )
            "))
                ->setParam('inf', 1000000)
                ->setParam('norm', 100.0)
                ->setParam('expected', $dist)
        );
    }

    protected function generatePainlessBellCurveFunction(): string {

        return
        "
        double bell(def x) {
            return Math.exp(-(0.00001f * x * x))
        }
        ";
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
