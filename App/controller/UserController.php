<?php

namespace App\controller;

use App\controller\traitsController\LoginTrait;
use App\controller\traitsController\LogoutTrait;
use App\controller\traitsController\RegisterTrait;
use App\controller\traitsController\UploadTrait;
use App\controller\traitsController\DownloadTrait;

use App\core\Auth;
use App\core\Message;
use App\model\File;


class UserController extends BaseController
{

    use LoginTrait;
    use LogoutTrait;
    use RegisterTrait;
    use UploadTrait;
    use DownloadTrait;


    public function index() {
        if (Auth::checkUser()) {
            $files = (new File())->getUserFiles(Auth::getUserName());
            $files = json_encode($files);
            return $this->render("dashboard", ['name' => Auth::getUserName(), 'files' => $files]);
        } else {
            Message::addMessage("You have not logged in yet.", Message::Wrong);
            return $this->redirect("login", 307);
        }
    }

    public function upload() {
        return $this->render("userFileUpload", ['name' => Auth::getUserName()]);
    }
}