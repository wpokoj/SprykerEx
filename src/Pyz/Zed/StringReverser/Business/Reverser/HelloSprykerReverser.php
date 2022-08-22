<?php

namespace Pyz\Zed\StringReverser\Business\Reverser;

use Generated\Shared\Transfer\HelloSprykerTransfer;
use Generated\Shared\Transfer\StringReverserTransfer;

class HelloSprykerReverser implements HelloSprykerReverserInterface {

    public function reverse(StringReverserTransfer $trans): StringReverserTransfer {

        $trans->setReversedString(
            strrev(
                $trans->getOriginalString()
            )
        );

        return $trans;
    }
}
