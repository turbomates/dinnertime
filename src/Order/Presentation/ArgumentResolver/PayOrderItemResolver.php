<?php

namespace App\Order\Presentation\ArgumentResolver;

use App\Order\Application\Command\PayOrderItem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\SerializerInterface;

class PayOrderItemResolver implements ArgumentValueResolverInterface
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function supports(Request $request, ArgumentMetadata $argument) : bool
    {
        if (PayOrderItem::class !== $argument->getType()) {
            return false;
        }

        return true;
    }

    public function resolve(Request $request, ArgumentMetadata $argument) : iterable
    {
        yield $this->serializer->deserialize($request->getContent(), PayOrderItem::class, 'json');
    }
}