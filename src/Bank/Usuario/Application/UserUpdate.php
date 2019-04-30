<?php
namespace Uetiko\Source\Bank\Usuario\Application;

use Uetiko\Source\Bank\Usuario\Domain\Interfaces\UsuarioRepository;
use Uetiko\Source\Bank\Usuario\Domain\UsuarioId;
use Uetiko\Source\Shared\Domain\Exceptions\UserNotFound;

/**
 * Este es el caso de uso, donde toda la logica de negocio deberá estar.
 *
 * Class UserUpdate
 * @package Uetiko\Source\Bank\Usuario\Application
 */
class UserUpdate
{
    /** @var UsuarioId $id */
    private $id = null;

    public function __construct(UsuarioId $id)
    {
        $this->id = $id;
    }

    /**
     * @param UsuarioRepository $repository
     * @throws UserNotFound
     */
    public function update(UsuarioRepository $repository)
    {
        $repository->update($this->id);
    }

}