<?php


namespace Model;


use Symfony\Component\Serializer\Annotation\SerializedName;

class Person
{
    private $age;
    private $name;
    private $sportsperson;
    private $createdAt;

    /**
     * @SerializedName("customer_name")
     */
    private $firstName;

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function __construct($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function isSportsperson()
    {
        return $this->sportsperson;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function setSportsperson($sportsperson)
    {
        $this->sportsperson = $sportsperson;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
}