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

    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();

      $product = $form->getData();

      $em->persist($product);
      $em->flush();

      $this->addFlash('success', 'We created the product with id: ' . $product->getId());
    }

    return $this->render('form-example/index.html.twig', [
      'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/edit/{product}", name="form_edit_example")
   */
   public function formEditExample(Request $request, Product $product)
   {
     $form = $this->createForm(ProductType::class, $product);

     $form->handleRequest($request);

     if ($form->isSubmitted() && $form->isValid()) {
       $em = $this->getDoctrine()->getManager();
       $em->flush();

       $this->addFlash('success', 'We updated the product with id: ' . $product->getId());
     }

     return $this->render('form-example/index.html.twig', [
       'form' => $form->createView()
     ]);
   }
}
