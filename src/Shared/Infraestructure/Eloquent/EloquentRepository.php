<?php
namespace Uetiko\Source\Shared\Intrastructure\Eloquent;

use Illuminate\Database\Capsule\Manager;


class EloquentRepository
{
    /** @var Manager $manager */
    private $manager = null;

    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    protected function getManager(): Manager
    {
        return $this->manager;
    }
}