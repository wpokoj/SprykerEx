<?php

namespace Pyz\Zed\PlanetSearch\Business;

use Pyz\Zed\PlanetSearch\Business\Deleter\PlanetSearchDeleter;
use Pyz\Zed\PlanetSearch\Business\Updater\PlanetSearchUpdater;
use Pyz\Zed\PlanetSearch\Business\Writer\PlanetSearchWriter;

class PlanetSearchBusinessFactory {

    public function createPlanetSearchWriter(): PlanetSearchWriter {
        return new PlanetSearchWriter();
    }

    public function createPlanetSearchUpdater(): PlanetSearchUpdater {
        return new PlanetSearchUpdater();
    }

    public function createPlanetSearchDeleter(): PlanetSearchDeleter {
        return new PlanetSearchDeleter();
    }

}
