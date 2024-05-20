<?php

namespace App\Services;

use App\DTO\UserDTO;
use App\Repositories\UserRepository;

class UserService
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function create(UserDTO $dto)
    {
        $data = $this->toArr($dto);
        $user = $this->userRepo->createUser($data);
        return $user;
    }

    public function get($id)
    {
        $user = $this->userRepo->getUser($id);
        return $user;
    }

    public function getAll()
    {
        $users = $this->userRepo->getUsers();
        return $users;
    }

    public function update($id, UserDTO $dto)
    {
        $isExist = $this->userRepo->getUser($id);
        if($isExist == null) return "no data to update";

        if($isExist->role == $dto->role){
            $dto->userCode = $isExist->user_code;
        }

        $data = $this->toArr($dto);
        $user = $this->userRepo->updateUser($id, $data);
        return $user;
    }

    public function delete($id)
    {
        $isExist = $this->userRepo->getUser($id);
        if($isExist == null) return "no data to delete";

        $user = $this->userRepo->deleteUser($id);
        return $user;
    }

    private function toArr(UserDTO $dto)
    {
        $arr = [
            'user_code' => $dto->userCode,
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => $dto->password,
            'phone' => $dto->phone,
            'role' => $dto->role,
            'gender' => $dto->gender,
            'address' => $dto->address
        ];

        return $arr;
    }
}
