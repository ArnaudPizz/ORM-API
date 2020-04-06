<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ArticleFormType;
use App\Form\CategoryFormType;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article", methods={"GET"})
     */
    public function list(ArticleRepository $articleRepository)
    {
        $articles = $articleRepository->findAll();

        return $this->json(
            ["articles" => $articles],
            Response::HTTP_CREATED,
            [],
            [ "groups" => "articles:detail"]
        );
    }

    /**
     * @Route("/article/{id}", name="article_id", methods={"GET"})
     */

    public function showArticle(Article $article)
    {
        return $this->json([
            ['article' => $article],
            Response::HTTP_CREATED,
            [],
            [ "groups" => "articles:detail"]
        ]);
    }

    /**
     * @Route("/popular",name="popular_article_list", methods={"GET"})
     */
    public function show_popular(ArticleRepository $articleRepository)
    {
        $article = $articleRepository->findBy(array('trending' => 1));
        return $this->json(["article"=> $article],
            Response::HTTP_OK,
            [],
            ["groups" => "articles:detail"]
        );
    }
    /**
     * @Route("/articleByCategory/{id}", name="articlePopular", methods={"GET"})
     */


     //Petit bug dans les fixtures, category_id = 5 sur tous les articles.. Donc ne fonctionne que sur l'url /api/articleByCategory/5
    public function articleCategory(ArticleRepository $articleRepository, Category $category)
    {
        $articles = $articleRepository->findBy(array('category' => $category->getId()));
        return $this->json(
            [$articles],
            Response::HTTP_OK,
            [],
            ["groups" => "articles:detail"]
        );
    }


    /**
     * @Route("/createArticle", name ="article_create", methods={"POST"})
     */
    public function createArticle(Request $request, EntityManagerInterface $entityManagerInterface)
    {
        $data = json_decode($request->getContent(), true);
        $article = new Article();
        $form = $this->createForm(ArticleFormType::class, $article);

        $form->submit($data);
        if ($form ->isValid()){
            $entityManagerInterface->persist($article);
            $entityManagerInterface->flush();

            return $this->json($article, Response::HTTP_CREATED);
        }

        return new Response("ok");
    }
     /**
     * @Route("/createCategory", name ="category_create", methods={"POST"})
     */
    public function createCategory(Request $request, EntityManagerInterface $entityManagerInterface)
    {
        $data = json_decode($request->getContent(), true);
        $category = new Category();
        $form = $this->createForm(CategoryFormType::class, $category);

        $form->submit($data);
        if ($form ->isValid()){
            $entityManagerInterface->persist($category);
            $entityManagerInterface->flush();

            return $this->json($category, Response::HTTP_CREATED);
        }

        return new Response("ok");
    }
}
