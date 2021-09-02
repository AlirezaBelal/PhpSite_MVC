<?php

namespace App\controller\traitsController;

use App\core\Auth;


trait LogoutTrait
{

    public function logout() {
        Auth::checkOut();
        return $this->redirect("login");
    }
}