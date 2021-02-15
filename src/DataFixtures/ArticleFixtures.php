<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // use the factory to create a Faker\Generator instance
        $faker = \Faker\Factory::create('fr_FR');
        
        //Créer 3 catégories fake
        for($i = 1; $i <= 3; $i++ ) {
            $category = new Category();
            $category->setTitle($faker->sentence())
                     ->setDescription($faker->paragraph());
            
            $manager->persist($category);

            // Créer entre 4 et 6 articles
            for($j = 1; $j <= mt_rand(4, 6); $j++) { /* Création de 10 articles */ 
                $article = new Article(); /* Création d'une nouvelle instence de la class Article() */
              
                $content = '<p>' . join($faker->paragraphs(5), '</p><p>') . '</p>';
            
                $article->setTitle($faker->sentence())
                        ->setContent($content)
                        ->setImage($faker->imageUrl())
                        ->setCreatedAt($faker->dateTimeBetween('-6 months'))
                        ->setCategory($category);

                $manager->persist($article); /* Demander au manager de se préparrer a faire percisté mon article */

                // on donne des commentaires à l'article
                for($k = 1; $k <= mt_rand(4, 10); $k++) {

                    $comment = new Comment();

                    $content = '<p>' . join($faker->paragraphs(2), '</p><p>') . '</p>';
                    
                    $days = (new \DateTime())->diff($article->getCreatedAt())->days;

                    $comment->setAuthor($faker->name())
                            ->setContent($content)
                            ->setCreatedAt($faker->dateTimeBetween('-' . $days . ' days'))
                            ->setArticle($article);
                    
                    $manager->persist($comment);

                }
            }
        }
        
        $manager->flush(); /* Pour envoyer la requête SQL qui va mettre en place les fausses données */
    }
}
