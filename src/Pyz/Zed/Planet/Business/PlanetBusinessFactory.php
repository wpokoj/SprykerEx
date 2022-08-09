<?php

namespace Pyz\Zed\Planet\Business;

use Pyz\Zed\Planet\Business\Writer\PlanetWriter;
use Pyz\Zed\Planet\Business\Writer\PlanetWriterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class PlanetBusinessFactory extends AbstractBusinessFactory {

    public function createPlanetWriter() : PlanetWriterInterface {

        return new PlanetWriter($this->getEntityManager());
    }
}
