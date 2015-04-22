<?php
namespace Video\EmoticonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Video\EmoticonBundle\Entity\Video;
use Video\EmoticonBundle\Entity\MomentEmotion;

class EmotionController extends Controller{

    /**
     * @Rest\View()
     */
    public function addEmotionAction(Request $request){

        $video = $this->getDoctrine()
            ->getRepository('VideoEmoticonBundle:Video')
            ->findOneBy(
                array('youtubeId' => $request->get('video_id'))
            );
        $em = $this->getDoctrine()->getManager();

        if (!$video) {
            $video = new Video();
            $video->setYoutubeId($request->get('video_id'));
            $em->persist($video);
        }
        $emotion = new MomentEmotion();
        $emotion->setEmotion($request->get('emotion'));
        $emotion->setTime($request->get('time'));
        $emotion->setVideo($video);
        $em->persist($emotion);
        $video = $em->getRepository('VideoEmoticonBundle:MomentEmotion');
        $emotions = $video->findeAllEmotions($request->get('video_id'));
        $em->flush();

        return $emotions;
    }


    /**
     * @Rest\View()
     */
    public function getEmotionAction($video_id){


        $em = $this->getDoctrine()->getEntityManager();
        $emotions = $em->getRepository('VideoEmoticonBundle:MomentEmotion')
            ->findeAllEmotions($video_id);


        return $emotions;
        }
    }
