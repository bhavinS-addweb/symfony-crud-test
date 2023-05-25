<?php

namespace App\Entity;

use App\Config\UserTypeEnum;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation\Timestampable;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?UserTypeEnum $type_id = null;

    #[ORM\Column]
    #[Timestampable([],'create')]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    #[Timestampable()]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?PlayerTeam $playerTeam = null;

    #[ORM\OneToMany(mappedBy: 'manager', targetEntity: PlayerTeam::class)]
    private Collection $playerTeams;

    public function __construct()
    {
        $this->playerTeams = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function isTypeId(): ?UserTypeEnum
    {
        return $this->type_id;
    }

    public function setTypeId(UserTypeEnum $type_id): self
    {
        $this->type_id = $type_id;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPlayerTeam(): ?PlayerTeam
    {
        return $this->playerTeam;
    }

    public function setPlayerTeam(PlayerTeam $playerTeam): self
    {
        // set the owning side of the relation if necessary
        if ($playerTeam->getUser() !== $this) {
            $playerTeam->setUser($this);
        }

        $this->playerTeam = $playerTeam;

        return $this;
    }

    /**
     * @return Collection<int, PlayerTeam>
     */
    public function getPlayerTeams(): Collection
    {
        return $this->playerTeams;
    }

    public function addPlayerTeam(PlayerTeam $playerTeam): self
    {
        if (!$this->playerTeams->contains($playerTeam)) {
            $this->playerTeams->add($playerTeam);
            $playerTeam->setManager($this);
        }

        return $this;
    }

    public function removePlayerTeam(PlayerTeam $playerTeam): self
    {
        if ($this->playerTeams->removeElement($playerTeam)) {
            // set the owning side to null (unless already changed)
            if ($playerTeam->getManager() === $this) {
                $playerTeam->setManager(null);
            }
        }

        return $this;
    }
}
