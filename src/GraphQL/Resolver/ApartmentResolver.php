<?php
namespace App\GraphQL\Resolver;

use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;
use App\Repository\ApartmentRepository;

class ApartmentResolver implements ResolverInterface, AliasedInterface {

    private $apartmentRepository;

    public function __construct(ApartmentRepository $apartmentRepository)
    {
        $this->apartmentRepository = $apartmentRepository;
    }

    public function resolve(Argument $args)
    {
        return $this->apartmentRepository->find($args['id']);
    }

    public static function getAliases()
    {
        return [
            'resolve' => 'Apartment'
        ];
    }
}