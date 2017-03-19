<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Commentaire;
use AppBundle\Repository;
use Doctrine\DBAL\Types\StringType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;


class MuseeController extends Controller
{

    /**
     * @Route("/musee/{page}",  name="musee")
     */
    public function indexAction($page)
    {
        $nbParPage = 10;

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
        $musee = $repository->findById(array('id' => $id));
        return $this->render('musee/findOneMusee.html.twig', array(
            'infomusee' => $musee,));
    }



    /**
     * @Route("/form/{request}",  name="form")
     */

    public function addAction(Request $request)

    {

        // On crée un objet Commentaire

        $com = new Commentaire();


        // On crée le FormBuilder grâce au service form factory

        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $com);


        // On ajoute les champs de l'entité que l'on veut à notre formulaire

        $formBuilder
            ->add('auteur', TextType::class)
            ->add('date', DateType::class)
            ->add('note', StringType::class)
            ->add('contenu', TextType::class);

        // À partir du formBuilder, on génère le formulaire

        $form = $formBuilder->getForm();


        // On passe la méthode createView() du formulaire à la vue

        // afin qu'elle puisse afficher le formulaire toute seule

        return $this->render('musee/findOneMusee.html.twig', array(

            'form' => $form,

        ));

    }


}
?>
