<?php

namespace App\Order\Presentation\ArgumentResolver;

use App\Order\Domain\ValueObject\Order\User;
use App\Order\Domain\ValueObject\UserId;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Uid\Uuid;

class UserValueResolver implements ArgumentValueResolverInterface
{
    private ?Request $currentRequest;
    private HttpKernelInterface $httpKernel;

    public function __construct(RequestStack $requestStack, HttpKernelInterface $httpKernel)
    {
        $this->currentRequest = $requestStack->getCurrentRequest();
        $this->httpKernel = $httpKernel;
    }

    public function supports(Request $request, ArgumentMetadata $argument) : bool
    {
        if (User::class !== $argument->getType()) {
            return false;
        }

        return true;
    }

    public function resolve(Request $request, ArgumentMetadata $argument) : iterable
    {
        $path['_controller'] = 'App\User\Presentation\Controller\UserController::user';
        $subRequest = $this->currentRequest->duplicate([], null, $path);
        $response = json_decode(
            $this->httpKernel->handle($subRequest, HttpKernelInterface::SUB_REQUEST)->getContent(), true
        );
        $userName = [
            'firstName' => $response['firstName'],
            'lastName' => $response['lastName']
        ];

        yield new User(new UserId(Uuid::fromString($response['id'])), $userName);
    }
}