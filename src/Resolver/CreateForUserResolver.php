<?php
namespace App\Resolver;

use App\Entity\Notification;
use ApiPlatform\GraphQl\Resolver\MutationResolverInterface;
use App\Entity\Notifiable;
use Doctrine\ORM\EntityManagerInterface;

class CreateForUserResolver implements MutationResolverInterface
{

    public function __construct(private EntityManagerInterface $manager)
    {
    }

    /**
     * Create notification object
     *
     * @param Notification|null $item
     * @param array $context
     * @return Notification|null
     */
    public function __invoke(?object $notification, array $context): ?object
    { 
        $notification
            ->setType($context['args']['input']['type'])
            ->setDescription($context['args']['input']['description'])
            ->setSujet($context['args']['input']['sujet'])
            ->setLu(false)
            ->setAction($context['args']['input']['action'] ?? null);

        $this->manager->persist($notification);
        $this->manager->flush();

        foreach ($context['args']['input']['userid'] as $userId) {
            $notifiable = (new Notifiable)
            ->setNotifiableId($userId)
            ->setNotifiableType('User')
            ->setNotification($notification);
    
            $this->manager->persist($notifiable);
            $this->manager->flush();
        }

        return $notification;
    }
    
}