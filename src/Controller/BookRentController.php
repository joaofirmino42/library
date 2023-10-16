<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\BookRent;
use App\Entity\User;
use App\Repository\BookRentRepository;
use App\Repository\UserRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookRentController extends AbstractController
{
    /**
     * @var BookRentRepository
     */
    private $repository;

    public function __construct(private BookRentRepository $BookRentRepository)
    {
        $this->repository=$BookRentRepository;
    }
    #[Route('/book/rent', name: 'app_book_rent')]
    public function index(): Response
    {
        return $this->render('book_rent/index.html.twig', [
            'controller_name' => 'BookRentController',
        ]);
    }
    #[Route(path:'/App/BookRent',  methods: ['POST'])]
    public function  Post(Request $request): JsonResponse{
        $data= $request->request->all();
        $bookRent= new BookRent();
        $currentDateTime = new DateTime('now');
        $bookRent-> setStatus(true);
        $bookRent-> setValue(10.00);
        $bookRent-> setDateRent($currentDateTime);
        $bookRent-> setBookId($data['book_id']);
        $bookRent-> setIdUser($data['user_id']);
        date_add($currentDateTime, date_interval_create_from_date_string("10 days"));
        $bookRent-> setExpirationDate($currentDateTime);
        $this->BookRentRepository->add($bookRent, true);
        //$doctrine= $this->getDoctrine()-> getManager();
        //$doctrine->persist($bookRent);
        //$doctrine->flush();
        return $this->json([
            'book rent' => $bookRent
        ]);
    }
}
