<?php


namespace Model\Word\Type;


use Doctrine\DBAL\Types\StringType;
use Model\Word\DTO\Status;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class StatusType extends StringType
{
    public const NAME = 'word_status';

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