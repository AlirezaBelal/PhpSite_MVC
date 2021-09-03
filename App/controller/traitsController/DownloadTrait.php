<?php

namespace App\controller\traitsController;

use App\middleware\Validation;

use App\core\Auth;
use App\core\Message;

use App\model\File;


trait DownloadTrait
{

    public function download($request) 
    {
        $data = $request->getBody();

        $checkValid = Validation::toBeRight($data);

        if ($checkValid) {
            $file = (new File())->selectFileById($data['id']);
            if ($file) {
                $file->downloadFile($file->id, $file->count_download + 1);
                $filePath = $file->path;
                header('Content-Type: application/octet-stream');
                header("Content-Transfer-Encoding: Binary");
                header("Content-disposition: attachment; filename=\"" . basename($filePath) . "\"");
                readfile($filePath);
                return $this->redirect("home");
            } else {
                Message::addMessage("File not found in database.", Message::Error);
                return $this->redirect("home", 303);
            }
        } else {
            return $this->redirect("home", 303);
        }
    }
}