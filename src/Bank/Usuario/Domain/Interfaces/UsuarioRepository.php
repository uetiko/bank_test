<?php
namespace Uetiko\Source\Bank\Usuario\Domain\Interfaces;


use Uetiko\Source\Bank\Direccion\Domain\Direccion;
use Uetiko\Source\Bank\Usuario\Domain\Usuario;
use Uetiko\Source\Bank\Usuario\Domain\UsuarioId;
use Uetiko\Source\Bank\UsuarioContacto\Domain\Contacto;
use Uetiko\Source\Shared\Domain\Exceptions\UserNotFound;

interface UsuarioRepository
{
    public function save(
        Usuario $usuario, Direccion $direccion, Contacto $contacto
    ): void;

    /**
     * @param UsuarioId $id
     * @return Usuario
     * @throws UserNotFound
     */
    public function find(UsuarioId $id):Usuario;

    /**
     * @param Usuario $usuario
     * @throws UserNotFound
     */
    public function update(Usuario $usuario): void;
}