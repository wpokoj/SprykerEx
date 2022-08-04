<?php

namespace Pyz\Zed\HelloSpryker\Business;

use Pyz\Zed\HelloSpryker\Business\HelloSprykerFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractFacade;
use Generated\Shared\Transfer\HelloSprykerTransfer;

/**
 * @method \Pyz\Zed\HelloSpryker\Business\HelloSprykerBusinessFactory getFactory()
 */
class HelloSprykerFacade extends AbstractFacade implements HelloSprykerFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
    -     * @param string $stringToReverse
    +     * @param \Generated\Shared\Transfer\HelloSprykerTransfer $helloSprykerTransfer
     *
    -     * @return string
    +     * @return \Generated\Shared\Transfer\HelloSprykerTransfer
     */

    public function reverseString(HelloSprykerTransfer $helloSprykerTransfer): HelloSprykerTransfer
    {
        return $this->getFactory()
                ->createStringReverser()
                ->reverseString($helloSprykerTransfer);
   }

    /**
     * @inheritDoc
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\HelloSprykerTransfer $helloSprykerTransfer
     *
     * @return \Generated\Shared\Transfer\HelloSprykerTransfer
     */
    public function createHelloSprykerEntity(HelloSprykerTransfer $helloSprykerTransfer): HelloSprykerTransfer
    {
        return $this->getFactory()->createStringWriter()->createHelloSprykerEntity($helloSprykerTransfer);
    }

    /**
     * @inheritDoc
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\HelloSprykerTransfer $helloSprykerTransfer
     *
     * @return \Generated\Shared\Transfer\HelloSprykerTransfer
     */
    public function findHelloSpryker(HelloSprykerTransfer $helloSprykerTransfer): HelloSprykerTransfer
    {
        return $this->getFactory()->createStringReader()->findHelloSpryker($helloSprykerTransfer);
    }
}
