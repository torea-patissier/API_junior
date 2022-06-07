<?php

namespace App\Controller;

use App\Entity\Entreprises;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;

class RegisterController extends AbstractController
{


    public function __invoke( $data)
    {
       
        return $data;
    }
}