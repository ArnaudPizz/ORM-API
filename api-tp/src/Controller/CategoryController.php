<?php

namespace App\Controller;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function showArticlesByCategories(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();
        return $this->json([
            'categories' => $categories,
            Response::HTTP_CREATED,
            [],
            [ "groups" => "category:detail"]
        ]);
    }
}
