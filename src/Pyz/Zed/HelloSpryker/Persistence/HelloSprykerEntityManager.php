<?php

namespace Pyz\Zed\HelloSpryker\Persistence;

use Generated\Shared\Transfer\HelloSprykerTransfer;
use Orm\Zed\HelloSpryker\Persistence\PyzHelloSpryker;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \Pyz\Zed\HelloSpryker\Persistence\HelloSprykerPersistenceFactory getFactory()
 */
class HelloSprykerEntityManager extends AbstractEntityManager implements HelloSprykerEntityManagerInterface
{
    /**
     * @param HelloSprykerTransfer $helloSprykerTransfer
     *
     * @return HelloSprykerTransfer
     */
    public function saveHelloSprykerEntity(HelloSprykerTransfer $helloSprykerTransfer): HelloSprykerTransfer
    {
        $helloSprykerEntity = new PyzHelloSpryker();
        $helloSprykerEntity->fromArray($helloSprykerTransfer->modifiedToArray());
        $helloSprykerEntity->save();

        $helloSprykerTransfer->fromArray($helloSprykerEntity->toArray(), true);

        return $helloSprykerTransfer;
    }
}
