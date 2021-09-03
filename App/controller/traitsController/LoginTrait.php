<?php

namespace App\controller\traitsController;

use App\middleware\Validation;

use App\core\Auth;
use App\core\Message;

use App\model\User;


trait LoginTrait
{

    public function login($request) {
        $data = $request->getBody();
        $checkValid = Validation::toBeRight($data);

        if ($checkValid) {
            $user = (new User())->login($data['username'], $data['password']);
            if ($user) {
                if ($user->situation_user === 1) {
                    Auth::checkIn($data['username'], $user->isadmin, $user->isconfirm);
                    Message::addMessage("Sign in to your account.", Message::Successful);
                    return $this->redirect("dashboard");
                } else {
                    Message::addMessage("Your account is block.", Message::Error);
                    return $this->redirect("home");
                }
            } else {
                Message::addMessage("You entered your username and password incorrectly.", Message::Error);
                return $this->redirect("login");
            }
        } else {
            return $this->redirect("login", 303);
        }
    }
}