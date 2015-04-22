<?php

namespace Video\EmoticonBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * EmotionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EmotionRepository extends EntityRepository
{
    public function findeAllEmotions($video){

//        $em = $this->getEntityManager();
//        $query = $em->createQuery(
//            'SELECT e, v
//    FROM VideoEmoticonBundle:MomentEmotion e
//    JOIN e.video v
//    WHERE v.youtubeId = :video'
//        )->setParameter('video', $video);
//        //$query = $qb->getQuery();
//        $result = $query->getResult();

        $em = $this->getEntityManager()->createQueryBuilder('e');
        $em->select('e.emotion','e.time')
        //$qb->select('e')
            ->from('VideoEmoticonBundle:MomentEmotion','e')
            ->innerJoin('VideoEmoticonBundle:Video', 'v', 'WITH','e.video = v.id')
            ->where('v.youtubeId = :vi')
            ->setParameter('vi', $video);
        $query = $em->getQuery();
        $result = $query->getArrayResult();

        return $result;
    }
}
