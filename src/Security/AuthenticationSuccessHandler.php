<?php


namespace App\Security;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use \Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationSuccessHandler;
use Symfony\Component\Security\Http\HttpUtils;


class AuthenticationSuccessHandler
    extends DefaultAuthenticationSuccessHandler
    implements AuthenticationSuccessHandlerInterface
{
    private $flashBag;

    public function __construct(HttpUtils $httpUtils, array $options = [], FlashBagInterface $flashBag)
    {
        parent::__construct($httpUtils, $options);
        $this->flashBag = $flashBag;
    }
    /**
     * @inheritDoc
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $this->flashBag->add('success', 'Welcome you are logged in');
        return parent::onAuthenticationSuccess($request, $token);
    }
}