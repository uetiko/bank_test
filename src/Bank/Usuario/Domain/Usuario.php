<?php
namespace Uetiko\Source\Bank\Usuario\Domain;

use Uetiko\Source\Bank\Usuario\Domain\UsuarioId;

final class Usuario
{
    /** @var string $nombre */
    private $nombre = null;
    /** @var string $apellidos */
    private $apellidos = null;
    /** @var UsuarioId $id */
    private $id = null;

    /**
     * Usuario constructor.
     * @param \Uetiko\Source\Bank\Usuario\Domain\UsuarioId $id
     * @param string $nombre
     * @param string $apellidos
     */
    public function __construct(
        UsuarioId $id, string $nombre, string $apellidos
    )
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
    }

    public function getId()
    {
        return $this->id->getValue();
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @return string
     */
    public function getApellidos(): string
    {
        return $this->apellidos;
    }


}