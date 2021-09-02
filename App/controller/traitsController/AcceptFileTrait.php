<?php

namespace App\controller\traitsController;

use App\middleware\Validation;
use App\core\Message;
use App\model\Request;
use App\model\File;
use App\core\Auth;



//Confirm uploaded files request
trait AcceptFileTrait
{
    //Confirm the file when the request is sent
    public function doAcceptFile($request)
    {
        $data = $request->getBody();

        $checkValid = Validation::validate($data);

        //Check Loll Access to File Verifier
        if (!Auth::isUserConfirm())
        {
            Message::addMessage("Access is blocked.");
            return $this->redirect("home", 303);
        }

        if ($checkValid) {
            $id = $data['id'];

            (new Request())->removeRequest($id);

            if ( (new File())->makeValid($id) ) {
                Message::addMessage("The request was successful.", Message::Successful);
            } else {
                Message::addMessage("An error occurred.", Message::Wrong);
                (new Request())->insertRequest($id);
            }
            return $this->redirect("requests");
        } else {
            return $this->redirect("home", 303);
        }
    }
}