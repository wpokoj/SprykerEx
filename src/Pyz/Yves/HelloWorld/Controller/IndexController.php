<?php

namespace Pyz\Yves\HelloWorld\Controller;

use Spryker\Yves\Kernel\Controller\AbstractController;
use Spryker\Yves\Kernel\View\View;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends AbstractController
{
    /**
     * @param Request $request
     *
     * @return View
     */
    public function indexAction(Request $request): View {
        $data = ['helloWorld' => 'Silent Revelations by Leprous is amazing!'];

        return $this->view(
            $data,
            [],
            '@HelloWorld/views/index/index.twig'
        );
    }
}

