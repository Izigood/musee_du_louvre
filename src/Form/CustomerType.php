<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Form\DataTransformer\FrenchToDateTimeTransformer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use App\Repository\CustomerRepository;

class CustomerType extends AbstractType
{
    private $transformer;
    
    public function __construct(FrenchToDateTimeTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname',TextType::class, ['label' => "Prénom",
                                                    'attr' => [
                                                        'placeholder' => "Veuillez saisir votre prénom"
                                                    ],
                                                    'required' => false
                                                ])
            ->add('lastname', TextType::class, ['label' => "Nom",
                                                    'attr' => [
                                                        'placeholder' => "Veuillez saisir votre nom"
                                                    ],
                                                    'required' => false
                                                ])

            ->add('country', TextType::class, ['label' => "Pays",
                                                    'attr' => [
                                                        'placeholder' => "Veuillez saisir votre pays"
                                                    ],
                                                    'required' => false
                                                ])
            ->add('dateOfBirthday', TextType::class, ["label" => "Date de naissance",
                                                        'attr' => [
                                                            'placeholder' => "Veuillez saisir votre date de naissance"
                                                        ],
                                                        'required' => false
                                                    ])
            ->add('reducedPrice', CheckboxType::class, ['label' => "Tarif réduit",
                                                        'attr' => [
                                                            'placeholder' => "Veuillez saisir votre date de naissance",
                                                            'onclick' => 'showDetails(this)'
                                                        ],
                                                        'required' => false])
        ;

        $builder->get('dateOfBirthday')->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}
