<?php

namespace Pyz\Zed\StringReverser\Business;

use Pyz\Zed\StringReverser\Business\Reverser\HelloSprykerReverser;
use Pyz\Zed\StringReverser\Business\Reverser\HelloSprykerReverserInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class StringReverserBusinessFactory extends AbstractBusinessFactory {

    public function getReverser(): HelloSprykerReverserInterface {

        return new HelloSprykerReverser();
    }
}
