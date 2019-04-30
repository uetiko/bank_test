<?php
namespace Uetiko\Source\Bank\Usuario\Infrastructure;

use DateTime;
use Illuminate\Database\Capsule\Manager;
use Uetiko\Source\Bank\Direccion\Domain\Direccion;
use Uetiko\Source\Bank\Direccion\Domain\Interfaces\DireccionRepository;
use Uetiko\Source\Bank\Usuario\Domain\Usuario;
use Uetiko\Source\Bank\Usuario\Domain\UsuarioId;
use Uetiko\Source\Bank\UsuarioContacto\Domain\Contacto;
use Uetiko\Source\Bank\Usuario\Domain\Interfaces\UsuarioRepository as RepositoryDomain;
use Uetiko\Source\Bank\UsuarioContacto\Infrastructure\ContactoRepository;
use Uetiko\Source\Shared\Domain\Exceptions\UserNotFound;
use Uetiko\Source\Shared\Intrastructure\Eloquent\EloquentRepository;

/**
 * Class UsuarioRepository
 * @package Uetiko\Source\Bank\UsuarioCreate\Infrastructure
 */
class UsuarioRepository extends EloquentRepository implements RepositoryDomain
{
    /** @var ContactoRepository $contactoRepository */
    private $contactoRepository = null;
    /** @var DireccionRepository $direccionRepository */
    private $direccionRepository = null;

    public function __construct(
        Manager $manager, ContactoRepository $contactoRepository,
        DireccionRepository $direccionRepository
    )
    {
        parent::__construct($manager);
        $this->contactoRepository = $contactoRepository;
        $this->direccionRepository = $direccionRepository;
    }

    /**
     * @param Usuario $usuario
     * @param Direccion $direccion
     * @param Contacto $contacto
     * @throws \Exception
     */
    public function save(Usuario $usuario, Direccion $direccion, Contacto $contacto): void
    {
        $contacto_id = $this->contactoRepository->save($contacto);

        $direccion_id = $this->direccionRepository->save($direccion);

        $this->getManager()::table('usuario')->insertGetId([
            'id' => $usuario,
            'nombre' => $usuario->getNombre(),
            'apellido' => $usuario->getApellidos(),
            'create_at' => new DateTime(),
            'update_at' => new DateTime(),
            'direccion_id' => $direccion_id,
            'datos_contacto' => $contacto_id
        ]);
    }

    /**
     * @param UsuarioId $id
     * @return Usuario
     * @throws UserNotFound
     */
    public function find(UsuarioId $id): Usuario
    {
        $user = $this->getManager()::table('usuario')
            ->where('id', $id->getValue())
            ->first();

        if (Null === $user){
            throw new UserNotFound();
        }

        $id = new UsuarioId($user->id);
        return new Usuario($id, $user->nombre, $user->apellido);
    }

    /**
     * @param Usuario $usuario
     * @throws UserNotFound
     */
    public function update(Usuario $usuario):void {
        try {
            $this->getManager()::table('usuario')
                ->where('id', $usuario->getId())
                ->update([
                    'nombre' => $usuario->getNombre(),
                    'apellido' => $usuario->getApellidos(),
                    'update_at' => new DateTime()
                ]);
        } catch (\Exception $e){
            throw new UserNotFound($e);
        }
    }
}