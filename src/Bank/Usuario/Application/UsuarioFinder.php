<?php


namespace Uetiko\Source\Bank\Usuario\Application;


use Uetiko\Source\Bank\Usuario\Domain\Interfaces\UsuarioRepository;
use Uetiko\Source\Bank\Usuario\Domain\UsuarioId;
use Uetiko\Source\Shared\Domain\Exceptions\UserNotFound;

class UsuarioFinder
{
    /** @var UsuarioId $id */
    private $id = null;

    public function __construct(UsuarioId $id)
    {
        $this->id = $id;
    }

    /**
     * @param UsuarioRepository $repository
     * @return \Uetiko\Source\Bank\Usuario\Domain\Usuario
     * @throws UserNotFound
     */
    public function finder(UsuarioRepository $repository)
    {
        return $repository->find($this->id);
    }

}