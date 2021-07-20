<?php

namespace App\Entity;

use App\Repository\TodolistRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TodolistRepository::class)
 */
class Todolist
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $body;

    // Getters & Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle() 
    {
        return $this->title;
    }

    public function setTitle($title) 
    {
        $this->title = $title;
    }
    
    public function getBody() 
    {
        return $this->body;
    }

    public function setBody($body) 
    {
        $this->body = $body;
    }
}
