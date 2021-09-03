<?php

namespace App\controller\traitsController;

use App\middleware\Validation;
use App\core\Message;
use App\model\User;
use App\core\Auth;

//unblock User
trait UnBlockTrait
{
    //1->active
    public function unblock($request)
    {
        $data = $request->getBody();
        $checkValid = Validation::toBeRight($data);

        //Access check
        if (!Auth::isUserAdmin())
        {
            Message::addMessage("Access is blocked.");
            return $this->redirect("home", 303);
        }

        if ($checkValid) {
            if ((new User())->blockByName($data['name'], 1)) {
                Message::addMessage("unblocking user completed successfully", Message::Successful);
            } else {
                Message::addMessage("Failed to unblocking user", Message::Error);
            }
            return $this->redirect("users");
        } else {
            return $this->redirect("users", 307);
        }
    }
}

