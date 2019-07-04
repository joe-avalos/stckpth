<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BBCounterRepository")
 */
class BBCounter
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $countNum = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountNum(): ?int
    {
        return $this->countNum;
    }

    public function setCountNum(int $countNum): self
    {
        $this->countNum = $countNum;

        return $this;
    }
}
