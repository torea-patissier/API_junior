<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Cities;
use App\Entity\Diplomas;
use App\Entity\Profession;
use App\Repository\CitiesRepository;
use App\Repository\DiplomasRepository;
use App\Repository\ProfessionRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Security;

class UserController extends AbstractController
{
  public function __construct(private Security $security, private EntityManagerInterface $entityManagerInterface, private UserRepository $userRepository, private CitiesRepository $citiesRepository, private DiplomasRepository $diplomasRepository, private ProfessionRepository $professionRepository)
  {
  }

  public function __invoke($data, Request $request)
  {
    $uploadedFile = $request->files->get('photoFile');
    $parameters = $request->request;

    /** @var User */
    $user = $this->userRepository->find($data->getId());


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

    // // Récupere l'id dans la table Cities

    //  if ($citiesId = $parameters->get('cities')) {
    //   $citiesRepository = $this->entityManagerInterface->getRepository(Cities::class);
    //   $data->setCity($citiesRepository->find($citiesId));
    // }

    // // Récupere l'id dans la table Diplomas

    // if ($diplomasId = $parameters->get('diplomas')) {
    //   $diplomasRepository = $this->entityManagerInterface->getRepository(Diplomas::class);
    //   $data->setDiploma($diplomasRepository->find($diplomasId));
    // }

    // // Récupere l'id dans la table Profession

    // if ($professionId = $parameters->get('profession')) {
    //   $professionRepository = $this->entityManagerInterface->getRepository(Profession::class);
    //   $data->setProfession($professionRepository->find($professionId));
    // }

    // Créer une nouvelle Ville dans la BDD

    if ($city = $parameters->get('city')) {
      $newcity = new Cities();
      $newcity->setName($city);
      $this->entityManagerInterface->persist($newcity);
      $this->entityManagerInterface->flush();

      $data->setCity($newcity);
      $user->setCity($newcity);
    }


    // Créer un nouveau Diplome dans la BDD

    if ($diploma = $parameters->get('diploma')) {
      $newdiploma = new Diplomas();
      $newdiploma->setName($diploma);
      $this->entityManagerInterface->persist($newdiploma);
      $this->entityManagerInterface->flush();

      $data->setDiploma($newdiploma);
      $user->setDiploma($newdiploma);
    }


    // Créer une nouvelle profession en BDD

    if ($profession = $parameters->get('profession')) {
      $newprofession = new Profession();
      $newprofession->setName($profession);
      $this->entityManagerInterface->persist($newprofession);
      $this->entityManagerInterface->flush();

      $data->setProfession($newprofession);
      $user->setProfession($newprofession);
    }

    if ($uploadedFile) {
      //   $data->setAvatar($data->getAvatar());
      $data->setPhotoFile($uploadedFile);
    }

    $this->entityManagerInterface->flush();
    return $data;
  }
}
