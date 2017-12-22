<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FormExampleController extends Controller
{
    /**
     * @Route("/", name="form_example")
     */
    public function formExampleAction(Request $request)
    {
        $form = $this->createFormBuilder()
          ->add('personName', TextType::class)
          ->add('submit', SubmitType::class, [
            'label' => 'Submit me now!',
            'attr' => [
              'class' => 'btn btn-success'
            ]
          ])
          ->getForm()
        ;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

          $name = $form->getData()['personName'];

          dump($name);

          $this->sendMail($name);
        }

        return $this->render('form-example/index.html.twig', [
          'myForm' => $form->createView()
        ]);
    }

    private function sendMail($personName)
    {
      $mail = (new \Swift_Message('This is the subject'))
        ->setFrom('me@form_demo.test')
        ->setTo('personal@shaunthornburgh.com')
        ->setBody($personName)
      ;

      $this->get('mailer')->send($mail);
    }
}
