<?php

namespace App\Http\Controllers;

use App\DTO\UserDTO;
use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $service)
    {
        $this->userService = $service;
    }
    public function index()
    {
        $users = $this->userService->getAll();
        return response()->json($users, 200);
    }

    public function store(Request $req)
    {
        try {
            $dto = new UserDTO($req);
            $user = $this->userService->create($dto);
            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }

    }

    public function show($id)
    {
        $user = $this->userService->get($id);
        return response()->json($user, 200);
    }

    public function update($id, Request $req)
    {
        $dto = new UserDTO($req);
        $user = $this->userService->update($id, $dto);
        return $this->response($user, 'updated');
    }

    public function destroy($id)
    {
        $user = $this->userService->delete($id);
        return $this->response($user, 'deleted');
    }

    private function response($condition, string $action)
    {
        if($condition == true){
            return response()->json([
                'status' => true,
                'message' => $action . ' success'
            ], 200);
        } else{
            return response()->json([
                'status' => false,
                'message' => 'no data found'
            ], 404);
        }
    }
}
