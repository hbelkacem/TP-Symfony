<?php

namespace AppBundle\Controller;

use AppBundle\Entity;
use AppBundle\Entity\Commentaire;
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
        $commentaire = new Commentaire();

        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $commentaire);

        $formBuilder
            ->add('auteur'  ,  TextType::class         )
            ->add('date'    ,  DateType::class         )
            ->add('note'    ,  IntegerType::class      )
            ->add('contenu' ,  TextareaType::class     )
            ->add('save'    ,  SubmitType::class       ) ;

        $form = $formBuilder->getForm();

        return $this->render('musee/findOneMusee.html.twig', array(
            'infomusee' => $musee, 'form' => $form->createView() ));
    }
}

?>
