<?php

namespace Video\EmoticonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        return $this->render('VideoEmoticonBundle:Main:index.html.twig');

    }
}
