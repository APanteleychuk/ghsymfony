<?php

namespace Palex\BlogBundle\Form\Type;

use Palex\BlogBundle\Entity\Comment;
use Palex\BlogBundle\Entity\Post;
use Palex\BlogBundle\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('POST')
            ->add('comment', TextareaType::class, ['label'=>'your comment'])
//            ->add('author', HiddenType::class, ['data' => 'anonymous'])
//            ->add('post_id', HiddenType::class, ['data' => 'anonymous'])
            ->add('Add comment', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }

}