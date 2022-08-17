<?php

namespace Pyz\Zed\Planet\Business\Reader;

use Generated\Shared\Transfer\PlanetTransfer;
use Propel\Runtime\Collection\ObjectCollection;
use Pyz\Zed\Planet\Persistence\PlanetRepositoryInterface;

class PlanetReader implements PlanetReaderInterface {

    protected PlanetRepositoryInterface $repo;

    public function __construct(PlanetRepositoryInterface  $repo) {

        $this->repo = $repo;
    }

    public function getPlanetById(int $id): ?PlanetTransfer {

        return $this->repo->findPlanetById($id);
    }

    public function getPlanets() : ObjectCollection {

        return $this->repo->findPlanets();
    }
}
