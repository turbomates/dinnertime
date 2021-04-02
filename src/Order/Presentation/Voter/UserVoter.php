<?php

namespace App\Order\Presentation\Voter;

use App\Order\Domain\Order;
use App\User\Domain\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class UserVoter extends Voter
{
    private const CAN_PAY = 'CAN_PAY';

    protected function supports(string $attribute, $subject) : bool
    {
        if (!in_array($attribute, [self::CAN_PAY])) {
            return false;
        }
        if (!$subject instanceof Order) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token) : bool
    {
        $user = $token->getUser();
        if (!$user instanceof User){
            return false;
        }
        $order = $subject;
        switch ($attribute){
            case self::CAN_PAY:
                return $this->canPay($order, $user);
        }

        throw new \LogicException('Access is denied');
    }

    private function canPay(Order $order, User $user) : bool
    {
        return  $user->id()->id()->equals($order->orderUser()->id()->id());
    }
}