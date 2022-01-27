<?php

namespace App\DataPersister;

use App\Entity\User;
use App\Entity\Entreprises;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserDataPersister implements DataPersisterInterface
{

    public function __construct(private EntityManagerInterface $entityManager, private UserPasswordHasherInterface $userPasswordEncoderInterface)
    {
    }

    /**
     * Is the data supported by the persister?
     * Si connexion avec User j'appelle User, sinon Entreprises
     */
    public function supports($data): bool
    {
        if($data instanceof User){
            return $data instanceof User;    
        }else{
            return $data instanceof Entreprises;    
        }
    }

    /**
     * @param User $data
     * @param Entreprises $data
     * @return object|void Void will not be supported in API Platform 3, an object should always be returned
     */
    public function persist($data)
    {
        if ($data->getPassword()) {
            $data->setPassword(
                $this->userPasswordEncoderInterface->hashPassword($data, $data->getPassword())
            );
        }
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }

    /**
     * Removes the data.
     */
    public function remove($data)
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }

}


?>