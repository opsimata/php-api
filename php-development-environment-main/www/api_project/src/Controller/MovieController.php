<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/movie')]
class MovieController extends AbstractController
{
    #[Route('/', name: 'get_all_movies')]
    public function index(MovieRepository $movieRepository): JsonResponse
    {
        $movies = $movieRepository->findAll();
        return $this->json($movies);
    }

    #[Route('/new', name: 'create_new_movie')]
    public function newMovie(EntityManagerInterface $em): JsonResponse
    {
        $movie = new Movie();
        $movie->setTitle('Movie 1');
        $movie->setDescription('Description movie 1');

        $em->persist($movie);
        $em->flush();

        return $this->json("Movie created");
    }
}
