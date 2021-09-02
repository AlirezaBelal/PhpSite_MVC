<?php 

namespace App\controller;

use App\core\Auth;
use App\core\Message;

use App\model\User;
use App\model\Request;

use App\controller\traitsController\AcceptFileTrait;
use App\controller\traitsController\DeleteTrait;
use App\controller\traitsController\BlockTrait;
use App\controller\traitsController\ConfirmTrait;



class AdminController extends BaseController
{
    // traitsController
    use AcceptFileTrait;
    use DeleteTrait;
    use BlockTrait;
    use ConfirmTrait;

    public function requests() {
        if (Auth::isUserConfirm()) {
            $requests = (new Request)->getRequestData();
            $requests = json_encode($requests);
            return $this->render("requests", ['requests' => $requests]);
        } else {
            Message::addMessage("Forbidden for you.", Message::Wrong);
            return $this->redirect("home", 307);
        }
    }

    public function users() {
        if (Auth::isUserAdmin()) {
            $users = (new User)->fetchTotal();
            foreach($users as $user) {
                unset($user->password);
            }
            $users = json_encode($users);
            return $this->render("users", ['users' => $users, 'Online_admin' => Auth::getUserName()]);
        } else {
            Message::addMessage("Can't access this page.", Message::WARN);
            return $this->redirect("home", 307);
        }
    }
}

?>