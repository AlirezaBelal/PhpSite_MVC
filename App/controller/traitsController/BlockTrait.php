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
        $checkValid = Validation::toBeRight($data);

        //Access check
        if (!Auth::isUserAdmin())
        {
            Message::addMessage("Access is blocked.");
            return $this->redirect("home", 303);
        }


        //0 -> block
        if ($checkValid) {
            if ((new User())->blockByName($data['name'], 0)) {
                Message::addMessage("blocking user completed successfully", Message::Wrong);
            } else {
                Message::addMessage("Failed to blocking user", Message::Error);
            }
            return $this->redirect("users");
        } else {
            return $this->redirect("users", 307);
        }
    }

}

