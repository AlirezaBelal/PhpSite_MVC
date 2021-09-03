<?php

namespace App\controller\traitsController;

use App\middleware\Validation;

use App\core\Message;
use App\core\Auth;

use App\model\Request;
use App\model\File;

trait DeleteTrait
{
    public function doDelete($request) 
    {
        $data = $request->getBody();

        $checkValid = Validation::toBeRight($data);

        if (!Auth::checkUser())
        {
            Message::addMessage("Access is blocked.");
            return $this->redirect("home", 303);
        }

        if ($checkValid) {
            $id = $data['id'];
            $address = (new File())->selectFileById($id)->path;
            if ( (new File())->removeFile($id) ) {
                unlink($address);
                Message::addMessage("The Delete File was successful.", Message::Successful);
            } else {
                Message::addMessage("An error occurred.", Message::Wrong);
            }
            return $this->redirect("home");
        } else {
            return $this->redirect("home", 303);
        }
    }
}
