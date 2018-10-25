<?php

namespace SharedSecret\Infrastructure\Repositories\Doctrine;


use SharedSecret\Entities\Secret\Secret;
use SharedSecret\Infrastructure\Repositories\Doctrine\Entities\Secret as SecretDoctrineEntity;

class DoctrineSecretEntityFactory
{
    static public function create(Secret $secret): SecretDoctrineEntity
    {
        $entity = self::builtEntity();
        self::loadSecretId($secret, $entity);
        self::loadMessage($secret, $entity);
        self::loadExpiredAt($secret, $entity);
        self::loadExpirationTime($secret, $entity);

        return $entity;
    }

    private static function builtEntity(): SecretDoctrineEntity
    {
        $entity = new SecretDoctrineEntity();

        return $entity;
    }

    private static function loadSecretId(Secret $secret, $entity): void
    {
        $entity->setSecretId($secret->getSecretId()->getIdentifier());
    }

    private static function loadMessage(Secret $secret, $entity): void
    {
        $entity->setMessage($secret->getMessage()->getContent());
    }

    private static function loadExpiredAt(Secret $secret, $entity): void
    {
        $expiredAt = $secret->getExpirationDate();
        if (empty($expiredAt)) {
            $expiredAt = new DateTime();
            $expiredAt->add(new DateInterval('PT' . $secret->getExpirationTime()->getSeconds() . 'S'));
        }
        $entity->setExpiredAt($expiredAt);
    }

    private static function loadExpirationTime(Secret $secret, $entity): void
    {
        $entity->setExpirationTime($secret->getExpirationTime()->getSeconds());
    }
}