<?php
namespace Uetiko\Source\Bank\UsuarioContacto\Domain\Interfaces;


use Uetiko\Source\Bank\UsuarioContacto\Domain\Contacto;
use Uetiko\Source\Bank\UsuarioContacto\Domain\ContactoId;

interface ContactoRepository
{
    public function save(Contacto $contacto): int;

    public function find(ContactoId $id);

    public function update(Contacto $contacto);
}