<?php

namespace Modules\Users\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Users\App\Http\Requests\StoreUserRequest;
use Modules\Users\Service\UsersService;

class UsersController extends Controller
{
    protected $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users::index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeUsuario(StoreUserRequest $request)
    {
        try {
            return response()->json($this->usersService->storeUsuario($request), 201);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function listarUsuarios()
    {
        try {
            $usuarios = $this->usersService->listarUsuarios();

            return response()->json([
                'success' => true,
                'data' => $usuarios
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('users::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('users::edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
