<?php


namespace Model\User\Type;


use Doctrine\DBAL\Types\StringType;
use Model\User\DTO\Status;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class StatusType extends StringType
{
    public const NAME = 'user_status';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof Status ? $value->getValue() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return !empty($value) ? new Status($value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

}