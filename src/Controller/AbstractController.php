<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as BaseAbstractController;
use Symfony\Component\HttpFoundation\Request;

class AbstractController extends BaseAbstractController
{
    public const SUCCESS = 'success';
    public const ERROR = 'error';
    public const HOME_ROUTE_NAME = 'dashboard';

    public function redirectToReferer(Request $request) {

        $referer = $request->headers->get('referer');
        if (null === $referer) {
            $this->redirectToRoute(self::HOME_ROUTE_NAME);
        }

        $absolutePath = explode($request->headers->get('host'), $request->headers->get('referer'))[1];
        $absolutePath = filter_var($absolutePath, FILTER_SANITIZE_URL);

        return $this->redirect($absolutePath);
    }
}
