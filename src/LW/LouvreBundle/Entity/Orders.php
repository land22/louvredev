<?php

namespace LW\LouvreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use LW\LouvreBundle\Validators\SoldDaysConstraint;

/**
 * Orders
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="LW\LouvreBundle\Repository\OrdersRepository")
 */
class Orders
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_date", type="date", nullable=true)
     */
    private $createdDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="visite_date", type="date", nullable=true)
     * @SoldDaysConstraint()
     */
    private $visiteDate;
    

    /**
     * @var string
     *
     * @ORM\Column(name="type_order", type="string", length=15)
     */
    private $typeOrder;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="code_reservation", type="string", length=10)
     */
    private $codeReservation;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=30)
     */
    private $email;
    
    /**
     *@ORM\OneToMany(targetEntity="LW\LouvreBundle\Entity\Tickets", mappedBy="orders", cascade={"persist", "remove"})
     *
     * 
     */
    private $tickets;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return Orders
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set visiteDate
     *
     * @param \DateTime $visiteDate
     *
     * @return Orders
     */
    public function setVisiteDate($visiteDate)
    {
        $this->visiteDate = $visiteDate;

        return $this;
    }

    /**
     * Get visiteDate
     *
     * @return \DateTime
     */
    public function getVisiteDate()
    {
        return $this->visiteDate;
    }

    /**
     * Set typeOrder
     *
     * @param string $typeOrder
     *
     * @return Orders
     */
    public function setTypeOrder($typeOrder)
    {
        $this->typeOrder = $typeOrder;

        return $this;
    }

    /**
     * Get typeOrder
     *
     * @return string
     */
    public function getTypeOrder()
    {
        return $this->typeOrder;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Orders
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set codeReservation
     *
     * @param string $codeReservation
     *
     * @return Orders
     */
    public function setCodeReservation($codeReservation)
    {
        $this->codeReservation = $codeReservation;

        return $this;
    }

    /**
     * Get codeReservation
     *
     * @return string
     */
    public function getCodeReservation()
    {
        return $this->codeReservation;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Orders
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tickets = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ticket
     *
     * @param \LWLouvreBundle\Entity\Ticket $ticket
     *
     * @return Orders
     */
   /* public function addTicket(\LWLouvreBundle\Entity\Ticket $ticket)
    {
        $this->tickets[] = $ticket;
        $ticket->setOrder($this);

        return $this;
    }*/

    /**
     * Remove ticket
     *
     * @param \LWLouvreBundle\Entity\Ticket $ticket
     */
    public function removeTicket($ticket)
    {
        var_dump($ticket);
        die();
        $this->tickets->removeElement($ticket);
    }

    /**
     * Get tickets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTickets()
    {
        return $this->tickets;
    }
}
