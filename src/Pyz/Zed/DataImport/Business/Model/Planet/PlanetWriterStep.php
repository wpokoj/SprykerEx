<?php

namespace Pyz\Zed\DataImport\Business\Model\Planet;

use Orm\Zed\Planet\Persistence\PyzPlanetQuery;
use Pyz\Zed\Planet\Dependency\PlanetEvents;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;



class PlanetWriterStep extends PublishAwareStep implements DataImportStepInterface {

    public const KEY_NAME = 'name';
    public const KEY_INTERESTING_FACT = 'interesting_fact';
    public const KEY_ORBIT_TIME = 'orbit_time';

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     * @throws \Spryker\Zed\DataImport\Business\Exception\EntityNotFoundException
     *
     */
    public function execute(DataSetInterface $dataSet)
    {
        $planetEntity = PyzPlanetQuery::create()
            ->filterByName($dataSet[static::KEY_NAME])
            ->findOneOrCreate();

        $planetEntity->setInterestingFact(
            $dataSet[static::KEY_INTERESTING_FACT]
        );

        $planetEntity->setOrbitTime(
            $dataSet[static::KEY_ORBIT_TIME]
        );

        if ($planetEntity->isNew() || $planetEntity->isModified()) {
            $planetEntity->save();
        }

        $this->addPublishEvents(PlanetEvents::ENTITY_PYZ_PLANET_CREATE, $planetEntity->getIdPlanet());
    }
}
