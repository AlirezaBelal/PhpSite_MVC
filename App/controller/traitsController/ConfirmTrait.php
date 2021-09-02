<?php

namespace App\controller\traitsController;

use App\middleware\Validation;
use App\core\Message;
use App\model\User;
use App\core\Auth;


trait ConfirmTrait
{
    //Update user access
    public function updateUser($request)
    {
        $data = $request->getBody();

        $checkValid = Validation::validate($data);

        //Access check user
        if (!Auth::isUserAdmin())
        {
            Message::addMessage("Access is blocked.");
            return $this->redirect("home", 303);
        }

        if ($checkValid) {
            if ((new User())->changeConfirm($data['name'], 1)) {
                Message::addMessage("The Upgrade Level was successful.", Message::Successful);
            } else {
                Message::addMessage("An error occurred.", Message::Error);
            }
            return $this->redirect("users");
        } else {
            return $this->redirect("users", 307);
        }
    }

    //Get access from the file verifier
    public function downUser($request)
    {
        $data = $request->getBody();

        $checkValid = Validation::validate($data);

        if (!Auth::isUserAdmin())
        {
            Message::addMessage("");
            return $this->redirect("home", 303);
        }

        if ($checkValid) {
            if ((new User())->changeConfirm($data['name'], 0)) {
                Message::addMessage("The Reduc Level was successful.", Message::Wrong);
            } else {
                Message::addMessage("An error occurred.", Message::Error);
            }
            return $this->redirect("users");
        } else {
            return $this->redirect("users", 307);
        }
    }
}