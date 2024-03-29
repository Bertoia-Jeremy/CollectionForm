<?php

declare(strict_types=1);
// Temps de la vidéo lors de l'arrêt => 27:00,  //42:33  //1:00:55 //1:30:40
//Vidéo => Symfony 5 - Gérer une collection dans un formulaire
namespace App\Entity;

use App\Repository\FooRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=FooRepository::class)
 */
class Foo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @var Collection<int, Bar>
     * @ORM\OneToMany(targetEntity=Bar::class, mappedBy="foo", orphanRemoval=true, cascade={"persist"})
     * @Assert\Count(min = 1)
     * @Assert\Valid
     */
    private $bars;

    /**
     * @var Collection<int, Baz>
     * @ORM\OneToMany(targetEntity=Baz::class, mappedBy="foo", orphanRemoval=true, cascade={"persist"})
     * @Assert\Count(min = 1)
     * @Assert\Valid
     */
    private $bazs;

    public function __construct()
    {
        $this->bars = new ArrayCollection();
        $this->bazs = new ArrayCollection();
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

    /**
     * @return Collection<int, Bar>
     */
    public function getBars(): Collection
    {
        return $this->bars;
    }

    public function addBar(Bar $bar): self
    {
        if (!$this->bars->contains($bar)) {
            $this->bars[] = $bar;
            $bar->setFoo($this);
        }

        return $this;
    }

    public function removeBar(Bar $bar): self
    {
        if ($this->bars->removeElement($bar)) {
            // set the owning side to null (unless already changed)
            if ($bar->getFoo() === $this) {
                $bar->setFoo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Baz>
     */
    public function getBazs(): Collection
    {
        return $this->bazs;
    }

    public function addBaz(Baz $baz): self
    {
        if (!$this->bazs->contains($baz)) {
            $this->bazs[] = $baz;
            $baz->setFoo($this);
        }

        return $this;
    }

    public function removeBaz(Baz $baz): self
    {
        if ($this->bazs->removeElement($baz)) {
            // set the owning side to null (unless already changed)
            if ($baz->getFoo() === $this) {
                $baz->setFoo(null);
            }
        }

        return $this;
    }
}
