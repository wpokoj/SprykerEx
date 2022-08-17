<?php

namespace Pyz\Zed\Planet\Business\Reader;

use Generated\Shared\Transfer\MoonTransfer;
use Propel\Runtime\Collection\ObjectCollection;
use Pyz\Zed\Planet\Persistence\PlanetRepositoryInterface;

class MoonReader implements MoonReaderInterface {

    private PlanetRepositoryInterface $repo;

    public function __construct(PlanetRepositoryInterface $repo) {
        $this->repo = $repo;
    }

    public function getMoonById(int $id): ?MoonTransfer {
        return $this->repo->findMoonById($id);
    }

    public function getMoons(): ObjectCollection {
       return $this->repo->findMoons();
    }
}
