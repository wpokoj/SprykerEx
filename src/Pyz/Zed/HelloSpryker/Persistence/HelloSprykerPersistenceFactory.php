<?php

namespace Pyz\Zed\HelloSpryker\Persistence;

use Orm\Zed\HelloSpryker\Persistence\PyzHelloSprykerQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class HelloSprykerPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return PyzHelloSprykerQuery
     */
    public function createHelloSprykerQuery(): PyzHelloSprykerQuery
    {
        return PyzHelloSprykerQuery::create();
    }
}
