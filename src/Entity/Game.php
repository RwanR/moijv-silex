<?php

namespace Entity;

/**
 * Description of Game
 *
 * @author Etudiant
 */
class Game 
{
    /**
     *
     * @var int
     */
    private $id;
    
    /**
     *
     * @var string 
     */
    private $title;
    
    /**
     *
     * @var string 
     */
    private $image;
    
    /**
     *
     * @var \Entity\User 
     */
    private $user;
    
    /**
     *
     * @var \Entity\Category 
     */
    private $category;
    
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getImage() {
        return $this->image;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getUser() {
        return $this->user;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setUser(\Entity\User $user) {
        $this->user = $user;
    }

    public function setCategory(\Entity\Category $category) {
        $this->category = $category;
    }


    
}
