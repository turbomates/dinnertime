<?php

namespace App\User\Infrastructure\Security;

use App\Core\Infrastructure\Repository\UserRepositoryInterface;
use App\User\Domain\User;
use App\User\Domain\ValueObject\Email;
use App\User\Domain\ValueObject\Name;
use Doctrine\ORM\EntityManagerInterface;
use KnpU\OAuth2ClientBundle\Client\OAuth2ClientInterface;
use KnpU\OAuth2ClientBundle\Security\Authenticator\SocialAuthenticator;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use League\OAuth2\Client\Provider\GoogleUser;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use League\OAuth2\Client\Token\AccessToken;

class GoogleAuthenticator extends SocialAuthenticator
{
    private ClientRegistry $clientRegistry;
    private EntityManagerInterface $em;
    private RouterInterface $router;
    private UserRepositoryInterface $repository;

    public function __construct(ClientRegistry $clientRegistry, EntityManagerInterface $em, RouterInterface $router, UserRepositoryInterface $repository)
    {
        $this->clientRegistry = $clientRegistry;
        $this->em = $em;
        $this->router = $router;
        $this->repository = $repository;
    }

    public function supports(Request $request) : bool
    {
        return $request->attributes->get('_route') === 'connect_google_check';
    }

    public function getCredentials(Request $request) : AccessToken
    {
        return $this->fetchAccessToken($this->getGoogleClient());
    }

    public function getUser($credentials, UserProviderInterface $userProvider) : User
    {
        /** @var GoogleUser $googleUser */
        $googleUser = $this->getGoogleClient()->fetchUserFromToken($credentials);
        $email = $googleUser->getEmail();
        $user = $this->repository->findByEmail(new Email($email));
        if (!$user){
            $user = User::create(new Email($email), new Name($googleUser->getFirstName(), $googleUser->getLastName()));
        }
        $this->repository->persist($user);
        $this->em->flush();

        return $user;
    }

    public function getGoogleClient() : OAuth2ClientInterface
    {
        return $this->clientRegistry->getClient('google');
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey) : RedirectResponse
    {
        $targetUrl = $this->router->generate('app_homepage');

        return new RedirectResponse($targetUrl);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception) : Response
    {
        $message = strtr($exception->getMessageKey(), $exception->getMessageData());

        return new Response($message, Response::HTTP_FORBIDDEN);
    }

    public function start(Request $request, AuthenticationException $authException = null) : RedirectResponse
    {
        return new RedirectResponse('/connect/google', Response::HTTP_TEMPORARY_REDIRECT);
    }
}