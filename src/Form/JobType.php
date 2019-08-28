<?php


namespace App\Form;


use App\Entity\Job;
use App\Validator\Constraint\BadWords;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titel',
                'attr' => [
                    'placeholder'   => 'Web Developer'
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Beschreibung',
                'attr' => [
                    'placeholder' => 'Aussagekräftige Beschreibung zur Tätigkeit und den Technologien',
                    'style' => 'width:100%;',
                    'rows' => '15'
                ]
            ])
            ->add('zipcode', IntegerType::class, [
                'label' => 'Postleitzahl',
                'attr' => [
                    'placeholder' => '47051'
                ]
            ])
            ->add('town', TextType::class, [
                'attr' => [
                    'placeholder' => 'Duisburg'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'button button-green button-full button-rounded button-sm uppercase ultrabold'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Job::class,
            'translation_domain' => false
        ]);
    }

}
