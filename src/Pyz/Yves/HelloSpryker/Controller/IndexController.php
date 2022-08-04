<?php

namespace Pyz\Yves\HelloSpryker\Controller;

use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Generated\Shared\Transfer\HelloSprykerTransfer;

/**
 * @method \Pyz\Client\HelloSpryker\HelloSprykerClientInterface getClient()
 */
class IndexController extends AbstractController
{
    /**
     * @param Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Spryker\Yves\Kernel\View\View
     */
    public function indexAction(Request $request)
    {
        $helloSprykerTransfer = new HelloSprykerTransfer();
        $helloSprykerTransfer->setOriginalString("Luminol - Steven Wilson is by far my fav track in his solo career");

        $helloSprykerTransfer = $this->getClient()->reverseString($helloSprykerTransfer);

        $data = ['reversedString' => $helloSprykerTransfer->getReversedString()];

        return $this->view(
            $data,
            [],
            '@HelloSpryker/views/index.twig'
        );
    }
}
