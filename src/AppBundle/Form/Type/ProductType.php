<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('rangeValue', RangeType::class, [
        'attr' => [
        	"data-provide" => "slider",
        	"data-slider-ticks" => "[1, 2, 3]",
        	"data-slider-ticks-labels" => '["short", "medium", "long"]',
        	"data-slider-min" => "1",
        	"data-slider-max" => "3",
        	"data-slider-step" => "1",
        	"data-slider-value" => "3",
        	"data-slider-tooltip" => "hide",
        ],
      ])
      ->add('save', SubmitType::class)
    ;
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => 'AppBundle\Entity\Product',
      'csrf_protection' => false
    ]);
  }
}
