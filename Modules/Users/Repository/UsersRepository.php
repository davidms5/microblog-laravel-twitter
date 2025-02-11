<?php

namespace Modules\Users\Repository;

use Exception;
use Modules\Users\Entities\Usuarios;

class UsersRepository 
{
    public function storeUsuario($request)
    {
        try {
            $name = $request["name"];
            $email = $request["email"];
            Usuarios::create(["name" => $name, "email" => $email]);

        } catch (\Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function listarUsuarios()
    {
        try {
            return Usuarios::select('id', 'name', 'email')->get()->toArray();
        } catch (\Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}