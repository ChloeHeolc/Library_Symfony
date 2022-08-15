<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Genre;
use App\Entity\Writer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('resume')
            ->add('year')
            ->add('genre', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'name'
            ])
            ->add('writer', EntityType::class, [
                'class' => Writer::class,
                'choice_label' => 'name'
            ])
            ->add('Enregistrer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
