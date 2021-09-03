<?php

namespace App\controller\traitsController;

use App\middleware\Validation;
use App\core\Message;
use App\model\User;
use App\core\Auth;

//Access for site admin
trait ConfirmTrait
{
    //Operation change operation
    public function Accessoperations ($data , $situation_user){
        if ((new User())->changeConfirm($data['name'], $situation_user)) {
            Message::addMessage("The change Level was successful.", Message::Successful);
        } else {
            Message::addMessage("An error occurred.", Message::Error);
        }
        return $this->redirect("users");
    }


    //Update user access
    public function updateUser($request)
    {
        $data = $request->getBody();

        $checkValid = Validation::toBeRight($data);

        //Access check user
        if (!Auth::isUserAdmin())
        {
            Message::addMessage("Access is blocked.");
            return $this->redirect("home", 303);
        }

        //Change access level
        if ($checkValid) $this->Accessoperations($data , 1);
        else return $this->redirect("users", 307);

    }

    //Get access from the file verifier
    public function downUser($request)
    {
        $data = $request->getBody();

        $checkValid = Validation::toBeRight($data);

        if (!Auth::isUserAdmin())
        {
            Message::addMessage("");
            return $this->redirect("home", 303);
        }

        //Change access level
        if ($checkValid) $this->Accessoperations($data , 0);
        else return $this->redirect("users", 307);
    }
}