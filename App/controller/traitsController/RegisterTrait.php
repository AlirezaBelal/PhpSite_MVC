<?php

namespace App\controller\traitsController;

use App\middleware\Validation;
use App\core\Auth;
use App\core\Message;
use App\model\User;


trait RegisterTrait
{

    public function register($request) {
        $data = $request->getBody();

        $checkValid = Validation::toBeRight($data);

//        $checkUser = $data
        if ($checkValid) {
            $user = (new User())->register($data['username'], $data['password']);
            if ($user == -1) {
                Message::addMessage("Registration was unsuccessful", Message::Error);
                return $this->redirect("register", 303);
            } else {
                Message::addMessage("Registration completed successfully.", Message::Successful);
                return $this->redirect("login");
            }
        } else {
            return $this->redirect("register", 303);
        }
    }
}