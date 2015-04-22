<?php

namespace Video\EmoticonBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MomentEmotion
 *
 * @ORM\Table(name="moment_emotion")
 * @ORM\Entity(repositoryClass="Video\EmoticonBundle\Entity\Repository\EmotionRepository")
 */
class MomentEmotion
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="emotion", type="string", length=255)
     */
    private $emotion;

    /**
     * @var float
     *
     * @ORM\Column(name="time", type="float")
     */
    private $time;

    /**
     *
     * @var Video
     *
     * @ORM\ManyToOne(targetEntity="Video", inversedBy="emotions")
     * @ORM\JoinColumn(name="video_id", referencedColumnName="id")
     */
    private $video;


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
     * Set emotion
     *
     * @param string $emotion
     * @return MomentEmotion
     */
    public function setEmotion($emotion)
    {
        $this->emotion = $emotion;

        return $this;
    }

    /**
     * Get emotion
     *
     * @return string 
     */
    public function getEmotion()
    {
        return $this->emotion;
    }

    /**
     * Set time
     *
     * @param float $time
     * @return MomentEmotion
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return float 
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set video
     *
     * @param \Video\EmoticonBundle\Entity\Video $video
     * @return MomentEmotion
     */
    public function setVideo(\Video\EmoticonBundle\Entity\Video $video = null)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return \Video\EmoticonBundle\Entity\Video 
     */
    public function getVideo()
    {
        return $this->video;
    }
}
