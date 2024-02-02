<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GraphQl\Query;
use App\Resolver\CreateForUserResolver;
use App\Resolver\UpdateForReadResolver;
use ApiPlatform\Metadata\GraphQl\Mutation;
use App\Repository\NotificationRepository;
use Doctrine\Common\Collections\Collection;
use App\Resolver\NotificationsByUserResolver;
use App\Resolver\NotificationsUnreadResolver;
use ApiPlatform\Metadata\GraphQl\DeleteMutation;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Metadata\GraphQl\QueryCollection;
use App\Resolver\NotificationsByReadStateResolver;

#[ORM\Entity(repositoryClass: NotificationRepository::class)]
#[ApiResource(
    graphQlOperations: [
        new Query(),
        new QueryCollection(),
        new Mutation(name: 'create'),
        new Mutation(name: 'update'),
        new DeleteMutation(name: 'delete'),
        new QueryCollection(
            name: 'notificationByUser',
            resolver: NotificationsByUserResolver::class,
            paginationEnabled: false,
            read: false,
            args: [
                'users' => ['type' => '[Int]!'],
            ]
        ),
        new QueryCollection(
            name: 'notificationByReadState',
            resolver: NotificationsByReadStateResolver::class,
            paginationEnabled: false,
            read: false,
            args: [
                'lu' => ['type' => 'Boolean!'],
            ]
        ),
        new QueryCollection(
            name: 'notificationUnread',
            resolver: NotificationsUnreadResolver::class,
            paginationEnabled: false,
            read: false,
        ),
        new Mutation(
            name: 'createForUser',
            resolver: CreateForUserResolver::class,
            write: false,
            args: [
                'userid' => ['type' => '[Int]!'],
                'type' => ['type' => 'String!'],
                'sujet' => ['type' => 'String!'],
                'description' => ['type' => 'String!'],
                'action' => ['type' => 'String'],
                'lu' => ['type' => 'Boolean'],
            ]
        ),
        new Mutation(
            name: 'updateForRead',
            resolver: UpdateForReadResolver::class,
            args: [
                'id' => ['type' => 'ID!'],
            ]
        )
    ]
)]
class Notification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $sujet = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $action = null;

    #[ORM\Column]
    private ?bool $lu = false;

    #[ORM\OneToMany(mappedBy: 'notification', targetEntity: Notifiable::class, orphanRemoval: true)]
    private Collection $notifiable;

    public function __construct()
    {
        $this->notifiable = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(string $sujet): static
    {
        $this->sujet = $sujet;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function setAction(?string $action): static
    {
        $this->action = $action;

        return $this;
    }

    public function isLu(): ?bool
    {
        return $this->lu;
    }

    public function setLu(bool $lu): static
    {
        $this->lu = $lu;

        return $this;
    }

    /**
     * @return Collection<int, Notifiable>
     */
    public function getNotifiable(): Collection
    {
        return $this->notifiable;
    }

    public function addNotifiable(Notifiable $notifiable): static
    {
        if (!$this->notifiable->contains($notifiable)) {
            $this->notifiable->add($notifiable);
            $notifiable->setNotification($this);
        }

        return $this;
    }

    public function removeNotifiable(Notifiable $notifiable): static
    {
        if ($this->notifiable->removeElement($notifiable)) {
            // set the owning side to null (unless already changed)
            if ($notifiable->getNotification() === $this) {
                $notifiable->setNotification(null);
            }
        }

        return $this;
    }
}
