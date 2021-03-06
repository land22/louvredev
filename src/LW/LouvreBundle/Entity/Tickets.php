<?php

namespace LW\LouvreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="LW\LouvreBundle\Repository\TicketRepository")
 */
class Tickets {

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
     * @ORM\Column(name="firstname", type="string", length=20)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=20)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=20)
     */
    private $country;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date")
     */
    private $birthday;

    /**
     * @var float
     *
     * @ORM\Column(name="reduction", type="float", nullable=true)
     */
    private $reduction;

    /**
     * @ORM\Column(name="reduit", type="boolean")
     */
    private $reduit = true;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="LW\LouvreBundle\Entity\Orders", inversedBy="ticket")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $order;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Ticket
     */
    public function setFirstname($firstname) {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname() {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Ticket
     */
    public function setLastname($lastname) {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Ticket
     */
    public function setCountry($country) {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry() {
        return $this->country;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return Ticket
     */
    public function setBirthday($birthday) {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday() {
        return $this->birthday;
    }

    /**
     * Set reduction
     *
     * @param float $reduction
     *
     * @return Ticket
     */
    public function setReduction($reduction) {
        $this->reduction = $reduction;

        return $this;
    }

    /**
     * Get reduction
     *
     * @return float
     */
    public function getReduction() {
        return $this->reduction;
    }

    /**
     * Set reduit
     *
     * @param boolean $reduit
     *
     * @return Ticket
     */
    public function setReduit($reduit) {
        $this->reduit = $reduit;

        return $this;
    }

    /**
     * Get reduit
     *
     * @return boolean
     */
    public function getReduit() {
        return $this->reduit;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Ticket
     */
    public function setPrice($price) {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * Set order
     *
     * @param \LW\LouvreBundle\Entity\Orders $order
     *
     * @return Ticket
     */
    public function setOrder(\LW\LouvreBundle\Entity\Orders $order) {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \LW\LouvreBundle\Entity\Orders
     */
    public function getOrder() {
        return $this->order;
    }

}
