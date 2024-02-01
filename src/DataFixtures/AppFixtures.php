<?php

namespace App\DataFixtures;

use App\Entity\Notifiable;
use App\Entity\Notification;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $type = ['LINK', 'CLICK', 'NONE'];
        for ($i = 0; $i < 20; $i++) {
            $userId = rand(1, 15);
            $notification = (new Notification())
            ->setType($type[rand(0,2)])
            ->setSujet($faker->sentence())
            ->setDescription($faker->sentence())
            ->setLu(rand(0, 1));
            
            $manager->persist($notification);
            $manager->flush();
            
            $notifiable = (new Notifiable())
            ->setNotification($notification)
            ->setNotifiableId($userId)
            ->setNotifiableType('User');
            
            $manager->persist($notifiable);
            $manager->flush();
        }

    }
}
