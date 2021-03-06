<?php
declare (strict_types = 1);
namespace CodeEmailMKT\Domain\Entity;

class User
{

    private $id;

    private $name;

    private $email;

    private $password;

    private $plainPassword;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword(string $plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    public function generatePassword()
    {
        $password = $this->getPlainPassword() ?? uniqid();
        $this->setPassword(password_hash($password, PASSWORD_BCRYPT));
    }
}
