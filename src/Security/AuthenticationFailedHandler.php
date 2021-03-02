<?php


namespace App\Security;


use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationFailureHandler;
use Symfony\Component\Security\Http\HttpUtils;

class AuthenticationFailedHandler extends DefaultAuthenticationFailureHandler
{
    private $flashBag;
    public function __construct(HttpKernelInterface $httpKernel, HttpUtils $httpUtils, array $options = [], LoggerInterface $logger, FlashBagInterface $flashBag)
    {
        parent::__construct($httpKernel, $httpUtils, $options, $logger);
        $this->flashBag = $flashBag;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $this->flashBag->add('error', 'Undefined Login or Password !');
        return parent::onAuthenticationFailure($request, $exception);
    }

}