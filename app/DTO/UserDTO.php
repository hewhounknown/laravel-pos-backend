<?php

namespace App\DTO;

use Illuminate\Support\Str;

class UserDTO
{
    public string $userCode;
    public string $name;
    public string $email;
    public string $phone;
    public string $password;
    public string $role;
    public string $gender;
    public string $address;

    public function __construct($req)
    {
        $this->userCode = $this->generateCode($req->role);
        $this->name = $req->name;
        $this->email = $req->email;
        $this->phone = $req->phone;
        $this->role = $req->role;
        $this->gender = $req->gender;
        $this->address = $req->address;
        $this->password  = $req->password;
    }

    private function generateCode($role)
    {
        $prefix = Str::upper(Str::substr($role, 0, 3));
        $code = $prefix . mt_rand(100, 999);
        return $code;
    }
}
