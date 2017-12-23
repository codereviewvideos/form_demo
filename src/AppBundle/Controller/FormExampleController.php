<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\ProductType;
use AppBundle\Entity\Product;

class FormExampleController extends Controller
{
  /**
   * @Route("/", name="form_example")
   */
  public function formExampleAction(Request $request)
  {
    $form = $this->createForm(ProductType::class);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid())
    {
      $em = $this->getDoctrine()->getManager();

      $product = $form->getData();

      $em->persist($product);
      $em->flush();

      $this->addFlash('success', 'We saved the product with id: ' . $product->getId());
    }

    return $this->render('form-example/index.html.twig', [
      'form' => $form->createView()
    ]);
  }
}
