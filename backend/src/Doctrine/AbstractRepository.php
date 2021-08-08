<?php

declare(strict_types=1);

namespace Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Mapping\ClassMetadata;

abstract class AbstractRepository
{
    protected ClassMetadata $classMetadata;
    protected EntityManagerInterface $entityManager;
    protected string $tableName;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
        $this->classMetadata = $this->entityManager->getClassMetadata($this->getEntityName());
        $this->tableName = 't';
    }

    abstract protected function getEntityName(): string;

    protected function applyOrder(QueryBuilder $queryBuilder, ?AbstractFilter $filter = null)
    {
        if ($filter instanceof AbstractFilter) {
            $orderColumn = $filter->getOrderBy();

            if ($filter->getOrderType() === AbstractFilter::ORDER_TYPE_RAND) {
                $queryBuilder->orderBy('rand()');
            } elseif (in_array($this->classMetadata->getFieldName($orderColumn), $this->classMetadata->getFieldNames())) {
                $queryBuilder->orderBy($this->tableName . '.' . $this->classMetadata->getFieldName($orderColumn), $filter->getOrderType());
            }
        }
    }

    protected function applyFilter(QueryBuilder $queryBuilder, ?AbstractFilter $filter = null)
    {
        if ($filter instanceof AbstractFilter) {
            $queryBuilder->setFirstResult($filter->getOffset());
            $queryBuilder->setMaxResults($filter->getPageSize() !== 0 ? $filter->getPageSize() : null);
        }
    }

    protected function getFieldName(string $fieldName)
    {
        return $this->tableName . '.' . $fieldName;
    }

    protected function getQueryBuilder(): QueryBuilder
    {
        return new QueryBuilder($this->entityManager);
    }

    protected function getSelectQueryBuilder(): QueryBuilder
    {
        return $this->getQueryBuilder()
            ->from($this->getEntityName(), $this->tableName)
            ->select($this->tableName);
    }

    protected function leftJoin(
        QueryBuilder $queryBuilder,
        string $join,
        string $alias,
        ?string $conditionType = null,
        ?string $condition = null,
        ?string $indexBy = null
    ): void {
        if (!in_array($alias, $queryBuilder->getAllAliases())) {
            $queryBuilder->leftJoin($join, $alias, $conditionType, $condition, $indexBy);
        }
    }
}