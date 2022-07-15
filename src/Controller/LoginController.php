<?php

namespace App\Controller;

use App\Entity\Entreprises;
use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Security;

class LoginController extends AbstractController
{

    #[Route(path: '/api/login', name: 'api_login', methods: ['POST'])]

    public function __invoke( $data, JWTEncoderInterface $token)
    {
        dd($data);
       $data->setJwtToken($token->encode(["roles" => $data->getRoles(), "username" => $data->getEmail()]));
        return $data;
    }
}