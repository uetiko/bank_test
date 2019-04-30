<?php
namespace Uetiko\Source\Bank\Usuario\Application;

use Uetiko\Source\Bank\Usuario\Domain\Interfaces\UsuarioRepository;
use Uetiko\Source\Bank\Usuario\Domain\Usuario as UsuarioDomain;
use Uetiko\Source\Bank\Direccion\Domain\Direccion;
use Uetiko\Source\Bank\UsuarioContacto\Domain\Contacto;

class Usuario
{
    /** @var UsuarioDomain $usuario */
    private $usuario = null;
    private $direccion = null;
    private $contacto = null;

    public function __construct(
        UsuarioDomain $usuario, Direccion $direccion, Contacto $contacto
    )
    {
        $this->usuario = $usuario;
        $this->contacto = $contacto;
        $this->direccion = $direccion;
    }

    public function create(UsuarioRepository $repository)
    {
        $repository->save($this->usuario, $this->direccion, $this->contacto);
        return $this->usuario;
    }
}