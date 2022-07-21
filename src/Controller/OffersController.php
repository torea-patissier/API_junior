<?php

namespace App\Controller;

use App\Entity\Entreprises;
use App\Entity\Cities;
use App\Entity\Diplomas;
use App\Entity\Offers;
use App\Repository\CitiesRepository;
use App\Repository\DiplomasRepository;
use App\Repository\EntreprisesRepository;
use App\Repository\OffersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Security;

class OffersController extends AbstractController
{
  public function __construct(private Security $security, private EntityManagerInterface $entityManagerInterface, private OffersRepository $offersRepository, private EntreprisesRepository $entreprisesRepository, private DiplomasRepository $diplomasRepository, private CitiesRepository $citiesRepository)
  {
  }

  public function __invoke( Request $request)
  {
    $uploadedFile = $request->files->get('photoFile');
    $parameters = $request->request;

    /** @var Offers */
    // $offers = $this->offersRepository->find($data->getId());
    
    $offers = New Offers();

    $offers->setPhotoFile($uploadedFile);
    $offers->setImage('test');
    $offers->setImage($offers->getPhotoFile());
    

    

    

    // if ($email = $parameters->get('email')) {
    //   $data->setEmail($email);
    //   $offers->setEmail('$email');
    // }
    if ($jobs = $parameters->get('jobs')) {
      // $data->setJobs($jobs);
      $offers->setJobs($jobs);
    }
    // if ($image = $parameters->get('image')) {
    //   // $data->setJobs($jobs);
    //   $offers->setImage($offers->getPhotoFile());
    // }
    if ($description = $parameters->get('description')) {
      // $data->setJobs($jobs);
      $offers->setDescription($description);
    }
    
    if ($type_of_contract = $parameters->get('type_of_contract')) {
        // $data->setTypeOfContract($type_of_contract);
        $offers->setTypeOfContract($type_of_contract);
      }
    if ($type_of_work = $parameters->get('type_of_work')) {
        // $data->setTypeOfWork($type_of_work);
        $offers->setTypeOfWork($type_of_work);
      }
    if ($description = $parameters->get('description')) {
        // $data->setDescription($description);
        $offers->setDescription($description);
      }

      // // Récupere l'id dans la table Cities

      // if ($citiesId = $parameters->get('cities')) {
      //   $citiesRepository = $this->entityManagerInterface->getRepository(Cities::class);
      //   $offers->setCity($citiesRepository->find($citiesId));
      // }

      // // Récupere l'id dans la table Diplomas

      // if ($diplomasId = $parameters->get('diplomas')) {
      //   $diplomasRepository = $this->entityManagerInterface->getRepository(Diplomas::class);
      //   $offers->setDiploma($diplomasRepository->find($diplomasId));
      // }

      // Créer une nouvelle Ville en BDD

      if ($city = $parameters->get('city')) {
        $newcity = new Cities();
        $newcity->setName($city);
        $this->entityManagerInterface->persist($newcity);
        $this->entityManagerInterface->flush();

        // $data->setCity($newcity);
        $offers->setCity($newcity);
      }


      // Créer un nouveau Diplome en BDD

      if ($diploma = $parameters->get('diploma')) {
        $newdiploma = new Diplomas();
        $newdiploma->setName($diploma);
        $this->entityManagerInterface->persist($newdiploma);
        $this->entityManagerInterface->flush();

        // $data->setDiploma($newdiploma);
        $offers->setDiploma($newdiploma);
      }

      // Récupere l'id de la Table Entreprises

      if ($entreprisesId = $parameters->get('entreprises')) {
        //$entreprisesRepository = $this->entityManagerInterface->getRepository('Entreprises');
        //$entreprisesRepository->find($entreprisesId);
        //$offers->setEntreprise($entreprisesRepository->find(107));
        

        // $newentreprise = new Entreprises();
        // $newentreprise->setName($entreprise);
        // $this->entityManagerInterface->persist($newentreprise);
        // $this->entityManagerInterface->flush();

        // // $data->setEntreprise($newentreprise);
        // $offers->setEntreprise($newentreprise);
        $entreprisesRepository = $this->entityManagerInterface->getRepository(Entreprises::class);
        $offers->setEntreprise($entreprisesRepository->find($entreprisesId));
      }
      //dd($parameters->get('entreprises'));
      //dd($parameters);
      // dd($entreprisesRepository->find(107));
      // dd($offers);

    if ($uploadedFile) {
      $offers->setPhotoFile($uploadedFile);
    }
    $this->entityManagerInterface->persist($offers);
    $this->entityManagerInterface->flush();
    return $offers;
    
  }
}