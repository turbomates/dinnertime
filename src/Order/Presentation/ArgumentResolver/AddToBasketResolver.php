<?php

namespace App\Order\Presentation\ArgumentResolver;

use App\Order\Application\Command\AddToBasket;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\SerializerInterface;

class AddToBasketResolver implements ArgumentValueResolverInterface
{
    private  SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function supports(Request $request, ArgumentMetadata $argument) : bool
    {
        if (AddToBasket::class !== $argument->getType()) {
            return false;
        }

        return true;
    }

    public function resolve(Request $request, ArgumentMetadata $argument) : iterable
    {
        yield $this->serializer->deserialize($request->getContent(), AddToBasket::class,'json');
    }
}