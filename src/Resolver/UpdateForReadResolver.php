<?php
namespace App\Resolver;

use App\Entity\Notification;
use ApiPlatform\GraphQl\Resolver\MutationResolverInterface;

class UpdateForReadResolver implements MutationResolverInterface
{

    /**
     * Undocumented function
     *
     * @param Notification|null $item
     * @param array $context
     * @return Notification|null
     */
    public function __invoke(?object $item, array $context): ?object
    { 
        $item->setLu(true);
        
        return $item;
    }
    
}