<?php

namespace Pyz\Zed\Planet\Business;

use Pyz\Zed\Planet\Business\Deleter\PlanetDeleter;
use Pyz\Zed\Planet\Business\Deleter\PlanetDeleterInterface;
use Pyz\Zed\Planet\Business\Editor\PlanetEditor;
use Pyz\Zed\Planet\Business\Editor\PlanetEditorInterface;
use Pyz\Zed\Planet\Business\Reader\PlanetReader;
use Pyz\Zed\Planet\Business\Reader\PlanetReaderInterface;
use Pyz\Zed\Planet\Business\Writer\PlanetWriter;
use Pyz\Zed\Planet\Business\Writer\PlanetWriterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class PlanetBusinessFactory extends AbstractBusinessFactory {

    public function createPlanetWriter() : PlanetWriterInterface {

        return new PlanetWriter($this->getEntityManager());
    }

    public function createPlanetEditor(): PlanetEditorInterface {

        return new PlanetEditor($this->getEntityManager());
    }

    public function createPlanetReader(): PlanetReaderInterface {

        return new PlanetReader($this->getRepository());
    }

    public function createPlanetDeleter(): PlanetDeleterInterface {

        return new PlanetDeleter($this->getEntityManager());
    }

}
