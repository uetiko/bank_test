<?php
namespace Uetiko\Source\Bank\UsuarioContacto\Domain\Interfaces;


use Uetiko\Source\Bank\UsuarioContacto\Domain\Contacto;

interface ContactoRepository
{
    public function save(Contacto $contacto): void;
}