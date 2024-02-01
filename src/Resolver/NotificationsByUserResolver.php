<?php
namespace App\Resolver;

use App\Repository\NotifiableRepository;
use ApiPlatform\GraphQl\Resolver\QueryCollectionResolverInterface;

class NotificationsByUserResolver implements QueryCollectionResolverInterface
{

    public function __construct(
        private NotifiableRepository $notifiableRepository
        ) {}

    public function __invoke(iterable $collection, array $context): iterable
    {
        $notifiables = $this->notifiableRepository->findByNotifiableId($context['args']['users']);
        $notifications = [];

        foreach ($notifiables as $notifable) {
            $notifications[] = $notifable->getNotification();
        }
        return $notifications;
    }
}