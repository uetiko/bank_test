<?php


namespace Uetiko\Source\Shared\Domain\ValueObject;


class id
{
    /** @var int $value */
    private $value = null;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}