<?php

namespace App\DataFixtures;

use DateTime;
use App\Article\Status;
use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $faker->addProvider(new \Faker\Provider\en_US\Text($faker));
        $faker->addProvider(new \Faker\Provider\Lorem($faker));
        $faker->addProvider(new \Faker\Provider\DateTime($faker));



        for ($i = 0; $i < 5; $i++) 
        {
            $category = new Category();

            $category->setName($faker->word())
                ->setCreated(new DateTime());
            $manager->persist($category);

        }


        for ($i = 0 ; $i < 15 ; $i++)
        {
        $article = new Article();

                $article->setTitle($faker->realText(20,2))
                        ->setContent($faker->realText(220, 2))
                        ->setStatus($status =  $faker->numberBetween(Status::NOT_PUBLISH, Status::PUBLISH))
                        ->setTrending($faker->boolean())
                        ->setCreated(new DateTime)
                        ->setCategory($category);   
                
                if ($status === Status::PUBLISH) {
                    $article->setPublished(new DateTime);
                }
                else {
                    $article->setPublished(null);
                }
                $manager->persist($article);

                
        }
        $manager->flush();
    }
}