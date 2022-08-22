<?php

namespace Pyz\Zed\StringReverser\Business;

use Generated\Shared\Transfer\HelloSprykerTransfer;
use Generated\Shared\Transfer\StringReverserTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method StringReverserFactory getFactory()
 */
class StringReverserFacade extends AbstractFacade implements StringReverserFacadeInterface {

    public function reverseString(StringReverserTransfer $trans): StringReverserTransfer {

        return $this->getFactory()->getReverser()->reverse($trans);
    }
}
