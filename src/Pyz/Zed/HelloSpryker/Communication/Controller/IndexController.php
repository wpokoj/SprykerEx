<?php

namespace Pyz\Zed\HelloSpryker\Communication\Controller;

use Propel\Runtime\Exception\PropelException;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Generated\Shared\Transfer\HelloSprykerTransfer;

/**
+ * @method \Pyz\Zed\HelloSpryker\Business\HelloSprykerFacadeInterface getFacade()
+ */
class IndexController extends AbstractController
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function indexAction(Request $request)
    {
        $helloSprykerTransfer = new HelloSprykerTransfer();
        $helloSprykerTransfer->setOriginalString("Hello Spryker!");

        $helloSprykerTransfer = $this->getFacade()->reverseString($helloSprykerTransfer);

        try {
            // Create new row in DB.
            $helloSprykerTransfer = $this->getFacade()->createHelloSprykerEntity($helloSprykerTransfer);

;
            // Retrieve data from DB.
            $helloSprykerTransfer = $this->getFacade()->findHelloSpryker($helloSprykerTransfer);
        }
        catch(\Exception $e) {
            return ['string' => $e->getMessage()];
        }

        return ['string' => $helloSprykerTransfer->getReversedString()];
    }
}

