<?php

namespace App\Controller;
use App\Entity\Book;
use App\Entity\User;
use App\Repository\BookRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
class BookController extends AbstractController
{
    /**
     * @var BookRepository
     */
    private $repository;
    public function __construct(private BookRepository $BookRepository)
    {
        $this->repository=$this->BookRepository;
    }

    #[Route(path:'/App/Book',  methods: ['GET'])]
    public function Get(): Response
    {
      //  $bookRepository = $entityManager->getRepository(Book::class);
        $books=  $this->BookRepository->findAll();


        return $this->json($books);

    }

    #[Route(path:'/App/Book',  methods: ['POST'])]
    public function  post(Request $request): Response{
        $data= $request->request->all();
        $book= new Book();
        $book-> setTitle($data['title']);
        $book-> setUnit($data['unit']);
        $doctrine= $this->getDoctrine()-> getManager();
        $doctrine->persist($book);
        $doctrine->flush();
        return new Response(
            "Book Save",
            200,
            array_merge([], ['Content-Type' => 'application/json;charset=UTF-8'])
        );
    }
    #[Route(path:'/App/Book/{id}',  methods: ['GET'])]
    public function getByID($id,EntityManagerInterface $entityManager): Response
    {
        $bookRepository = $entityManager->getRepository(Book::class);
        $books=  $bookRepository->find($id);


        return $this->json($books);

    }
    public function index(BookRepository $bookRepository): JsonResponse
    {
        return $this->json($bookRepository->findAll());
    }
    #[Route(path:'/Api/Book',  methods: ['POST'])]
    public function  create(Request $request): JsonResponse{
        $data= $request->request->all();
        $book= new Book();

        $book-> setTitle($data['title']);
        $book-> setUnit($data['unit']);

        $this->BookRepository->add($book, true);
        $doctrine= $this->getDoctrine()-> getManager();
        $doctrine->persist($book);
        $doctrine->flush();
        return $this->json([
            'book save' => $book
        ]);
    }
    #[Route(path:'/App/Book/{id}',  methods: ['DELETE'])]
    public function delete($id,EntityManagerInterface $entityManager): JsonResponse
    {

       // $doctrine = $this->getDoctrine()->getManager();
        //$doctrine->remove($book);
        //$doctrine->flush();

        $book = $entityManager->find('Book', $id);
        $this->BookRepository->remove($book, true);
        return $this->json([ "removed" => true ]);
    }
    /**
     * @Route("/update/{id}", name="_update", methods={"PUT"})
     */
    #[Route(path:'/App/Book',  methods: ['PUT'])]
    public function update(Book $book, Request $request): JsonResponse
    {

        $data = $request->request->all();
        $book->setTitle($data['title']);
        $book->setUnit($data['unit']);
        $doctrine = $this->getDoctrine()->getManager();
        $doctrine->flush();
        return $this->json($book);
    }

    /*#[Route(path:'/Book',  methods: ['DELETE'])]
    public function deleteBooks($Book book): Response
    {
        $bookRepository = $entityManager->getRepository(Book::class);
         $bookRepository->


        return $this->json($books);

    }
    */
}