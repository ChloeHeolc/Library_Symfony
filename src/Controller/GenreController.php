<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Form\GenreType;
use App\Repository\GenreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class GenreController extends AbstractController
{
    /**
     * @Route("/genre", name="app_genre")
     */
    public function index(): Response
    {
        return $this->render('genre/index.html.twig', [
            'controller_name' => 'GenreController',
        ]);
    }

    /**
     * @Route("genres", name="genres_list")
     */
    public function listGenres(GenreRepository $genreRepository)
    {
        $genres = $genreRepository->findAll();

        return $this->render("genres_list.html.twig",['genres' => $genres]);
    }

    /**
     * @Route("genre/{id}", name="genre_show")
     */
    public function showGenre($id, GenreRepository $genreRepository)
    {
        $genre = $genreRepository->find($id);

        return $this->render("genre_show.html.twig", ['genre'=>$genre]);
    }

    /**
     * @Route("update/genre/{id}", name="update_genre")
     */
    public function updateGenre($id, GenreRepository $genreRepository, EntityManagerInterface $entityManagerInterface, Request $request)
    {
        $genre = $genreRepository->find($id);

        $genreForm = $this->createForm(GenreType::class,$genre);
        $genreForm->handleRequest($request);

        if ($genreForm->isSubmitted() && $genreForm->isValid()) 
        {
            $entityManagerInterface->persist($genre);
            $entityManagerInterface->flush();

            return $this->redirectToRoute("genres_list");
        }
        return $this->render("genre_form.html.twig", ['genreForm' => $genreForm->createView()]);
    }

    /**
     * @Route("create/genre", name="create_genre")
     */
    public function createGenre(EntityManagerInterface $entityManagerInterface, Request $request)
    {
        $genre = new Genre();
        $genreForm = $this->createForm(GenreType::class, $genre);

        $genreForm->handleRequest($request);

        if ($genreForm->isSubmitted() && $genreForm->isValid())
        {
            $entityManagerInterface->persist($genre);
            $entityManagerInterface->flush();

            return $this->redirectToRoute("genres_list");
        }
        return $this->render("genre_form.html.twig", ['genreForm' => $genreForm->createView()]);
    }

    /**
     * @Route("delete/genre/{id}", name="delete_genre")
     */
    public function deleteGenre($id, EntityManagerInterface $entityManagerInterface, GenreRepository $genreRepository) 
    {
        $genre = $genreRepository->find($id);

        $entityManagerInterface->remove($genre);
        $entityManagerInterface->flush();

        return $this->redirectToRoute("genres_list");
    }

}
