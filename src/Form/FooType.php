<?php

namespace App\Form;

use App\Entity\Foo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FooType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('bars', CollectionType::class, [
                'entry_type'   => BarType::class,
                'by_reference' => false,
                'allow_add'    => true,
                'allow_delete' => true,
                'error_bubbling' => false
            ])
            ->add('bazs', CollectionType::class, [
                'entry_type'   => BazType::class,
                'by_reference' => false,
                'allow_add'    => true,
                'allow_delete' => true,
                'error_bubbling' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Foo::class,
        ]);
    }
}
