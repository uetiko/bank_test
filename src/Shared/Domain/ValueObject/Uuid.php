<?php
namespace Uetiko\Source\Shared\Domain\ValueObject;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid
{
    /** @var string $value */
    private $value = null;

    /**
     * Uuid constructor.
     * @param string $value
     * @throws InvalidArgumentException
     */
    public function __construct(string $value)
    {
        $this->isValid($value);
        $this->value = $value;
    }

    /**
     * @return Uuid
     */
    static public function random(): self
    {
        return new static(RamseyUuid::uuid4()->toString());
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $uuid
     * @throws InvalidArgumentException
     */
    private function isValid(string $uuid): void
    {
        if (!RamseyUuid::isValid($uuid)) {
            throw new InvalidArgumentException(
                "El valor {$uuid} no es valido"
            );
        }
    }

    public function __toString(): string
    {
        return $this->getValue();
    }
}