<?php

namespace App\Controller;

use App\Entity\Entreprises;
use App\Entity\Cities;
use App\Repository\EntreprisesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Security;

class EntreprisesController extends AbstractController
{
  public function __construct(private Security $security, private EntityManagerInterface $entityManagerInterface, private EntreprisesRepository $entreprisesRepository)
  {
  }

  public function __invoke($data, Request $request)
  {
    $uploadedFile = $request->files->get('photoFile');
    $parameters = $request->request;
    $entreprises = $this->entreprisesRepository->find($data->getId());


    /** @var Entreprises */
    

    if ($email = $parameters->get('email')) {
      $data->setEmail($email);
      $entreprises->setEmail($email);
    }
    if ($name = $parameters->get('name')) {
      $data->setName($name);
      $entreprises->setName($name);
    }
    if ($address = $parameters->get('address')) {
        $data->setAddress($address);
        $entreprises->setAddress($address);
      }
    if ($description = $parameters->get('description')) {
        $data->setDescription($description);
        $entreprises->setDescription($description);
      }
    if ($city = $parameters->get('city')) {
        $data->setCity($city);
        $entreprises->setCity($city);
      }
    if ($uploadedFile) {
      $data->setAvatar($data->getAvatar());
      $data->setPhotoFile($uploadedFile);
    }
    $this->entityManagerInterface->flush();
    return $data;
  }
}