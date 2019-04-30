<?php
namespace Uetiko\Source\Bank\Usuario\Domain\Interfaces;


use Uetiko\Source\Bank\Direccion\Domain\Direccion;
use Uetiko\Source\Bank\Usuario\Domain\Usuario;
use Uetiko\Source\Bank\Usuario\Domain\UsuarioId;
use Uetiko\Source\Bank\UsuarioContacto\Domain\Contacto;

interface UsuarioRepository
{
    public function save(
        Usuario $usuario, Direccion $direccion, Contacto $contacto
    ): void;

    public function find(UsuarioId $id):?Usuario;
}