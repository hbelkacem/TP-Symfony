<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Musee;
use AppBundle\Entity\Commentaire;
use AppBundle\Entity\User;
use AppBundle\Repository;
use Doctrine\DBAL\Types\StringType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\DomCrawler\Field\TextareaFormField;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MuseeController extends Controller
{

    /**
     * @Route("/musee/{page}",  name="musee")
     */
    public function indexAction($page)
    {
        $nbParPage = 10;

           //Récuperation des donnee musee
        $listeMusee = $this->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Musee')
            ->findAllMusee($page,$nbParPage);

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
    public function findOneMuseeAction($id ,Request $request)
    {

        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Musee');
        $musee = $repository->find($id);

        ///Formulaire des commentaire
        $commentaire = new Commentaire();
        $form = $this->createForm('AppBundle\Form\CommentaireType', $commentaire);
        $form->handleRequest($request);

        if($request->isMethod('POST')){
            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $commentaire->setDate(new \DateTime('now'));
                $commentaire->setMusee($musee);
                $em->persist($commentaire);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Commentaire bien enregistrée !');
                return $this->redirectToRoute('museeinfo', array('id' => $id));
            }
        }

        $listeCom = $this->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Commentaire')
            ->findBy(
                array('musee' => $id)
            );



        $res = split(' ',$musee->getCoordonnees());
             $lat = $res[0];
             $lon = $res[1];

        return $this->render('musee/findOneMusee.html.twig', array(
            'musee' => $musee,
            'form' => $form->createView(),
            'commentaires' => $listeCom,
            'lat' => $lat,
            'lon' => $lon,
        ));
    }


    /**
     * @Route("/acceuille",  name="start")
     */

    public function aceuille(){
        return $this->render('default/index.html.twig');
    }

    /**
     *@Route("/ajouterM", name="addM")
     */

    public function FormOfMusee(Request $request)
    {

        ///Formulaire des Musees
        $musee = new Musee();
        $form = $this->createForm('AppBundle\Form\MuseeType', $musee);
        $form->handleRequest($request);


        if($request->isMethod('POST')){

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($musee);
                $em->flush();
                return $this->redirectToRoute('musee', array('page' => 1));
            }
        }

        return $this->render('musee/ajoutMusee.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("/supprim/{musee}" , name="supprission")
     */
    public function supprimMusee($musee){


        $em = $this->getDoctrine()->getManager();
        $em->remove($musee);
        $em->flush();
        return $this->redirectToRoute('musee', array('page' => 108));

    }


}

?>
