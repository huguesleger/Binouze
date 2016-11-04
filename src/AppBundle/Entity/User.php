<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="pass", type="string", length=255)
     */
    private $pass;

    /**
     * @var array
     *
     * @ORM\Column(name="role", type="array")
     */
    private $role;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom($nom) {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Set pass
     *
     * @param string $pass
     *
     * @return User
     */
    public function setPass($pass) {
        $this->pass = $pass;

        return $this;
    }

    /**
     * Get pass
     *
     * @return string
     */
    public function getPass() {
        return $this->pass;
    }

    /**
     * Set role
     *
     * @param array $role
     *
     * @return User
     */
    public function setRole($role) {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return array
     */
    public function getRole() {
        return $this->role;
    }

    public function eraseCredentials() {
        
    }

    public function getPassword() {
        return $this->pass;
    }

    public function getRoles() {
        return $this->role;
    }

    public function getSalt() {
        
    }

    public function getUsername() {
        return $this->nom;
    }

    public function serialize() {
        return serialize(array(
            $this->id,
            $this->nom,
            $this->pass,
        ));
    }

    public function unserialize($serialized) {
        list(
            $this->id,
            $this->nom,
            $this->pass,
            ) = unserialize($serialized);
    }

}
