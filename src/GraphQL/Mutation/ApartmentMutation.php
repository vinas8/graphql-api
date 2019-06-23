<?php
namespace App\GraphQL\Mutation;

use App\Entity\Apartment;
use App\Repository\ApartmentRepository;
use Doctrine\ORM\EntityManager;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class ApartmentMutation implements MutationInterface, AliasedInterface
{
    private $apartmentRepository;
    private $entityManager;

    public function __construct(EntityManager $entityManager, ApartmentRepository $apartmentRepository)
    {
        $this->apartmentRepository = $apartmentRepository;
        $this->entityManager = $entityManager;
    }

    public function createOrUpdate(string $streetAddress, int $apartmentId): ?Apartment
    {
        $apartment = $this->apartmentRepository->find($apartmentId);

        if ($apartment) {
            $apartment->setStreetAddress($streetAddress);
        } else {
            $apartment = new Apartment();
            $apartment->setStreetAddress($streetAddress);
        }

        $this->entityManager->persist($apartment);
        $this->entityManager->flush();

        return $apartment;
    }
    /**
     * Returns methods aliases.
     *
     * For instance:
     * array('myMethod' => 'myAlias')
     *
     * @return array
     */
    public static function getAliases()
    {
        return [
            'createOrUpdate' => 'createOrUpdateApartment'
        ];
    }
}