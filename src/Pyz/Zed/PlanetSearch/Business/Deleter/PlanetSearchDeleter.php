<?php

namespace Pyz\Zed\PlanetSearch\Business\Deleter;

use Orm\Zed\PlanetSearch\Persistence\PyzPlanetSearchQuery;

class PlanetSearchDeleter {

    public function delete(int $id): void {

        PyzPlanetSearchQuery::create()
            ->filterByFkPlanet($id)
            ->delete();
    }
}
