<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Article; /* ne pas oublier le use vue que la Class Article est utilisé */
use App\Entity\Comment;
use App\Form\CommentType;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;


class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(ArticleRepository $repo) /*Grace à l'intence de la class ArticleRepository $repo j'exprime a symfony le repo la ligne 18 ne sert plus  */
    {
        /* $repo = $this->getDoctrine()->getRepository(Article::class);utilisation de doctrine pour avoir le bon repository qui gêre la class Article */

        $articles = $repo->findAll(); /* création de la variable articles qui va contenir tout nos articles ex : findOneByTitle("Titre de l'article") */

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles, /*passé a twig la variable $articles avec toutes les données  */
        ]);
    }
    /**
     * @Route("/", name="home")
     */
    public function home() {
        return $this->render('blog/home.html.twig', [
            'title' => "Welcome on Board !",
            'username' => "Guillaume"
        ]);
    }

    /**
     * @Route("/blog/new", name="blog_create")
     * @Route("/blog/{id}/edit", name="blog_edit")
     */
    public function form(Article $article = null, Request $request, EntityManagerInterface $manager)
    {
        if(!$article) {
            $article = new Article();
        }

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY'); // la route fonctionne uniquement si la personne est connecté 

        // $form = $this->createFormBuilder($article)
        //              ->add('title')
        //              ->add('content')
        //              ->add('image')
        //              ->getForm();

        $form = $this->createForm(ArticleType::class, $article); // avec la commande php bin/console make:form on créer automatiquement un formulaire et on utilise $this->createForm(ArticleType::class, $article); pour lui dire quel class est utilisé  ( évite la duplication du code le formulaire est disponible partout)

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            if(!$article->getId()) {
                $article->setCreatedAt(new \DateTime());
            }

            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('blog_show', [ 'id' => $article->getId()]);
        }
        return $this->render('blog/create.html.twig', [
            'formArticle' => $form->createView(),
            'editMode' => $article->getId() !== null,
            'article' => $article
        ]);

    }

    /** 
     * @route("/blog/{id}", name="blog_show")
     */
    public function show(Article $article, Request $request, EntityManagerInterface $manager) {
        /* $repo = $this->getDoctrine()->getRepository(Article::class);  on utilise ArticleRepository $repo voir l16*/
        /* $article = $repo->find($id); */
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $comment->setCreatedAt(new \DateTime())
                    ->setArticle($article);
            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('blog_show', [ 'id' => $article->getId()]);
        }

        return $this->render('blog/show.html.twig', [
            'article' => $article,
            'commentForm' => $form->createView()
        ]);
    }

 
}

