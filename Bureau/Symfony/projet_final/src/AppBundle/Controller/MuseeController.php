<?php

namespace AppBundle\Controller;

use AppBundle\Repository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;


class MuseeController extends Controller{

    /**
     * @Route("/musee/{page}",  name="musee")
     */
    public function indexAction($page){
        $nbParPage=10;

        $listeMusee = $this->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Musee')
            ->findAllMusee($page, $nbParPage);


        // on calcule l'entier supérieur du nombre de page
        $nbPage = ceil(count($listeMusee) / $nbParPage);


        return $this->render('musee/findAllMusee.html.twig', array(
            'listeMusee' => $listeMusee,
            'nbPages' => $nbPage,
            'page' => $page
        ));
    }



    /**
     * @Route("/info/{id}",  name="museeinfo")
     */
    public function findOneMuseeAction($id)
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Musee');
        $musee = $repository->findById(array('id'=> $id));
        return $this->render('musee/findOneMusee.html.twig', array(
            'infomusee' => $musee,));
    }
}

?>
