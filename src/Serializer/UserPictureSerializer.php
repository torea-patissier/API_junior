<?php

namespace App\Serializer;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
// use Vich\UploaderBundle\Storage\StorageInterface;
use Symfony\Component\Security\Core\Security;

// final class UserPictureSerializer implements ContextAwareNormalizerInterface, NormalizerAwareInterface
// {
//   use NormalizerAwareTrait;

//   private const ALREADY_CALLED = 'USER_PICTURE_NORMALIZER_ALREADY_CALLED';

//   public function __construct(private StorageInterface $storage, private EntityManagerInterface $em)
//   {
//   }

//   public function normalize($object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
//   {
//     $context[self::ALREADY_CALLED] = true;

//     if ($this->storage->resolveUri($object, 'photoFile')) {
//       $object->setAvatar($this->storage->resolveUri($object, 'photoFile'));
//     }


//     $this->em->flush();

//     return $this->normalizer->normalize($object, $format, $context);
//   }


//   public function supportsNormalization($data, ?string $format = null, array $context = []): bool
//   {
//     if (isset($context[self::ALREADY_CALLED])) {
//       return false;
//     }

//     return $data instanceof User;
//   }
// }