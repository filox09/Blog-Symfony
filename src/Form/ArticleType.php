<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null ,array('label'=>'Titre de l\'article'))
            ->add('category', EntityType::class, array(
                'class' => Category::class,
                'choice_label' => 'title',
                'label'=>'Choisir une catégorie'
            ))
            ->add('content', null ,array('label'=>'Contenu de l\'article'))
            ->add('image', null ,array('label'=>'Image de l\'article', 'attr' => ['class' => 'test-de-class']))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
