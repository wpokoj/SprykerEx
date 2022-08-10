<?php

namespace Pyz\Zed\Planet\Communication\Table;

use Orm\Zed\Planet\Persistence\Map\PyzPlanetTableMap;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;
use Orm\Zed\Planet\Persistence\PyzPlanetQuery;
use Spryker\Zed\ProductRelationGui\Communication\Controller\ViewController;

class PlanetTable extends AbstractTable {

    const COL_ACTIONS = 'Actions';

    /** @var PyzPlanetQuery
     */
    private PyzPlanetQuery $planetQuery;

    /**
     * @param PyzPlanetQuery $planetQuery
     */
    public function __construct(PyzPlanetQuery $planetQuery) {
        $this->planetQuery = $planetQuery;
    }

    /**
     * @param TableConfiguration $config
     *
     * @return TableConfiguration
     */
    protected function configure(TableConfiguration $config): TableConfiguration  {
        $config->setHeader([
            PyzPlanetTableMap::COL_ID_PLANET => 'Planet ID',
            PyzPlanetTableMap::COL_NAME => 'Planet name',
            PyzPlanetTableMap::COL_ORBIT_TIME => 'Orbit time',
            PyzPlanetTableMap::COL_INTERESTING_FACT => 'Interesting fact',
            static::COL_ACTIONS => static::COL_ACTIONS,
        ]);

        $config->setSortable([
            PyzPlanetTableMap::COL_ID_PLANET,
            PyzPlanetTableMap::COL_NAME,
            PyzPlanetTableMap::COL_INTERESTING_FACT
        ]);

        $config->setSearchable([
            PyzPlanetTableMap::COL_NAME
        ]);

        $config->setRawColumns([
            static::COL_ACTIONS,
        ]);

        return $config;
    }

    /**
     * @param TableConfiguration $config
     *
     * @return array
     */
    protected function prepareData(TableConfiguration $config) : array {

        $planetDataItems = $this->runQuery($this->planetQuery, $config);
        $planetTableRows = [];

        foreach ($planetDataItems as $planetDataItem) {
            $planetTableRows[] = [
                PyzPlanetTableMap::COL_ID_PLANET =>
                    $planetDataItem[PyzPlanetTableMap::COL_ID_PLANET],
                PyzPlanetTableMap::COL_NAME =>
                    $planetDataItem[PyzPlanetTableMap::COL_NAME],
                PyzPlanetTableMap::COL_ORBIT_TIME =>
                    $planetDataItem[PyzPlanetTableMap::COL_ORBIT_TIME],
                PyzPlanetTableMap::COL_INTERESTING_FACT =>
                    $planetDataItem[PyzPlanetTableMap:: COL_INTERESTING_FACT],
                static::COL_ACTIONS =>
                    '<a href="/planet/edit/index?id-planet='.$planetDataItem[PyzPlanetTableMap::COL_ID_PLANET].'">Edit</a>'.
                    '<a href="/planet/delete/index?id-planet='.$planetDataItem[PyzPlanetTableMap::COL_ID_PLANET].'">Delete</a>'
            ];
        }

        return $planetTableRows;

        //return $this->runQuery($this->planetQuery, $config);
    }

    protected function generateActions(int $id): string {

        return '';
    }
}
