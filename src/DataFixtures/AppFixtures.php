<?php

namespace App\DataFixtures;

use App\Entity\Notification;
use App\Entity\NotificationUser;
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
            $notification = (new Notification)
            ->setType($type[rand(0,2)])
            ->setSujet($faker->sentence())
            ->setDescription($faker->sentence());
            
            $notificationUser = (new NotificationUser)
            ->setNotificationId($notification->getId())
            ->setUserId(rand(1, 15));

            $manager->persist($notification);
            $manager->persist($notificationUser);
        }

        $manager->flush();
    }
}
