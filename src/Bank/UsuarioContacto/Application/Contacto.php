<?php
namespace Uetiko\Source\Bank\UsuarioContacto\Application;

use Uetiko\Source\Bank\UsuarioContacto\Domain\Contacto as ContactoDomain;
use Uetiko\Source\Bank\UsuarioContacto\Domain\Interfaces\ContactoRepository;

class Contacto
{
    /** @var ContactoDomain $contacto */
    private $contacto = null;

    public function __construct(ContactoDomain $contacto)
    {
        $this->contacto = $contacto;
    }

    public function create(ContactoRepository $repository)
    {
        $repository->save($this->contacto);
        return $this->contacto;
    }
}