<?php

namespace  AppBundle\Controller;

use AppBundle\Entity;
use AppBundle\Entity\Commentaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
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
use AppBundle\Form\CommentaireType;


class CommentaireController extends Controller
{

    /**
     * Creates a new Commentaire entity.
     * @Route("/Yourcomment",  name="commentaire")
     */

    public function newAction(Request $request)
    {

        $commentaire = new Commentaire();
        $form = $this->createForm('AppBundle\Form\CommentaireType', $commentaire);
        $form->handleRequest($request);


        if($request->isMethod('POST')){


            if($form->isValid()){

                $em = $this->getDoctrine()->getManager();
                $em->persist($commentaire);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Commentaire bien enregistrée !');
                return $this->redirectToRoute('musee/findcomment.html.twig', array('id' => $commentaire->getId()));
            }
        }



        return $this->render('musee/findcomment.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
?>