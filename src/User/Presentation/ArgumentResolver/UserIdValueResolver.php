<?php

namespace App\User\Presentation\ArgumentResolver;

use App\User\Domain\ValueObject\UserId;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Security\Core\Security;

class UserIdValueResolver implements ArgumentValueResolverInterface
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function supports(Request $request, ArgumentMetadata $argument) : bool
    {
        if (UserId::class !== $argument->getType()) {
            return false;
        }

        return $this->security->getUser()->id() instanceof UserId;
    }

    public function resolve(Request $request, ArgumentMetadata $argument) : iterable
    {
        yield $this->security->getUser()->id();
    }
}