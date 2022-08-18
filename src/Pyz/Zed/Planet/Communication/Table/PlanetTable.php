<?php

namespace Pyz\Zed\Planet\Communication\Table;

use Generated\Shared\Transfer\MoonTransfer;
use Generated\Shared\Transfer\PlanetTransfer;
use Generated\Shared\Transfer\PyzMoonEntityTransfer;
use Generated\Shared\Transfer\PyzPlanetEntityTransfer;
use Orm\Zed\Planet\Persistence\Map\PyzMoonTableMap;
use Orm\Zed\Planet\Persistence\Map\PyzPlanetTableMap;
use Orm\Zed\Planet\Persistence\PyzMoon;
use Orm\Zed\Planet\Persistence\PyzMoonQuery;
use Pyz\Zed\Planet\Persistence\PlanetRepository;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;
use Orm\Zed\Planet\Persistence\PyzPlanetQuery;
use Spryker\Zed\ProductRelationGui\Communication\Controller\DeleteController;
use Spryker\Zed\ProductRelationGui\Communication\Controller\ViewController;

class PlanetTable extends AbstractTable {

    const COL_ACTIONS = 'Actions';
    const COL_MOONS = 'Moons';

    /** @var PyzPlanetQuery
     */
    private PyzPlanetQuery $planetQuery;

    /** @var PyzMoonQuery
     */
    private PyzMoonQuery $moonQuery;
    /**
     * @param PyzPlanetQuery $planetQuery
     * @param PyzMoonQuery $moonQuery
     */
    public function __construct(PyzPlanetQuery $planetQuery, PyzMoonQuery $moonQuery) {
        $this->planetQuery = $planetQuery;
        $this->moonQuery = $moonQuery;
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
            static::COL_MOONS => static::COL_MOONS,
            static::COL_ACTIONS => static::COL_ACTIONS,
        ]);

        $config->setSortable([
            PyzPlanetTableMap::COL_ID_PLANET,
            PyzPlanetTableMap::COL_NAME,
            PyzPlanetTableMap::COL_INTERESTING_FACT,
        ]);

        $config->setSearchable([
            PyzPlanetTableMap::COL_NAME,
        ]);

        $config->setRawColumns([
            static::COL_ACTIONS,
            static::COL_MOONS,
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
            $this->planetQuery,
            $config
        );

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
                static::COL_MOONS => //'',
                    $this->createMoonDropdown($planetDataItem[PyzPlanetTableMap::COL_ID_PLANET]),
                static::COL_ACTIONS =>
                    $this->generateActions($planetDataItem[PyzPlanetTableMap::COL_ID_PLANET]),
            ];
        }

        return $planetTableRows;

        //return $this->runQuery($this->planetQuery, $config);
    }

    protected function createMoonDropdown(int $planetId): string {

        try {
            // Since tables are allowed to interact with Persistence layer
            // this should be legal
            $this->moonQuery->clear();
            $data = $this->moonQuery->filterByIdPlanet($planetId)->find();

            if(count($data->getData()) === 0) {
                return '';
            }

            $list = '<select>';

            foreach ($data->getData() as $moon) {
                $list = $list.'<option>'.($moon)->getName().'</option>';
            }

            return $list.'</select>';
        } // just in case
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    protected function generateActions(int $id): string {

        return implode(' ', [
            $this->createEditButton($id),
            $this->createDeleteButton($id),
        ]);
    }

    /**
     * @param int $idProductRelation
     *
     * @return string
     */
    protected function createEditButton(int $id): string {
        return $this->generateEditButton(
            Url::generate(
                '/planet/edit/index', [
                    'id-planet' => $id,
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
                '/planet/delete/index', [
                'id-planet' => $id,
            ]),
            'Delete'
        );
    }
}
