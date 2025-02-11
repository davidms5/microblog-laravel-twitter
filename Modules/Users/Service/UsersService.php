<?php

namespace Modules\Users\Service;

use Exception;
use Modules\Users\Repository\UsersRepository;

class UsersService 
{
    protected $usersRepository;

    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    public function storeUsuario($request)
    {
        try {
            $this->usersRepository->storeUsuario($request);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function listarUsuarios()
    {
        try {
            $usuarios = $this->usersRepository->listarUsuarios();
            if(count($usuarios) === 0) throw new Exception("no se encontraron usuarios registrados", 404);

            return $usuarios;
        } catch (\Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}