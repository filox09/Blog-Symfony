<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Article; /* ne pas oublier un user pour expliquer a php d'ou vien la class Article */

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 10; $i++) { /* Création de 10 articles */ 
            $article = new Article(); /* Création d'une nouvelle instence de la class Article() */
            $article->setTitle("Titre de l'article n°$i")
                    ->setContent("<p>Maecenas vel egestas justo. Nam ornare ornare libero nec aliquet. Pellentesque convallis, dui ac pharetra ullamcorper, diam lectus suscipit risus, nec lobortis nulla eros a odio. Donec tristique neque orci. Sed elit leo, dignissim quis dignissim nec, blandit eu urna. Phasellus in sollicitudin dolor. Nulla facilisi. Aliquam erat volutpat. Donec consectetur magna sed lectus facilisis, in elementum massa mollis. Ut euismod ut risus ullamcorper posuere. Mauris aliquet dignissim mollis. Maecenas hendrerit porta ipsum, ut eleifend augue.
                                </p><p>Maecenas vel egestas justo. Nam ornare ornare libero nec aliquet. Pellentesque convallis, dui ac pharetra ullamcorper, diam lectus suscipit risus, nec lobortis nulla eros a odio. Donec tristique neque orci. Sed elit leo, dignissim quis dignissim nec, blandit eu urna. Phasellus in sollicitudin dolor. Nulla facilisi. Aliquam erat volutpat. Donec consectetur magna sed lectus facilisis, in elementum massa mollis. Ut euismod ut risus ullamcorper posuere. Mauris aliquet dignissim mollis. Maecenas hendrerit porta ipsum, ut eleifend augue.
                                </p><p>Maecenas vel egestas justo. Nam ornare ornare libero nec aliquet. Pellentesque convallis, dui ac pharetra ullamcorper, diam lectus suscipit risus, nec lobortis nulla eros a odio. Donec tristique neque orci. Sed elit leo, dignissim quis dignissim nec, blandit eu urna. Phasellus in sollicitudin dolor. Nulla facilisi. Aliquam erat volutpat. Donec consectetur magna sed lectus facilisis, in elementum massa mollis. Ut euismod ut risus ullamcorper posuere. Mauris aliquet dignissim mollis. Maecenas hendrerit porta ipsum, ut eleifend augue.
                                </p>")
                    ->setImage("http://placehold.it/350x150")
                    ->setCreatedAt(new \DateTime());

            $manager->persist($article); /* Demander au manager de se préparrer a faire percisté mon article */

        }

        $manager->flush(); /* Pour envoyer la requête SQL qui va mettre en place les fausses données */
    }
}
