<?php

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Event
 * @package Application\Entity
 * @ORM\Entity
 * @ORM\Table(name="events")
 */
class Event 
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $location;

    /**
     * @var float
     * @ORM\Column(name="latitude", type="decimal", precision=9, scale=6, nullable=true)
     */
    protected $latitude;

    /**
     * @var float
     * @ORM\Column(name="longitude", type="decimal", precision=9, scale=6, nullable=true)
     */
    protected $longitude;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $description;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    protected $maxAttendees;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetimetz")
     */
    protected $datetime;

    /**
     * @ORM\OneToMany(targetEntity="RSVP", mappedBy="event")
     * @var ArrayCollection
     */
    protected $rsvps;

    /**
     * @var Group
     * @ORM\ManyToOne(targetEntity="Group")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="group_id")
     */
    protected $group;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="User")
     * @ORM\JoinTable(name="event_organizer",
     *      inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="user_id")}
     *      )
     */
    protected $organizers;

    public function __construct()
    {
        $this->rsvps = new ArrayCollection();
        $this->organizers = new ArrayCollection();
    }

    /**
     * @param \DateTime $datetime
     * @return self
     */
    public function setDatetime($datetime)
    {
        if (is_string($datetime)) {
            $datetime = new \DateTime($datetime);
        }

        $this->datetime = $datetime;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * @param string $description
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param int $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param float $latitude
     * @return self
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param string $location
     * @return self
     */
    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param float $longitude
     * @return self
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param int $maxAttendees
     * @return self
     */
    public function setMaxAttendees($maxAttendees)
    {
        $this->maxAttendees = $maxAttendees;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxAttendees()
    {
        return $this->maxAttendees;
    }

    /**
     * @param string $title
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param ArrayCollection $rsvps
     * @return self
     */
    public function setRsvps($rsvps)
    {
        $this->rsvps = $rsvps;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getRsvps()
    {
        return $this->rsvps;
    }

    /**
     * @param Group $group
     */
    public function setGroup($group)
    {
        $this->group = $group;
    }

    /**
     * @return Group
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param ArrayCollection $organizers
     */
    public function setOrganizers($organizers)
    {
        $this->organizers = $organizers;
    }

    /**
     * @return ArrayCollection
     */
    public function getOrganizers()
    {
        return $this->organizers;
    }
}
