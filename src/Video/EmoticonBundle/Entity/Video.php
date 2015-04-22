<?php

namespace Video\EmoticonBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Video
 *
 * @ORM\Table(name="video")
 * @ORM\Entity
 */
class Video
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="MomentEmotion", mappedBy="video")
     */
    private $emotions;

    /**
     * @var string
     *
     * @ORM\Column(name="youtube_id", type="string", length=255)
     */
    private $youtubeId;

    public function __construct(){
        $this->emotions = new ArrayCollection();
    }
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set youtubeId
     *
     * @param string $youtubeId
     * @return Video
     */
    public function setYoutubeId($youtubeId)
    {
        $this->youtubeId = $youtubeId;

        return $this;
    }

    /**
     * Get youtubeId
     *
     * @return string 
     */
    public function getYoutubeId()
    {
        return $this->youtubeId;
    }

    /**
     * Add emotions
     *
     * @param \Video\EmoticonBundle\Entity\MomentEmotion $emotions
     * @return Video
     */
    public function addEmotion(\Video\EmoticonBundle\Entity\MomentEmotion $emotions)
    {
        $this->emotions[] = $emotions;

        return $this;
    }

    /**
     * Remove emotions
     *
     * @param \Video\EmoticonBundle\Entity\MomentEmotion $emotions
     */
    public function removeEmotion(\Video\EmoticonBundle\Entity\MomentEmotion $emotions)
    {
        $this->emotions->removeElement($emotions);
    }

    /**
     * Get emotions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmotions()
    {
        return $this->emotions;
    }
}
