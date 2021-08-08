<?php

declare(strict_types=1);

namespace Doctrine;

abstract class AbstractFilter
{
    public const PAGE      = 1;
    public const PAGE_SIZE = 10;

    public const ORDER_TYPE_ASC  = 'ASC';
    public const ORDER_TYPE_DESC = 'DESC';
    public const ORDER_TYPE_RAND = 'RAND';

    protected int $page = self::PAGE;
    protected int $pageSize = self::PAGE_SIZE;

    protected string $orderBy = 'id';
    protected string $orderType = self::ORDER_TYPE_ASC;

    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'page':
                    $this->setPage($value);
                    break;
                case 'page_size':
                    $this->setPageSize($value);
                    break;
                case 'order_by':
                    $this->setOrderBy($value);
                    break;
                case 'order_type':
                    $this->setOrderType($value);
                    break;
            }
        }
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPage($page): self
    {
        $page = (int)$page;

        if ($page >= 0) {
            $this->page = $page;
        }

        return $this;
    }

    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    public function setPageSize($pageSize): self
    {
        $this->pageSize = (int)$pageSize;

        return $this;
    }

    public function getOrderBy(): ?string
    {
        return $this->orderBy;
    }

    public function setOrderBy($orderBy): self
    {
        $this->orderBy = (string)$orderBy;

        return $this;
    }

    public function getOrderType(): string
    {
        return $this->orderType;
    }

    public function setOrderType($orderType)
    {
        $this->orderType = (string)$orderType;

        return $this;
    }

    public function getOffset()
    {
        return ($this->getPage() - 1) * $this->getPageSize();
    }
}