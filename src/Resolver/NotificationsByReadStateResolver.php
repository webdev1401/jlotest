<?php
namespace App\Resolver;

use ApiPlatform\GraphQl\Resolver\QueryCollectionResolverInterface;
use App\Repository\NotificationRepository;

class NotificationsByReadStateResolver implements QueryCollectionResolverInterface
{

    public function __construct(
        private NotificationRepository $notificationRepository
        ) {}

    public function __invoke(iterable $collection, array $context): iterable
    {
        return $this->notificationRepository->findByLu($context['args']['lu']);
    }
}