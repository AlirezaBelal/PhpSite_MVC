<?php 

namespace App\controller;

use App\model\File;

use App\core\Auth;


class HomeController extends BaseController
{
    public function index()
    {
        $files = (new File())->fetchTotal();
        $files = json_encode($files);
        return $this->render("home", ['files' => $files, 'isAdmin' => Auth::isUserAdmin()]);
    }
}
