<?php

namespace App\Controller;
use App\Entity\Book;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
class UserController
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(private UserRepository $UserRepository)
    {
        #$this->encoder = $encoder;
        $this->repository = $UserRepository;
    }



    #[Route(path:'/App/User',  methods: ['GET'])]
    public function get(EntityManagerInterface $entityManager,SerializerInterface $serializer, Request $request): Response
    {
        $userRespository = $entityManager->getRepository(User::class);
        $users=  $userRespository->findAll();
        #$data = $this->serializer->serialize($users 'json');
        $data = $serializer->serialize($users, 'json');
      //  return $this->json($data);
       # return $this->$data;
        return new Response(
            $data,
            200,
            array_merge([], ['Content-Type' => 'application/json;charset=UTF-8'])
        );

    }
    #[Route(path:'/App/User',  methods: ['POST'])]
    public function  post(Request $request): Response{
        $data= $request->request->all();
        $user= new User();
        $user-> setName($data['name']);
        $user-> setEmail($data['email']);
        $user-> setPassword($data['password']);
        $doctrine= $this->getDoctrine()-> getManager();
        $doctrine->persist($user);
        $doctrine->flush();
        return new Response(
            "User Save",
            200,
            array_merge([], ['Content-Type' => 'application/json;charset=UTF-8'])
        );
    }
    #[Route(path:'/App/User',  methods: ['PUT'])]
    public function  put(User $user,Request $request): Response{

        $userUpdate= $request->request->all();

        $user-> setName($userUpdate['name']);
        $user-> setEmail($userUpdate['email']);
        $user-> setPassword($userUpdate['password']);
        $doctrine= $this->getDoctrine()-> getManager();
        $doctrine->persist($user);
        $doctrine->flush();
        return new Response(
            "User Updated",
            200,
            array_merge([], ['Content-Type' => 'application/json;charset=UTF-8'])
        );
    }
    #[Route(path:'/App/User/{id_user}',  methods: ['DELETE'])]
    public function  Delete($id_user,Request $request): Response{

        $doctrine = $this->getDoctrine()->getManager();
        $User =$doctrine->find('User', $id_user);
        $doctrine->remove($User);
        $doctrine->flush();

         return new Response(
             "removed",
            200,
            array_merge([], ['Content-Type' => 'application/json;charset=UTF-8'])
        );

    }
    public function create(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $username = $request->request->get('_username');
        $password = $request->request->get('_password');

        $user = new User($username);
        $user->setPassword($password);
        $em->persist($user);
        $em->flush();
        return new Response(sprintf('User %s successfully created', $user->$username));
    }
    #[Route(path: '/App/User/login', name: 'app_user',methods: ['POST'])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {


        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

         return new Response("Login Success");
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}