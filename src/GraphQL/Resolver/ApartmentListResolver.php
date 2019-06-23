<?php

namespace App\GraphQL\Resolver;

use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;
use App\Repository\ApartmentRepository;

class ApartmentListResolver implements ResolverInterface, AliasedInterface {

    private $apartmentRepository;

    public function __construct(ApartmentRepository $apartmentRepository)
    {
        $this->apartmentRepository = $apartmentRepository;
    }

    public function resolve(Argument $args)
    {
        $apartments = $this->apartmentRepository->findBy(
            [],
            ['id' => 'desc'],
            $args['limit'],
            0
        );
        return ['apartments' => $apartments];
    }

    public static function getAliases()
    {
        return [
            'resolve' => 'ApartmentList'
        ];
    }
}