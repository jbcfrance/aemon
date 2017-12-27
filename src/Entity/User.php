<?php
// src/Entity/User.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
* @ORM\Entity
* @UniqueEntity(fields="email", message="Email already taken")
* @UniqueEntity(fields="username", message="Username already taken")
*/
class User implements UserInterface
{
    /**
    * @ORM\Id
    * @ORM\Column(type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    private $id;

    /**
    * @ORM\Column(type="string", length=255, unique=true)
    * @Assert\NotBlank()
    * @Assert\Email()
    */
    private $email;

    /**
    * @ORM\Column(type="string", length=255, unique=true)
    * @Assert\NotBlank()
    */
    private $username;

    /**
    * @Assert\NotBlank()
    * @Assert\Length(max=4096)
    */
    private $plainPassword;

    /**
     * @ORM\Column(name="roles", type="string")
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $roles;

    /**
    * The below length depends on the "algorithm" you use for encoding
    * the password, but this works well with bcrypt.
    *
    * @ORM\Column(type="string", length=64)
    */
    private $password;

    /**
     * @ORM\Column(name="isValid")
     * @var string $isValid
     */
    private $isValid;

    /**
     * @return string
     */
    public function getIsValid(): string
    {
        return $this->isValid;
    }

    /**
     * @param string $isValid
     */
    public function setIsValid(string $isValid): void
    {
        $this->isValid = $isValid;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    // other properties and methods

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getSalt()
    {
        // The bcrypt algorithm doesn't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }

    // other methods, including security methods like getRoles()

    /**
     * Returns the roles granted to the user.
     *
     * @return  (Roles|string)[] The user roles
     */
    public function getRoles()
    {

        if (is_null($this->roles)) {
            $this->roles = ['ROLE_USER'];
        }

       return [$this->roles];
    }

    public function setRoles(Roles $roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {

    }
}