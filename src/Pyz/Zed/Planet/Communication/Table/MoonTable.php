<?php

namespace Pyz\Zed\Planet\Communication\Table;

use Generated\Shared\Transfer\PyzMoonEntityTransfer;
use Generated\Shared\Transfer\PyzPlanetEntityTransfer;
use Orm\Zed\Planet\Persistence\Map\PyzMoonTableMap;
use Orm\Zed\Planet\Persistence\Map\PyzPlanetTableMap;
use Orm\Zed\Planet\Persistence\PyzMoon;
use Orm\Zed\Planet\Persistence\PyzMoonQuery;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;
use Orm\Zed\Planet\Persistence\PyzPlanetQuery;
use Spryker\Zed\ProductRelationGui\Communication\Controller\DeleteController;
use Spryker\Zed\ProductRelationGui\Communication\Controller\ViewController;

class MoonTable extends AbstractTable{
    const COL_ACTIONS = 'Actions';

    /** @var PyzMoonQuery
     */
    private PyzMoonQuery $moonQuery;

    /**
     * @param PyzMoonQuery $moonQuery
     */
    public function __construct(PyzMoonQuery $moonQuery) {
        $this->moonQuery = $moonQuery;

        //var_dump($planetQuery);
        //die();
    }

    /**
     * @param TableConfiguration $config
     *
     * @return TableConfiguration
     */
    protected function configure(TableConfiguration $config): TableConfiguration  {

        $config->setHeader([
            PyzMoonTableMap::COL_ID_MOON => 'Moon ID',
            PyzMoonTableMap::COL_NAME => 'Moon name',
            PyzMoonTableMap::COL_ORBIT_TIME => 'Orbit time',
            PyzPlanetTableMap::COL_NAME => 'Orbited Planet',
            //static::COL_MOONS => static::COL_MOONS,
            static::COL_ACTIONS => static::COL_ACTIONS,
        ]);

        $config->setSortable([
            PyzMoonTableMap::COL_ID_MOON,
            PyzMoonTableMap::COL_NAME,
        ]);

        $config->setSearchable([
            PyzMoonTableMap::COL_NAME,
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

        $planetDataItems = $this->runQuery(
            $this->moonQuery->innerJoinWithPyzPlanet(),
            $config
        );

        $planetTableRows = [];

        foreach ($planetDataItems as $planetDataItem) {
            $planetTableRows[] = [
                PyzMoonTableMap::COL_ID_MOON =>
                    $planetDataItem[PyzMoonTableMap::COL_ID_MOON],
                PyzMoonTableMap::COL_NAME =>
                    $planetDataItem[PyzMoonTableMap::COL_NAME],
                PyzMoonTableMap::COL_ORBIT_TIME =>
                    $planetDataItem[PyzMoonTableMap::COL_ORBIT_TIME],
                PyzMoonTableMap::COL_ID_PLANET =>
                    $planetDataItem[PyzMoonTableMap::COL_ID_PLANET],
                PyzPlanetTableMap::COL_NAME =>
                    $planetDataItem['PyzPlanet'][PyzPlanetTableMap::COL_NAME],
                /*static::COL_MOONS => //'',
                    $this->createMoonDropdown($planetDataItem[PyzPlanetTableMap::COL_ID_PLANET]),*/
                static::COL_ACTIONS => //$this->generateActions(PyzPlanetTableMap::COL_ID_PLANET),
                    '<a href="/planet/moon-edit?id-moon='.$planetDataItem[PyzMoonTableMap::COL_ID_MOON].'">Edit</a>'.
                    '<a href="/planet/moon-delete?id-moon='.$planetDataItem[PyzMoonTableMap::COL_ID_MOON].'">Delete</a>'

            ];
        }

        return $planetTableRows;
    }

}
