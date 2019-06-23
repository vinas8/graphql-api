<?php

namespace App\GraphQL\Resolver;

use Doctrine\ORM\EntityManager;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class ApartmentListResolver implements ResolverInterface, AliasedInterface {
    private $em;

    //TODO: This is a violation of the Law of Demeter, which requires to only call methods one level deeper than the current level (i.e. we should not go further than calling methods on the injected EntityManager)
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function resolve(Argument $args)
    {
        $apartments = $this->em->getRepository('App:Apartment')->findBy(
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