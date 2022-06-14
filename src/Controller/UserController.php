<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Cities;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Security;

class UserController extends AbstractController
{
  public function __construct(private Security $security, private EntityManagerInterface $entityManagerInterface, private UserRepository $userRepository)
  {
  }

  public function __invoke($data, Request $request)
  {
    $uploadedFile = $request->files->get('photoFile');
    $parameters = $request->request;
    $user = $this->userRepository->find($data->getId());


    /** @var User */
    

    if ($email = $parameters->get('email')) {
      $data->setEmail($email);
      $user->setEmail($email);
    }
    if ($firstname = $parameters->get('firstname')) {
      $data->setFirstname($firstname);
      $user->setFirstname($firstname);
    }
    if ($lastname = $parameters->get('lastname')) {
      $data->setLastname($lastname);
      $user->setLastname($lastname);
    }
    if ($telephone = $parameters->get('telephone')) {
        $data->setTelephone($telephone);
        $user->setTelephone($telephone);
      }
    if ($lastname = $parameters->get('lastname')) {
        $data->setLastname($lastname);
        $user->setLastname($lastname);
      }
    if ($description = $parameters->get('description')) {
        $data->setDescription($description);
        $user->setDescription($description);
      }
    if ($yearofexperience = $parameters->get('year_of_experience')) {
        $data->setYearOfExperience($yearofexperience);
        $user->setYearOfExperience($yearofexperience);
      }
    if ($city = $parameters->get('city')) {
        $data->setCity($city);
        $user->setCity($city);
      }
    if ($uploadedFile) {
      $data->setAvatar($data->getAvatar());
      $data->setPhotoFile($uploadedFile);
    }
    $this->entityManagerInterface->flush();
    return $data;
  }
}