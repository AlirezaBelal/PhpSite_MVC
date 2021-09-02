<?php 

namespace App\controller\traitsController;

use App\middleware\Validation;
use App\core\Message;
use App\model\User;
use App\core\Auth;

//Block User and unblock User
trait BlockTrait
{

    public function block($request)
    {
        $data = $request->getBody();

        $checkValid = Validation::validate($data);

        if (!Auth::isUserAdmin())
        {
            Message::addMessage("Access is blocked.");
            return $this->redirect("home", 303);
        }

        if ($checkValid) {
            if ((new User())->lockByName($data['name'], 0)) {
                Message::addMessage("blocking user completed successfully", Message::Wrong);
            } else {
                Message::addMessage("Failed to blocking user", Message::ERROR);
            }
            return $this->redirect("users");
        } else {
            return $this->redirect("users", 307);
        }
    }


    public function unblock($request)
    {
        $data = $request->getBody();

        $checkValid = Validation::validate($data);

        if (!Auth::isUserAdmin())
        {
            Message::addMessage("Access is blocked.");
            return $this->redirect("home", 303);
        }

        if ($checkValid) {
            if ((new User())->lockByName($data['name'], 1)) {
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

