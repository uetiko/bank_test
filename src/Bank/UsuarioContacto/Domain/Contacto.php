<?php
namespace Uetiko\Source\Bank\UsuarioContacto\Domain;


class Contacto
{
    private $id = null;
    private $telefono = null;
    private $correo_electronico = null;
    private $celular = null;

    /**
     * Contacto constructor.
     * @param ContactoId $id
     * @param int $telefono
     * @param int $correo_electronico
     * @param int $celular
     */
    public function __construct(
        ContactoId $id, int $telefono, int $correo_electronico, int $celular
    )
    {
        $this->id = $id;
        $this->celular = $celular;
        $this->telefono = $telefono;
        $this->correo_electronico = $correo_electronico;
    }

    /**
     * @return ContactoId|null
     */
    public function getId(): ?ContactoId
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getTelefono(): ?int
    {
        return $this->telefono;
    }

    /**
     * @return int|null
     */
    public function getCorreoElectronico(): ?int
    {
        return $this->correo_electronico;
    }

    /**
     * @return int|null
     */
    public function getCelular(): ?int
    {
        return $this->celular;
    }


}