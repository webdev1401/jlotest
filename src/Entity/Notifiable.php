<?php

namespace App\Entity;

use App\Repository\NotifiableRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NotifiableRepository::class)]
class Notifiable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $notifiableId = null;

    #[ORM\Column(length: 255)]
    private ?string $notifiableType = null;

    #[ORM\ManyToOne(inversedBy: 'notifiable')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Notification $notification = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNotifiableId(): ?int
    {
        return $this->notifiableId;
    }

    public function setNotifiableId(int $notifiableId): static
    {
        $this->notifiableId = $notifiableId;

        return $this;
    }

    public function getNotifiableType(): ?string
    {
        return $this->notifiableType;
    }

    public function setNotifiableType(string $notifiableType): static
    {
        $this->notifiableType = $notifiableType;

        return $this;
    }

    public function getNotification(): ?Notification
    {
        return $this->notification;
    }

    public function setNotification(?Notification $notification): static
    {
        $this->notification = $notification;

        return $this;
    }
}
