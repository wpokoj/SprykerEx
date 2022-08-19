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

        $moonDataItems = $this->runQuery(
            $this->moonQuery->innerJoinWithPyzPlanet(),
            $config
        );

        $moonTableRows = [];

        foreach ($moonDataItems as $moonDataItem) {
            $moonTableRows[] = [
                PyzMoonTableMap::COL_ID_MOON =>
                    $moonDataItem[PyzMoonTableMap::COL_ID_MOON],
                PyzMoonTableMap::COL_NAME =>
                    $moonDataItem[PyzMoonTableMap::COL_NAME],
                PyzMoonTableMap::COL_ORBIT_TIME =>
                    $moonDataItem[PyzMoonTableMap::COL_ORBIT_TIME],
                PyzMoonTableMap::COL_ID_PLANET =>
                    $moonDataItem[PyzMoonTableMap::COL_ID_PLANET],
                PyzPlanetTableMap::COL_NAME =>
                    $moonDataItem['PyzPlanet'][PyzPlanetTableMap::COL_NAME],
                static::COL_ACTIONS =>
                    $this->generateActions($moonDataItem[PyzMoonTableMap::COL_ID_MOON])

            ];
        }

        return $moonTableRows;
    }

    protected function generateActions(int $id): string {

        return implode(' ', [
            $this->createEditButton($id),
            $this->createDeleteButton($id),
        ]);
    }

    /**
     * @param int $id
     *
     * @return string
     */
    protected function createEditButton(int $id): string {
        return $this->generateEditButton(
            Url::generate(
                '/planet/moon-edit', [
                'id-moon' => $id,
            ]),
            'Edit'
        );
    }

    /**
     * @param int $id
     *
     * @return string
     */
    protected function createDeleteButton(int $id): string {
        return $this->generateRemoveButton(
            Url::generate(
                '/planet/moon-delete', [
                'id-moon' => $id,
            ]),
            'Delete'
        );
    }

}
