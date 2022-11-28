<?php

declare(strict_types=1);

namespace App\Repository\UserRpository;

use App\Controller\AbstractController;
use App\Repository\UserRepository;

class UserContrller extends AbstractController
{
    private UserRepository $repository;

    public function __constructor()
    {
        $this->repository = new UserRepository();
    }

    public function list():void
    {
        $users = $this->repository
    }

    public function add():void
    {
        if (true ===  empty($_POST)){
            $this->render('user/add');
            return;
        }

        $password = password_hash($_POST['password'], PASSWORD_ARGON2I);

        $user = new User();
        $user->name = $_POST['name'];
        $user->email = $_POST['email'];
        $user->password = $password;
        $user->profile = $_POST['profile'];

        $this->repository->insert($user);
        $this->redirect('/usuarios/listar');
      
    }
   
   


}