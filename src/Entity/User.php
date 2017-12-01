<?php

namespace Entity;

use Symfony\Component\Security\Core\User\UserInterface;
/**
 * Description of User
 *
 * @author Etudiant
 */
class User implements UserInterface
{
    
    /**
     * Primary key for user
     * @var integer
     */
    private $id;
    
    /**
     * Username of the user
     * @var string 
     */
    private $username;
    
    /**
     *Password of the user
     * @var string 
     */
    private $password;
    
    /**
     * Email of the user
     * @var string 
     */
    private $email;
    
    /**
     * Last name of the user
     * @var string 
     */
    private $lastname;
    
    /**
     * First name of the user
     * @var string 
     */
    private $firstname;
    
    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }
    
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function eraseCredentials() {
        $this->setPassword(NULL);
    }

    public function getRoles() {
        
    }

    public function getSalt() {
        
    }

}
