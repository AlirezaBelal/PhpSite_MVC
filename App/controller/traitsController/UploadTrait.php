<?php 

namespace App\controller\traitsController;

use App\core\Application;
use App\middleware\FileControl;
use App\middleware\Validation;
use App\core\Auth;
use App\core\Message;
use App\model\File;
use App\model\Request;


trait UploadTrait
{

    public function uploadFile($request) {
        $data = $request->getBody();

        $checkValid = Validation::toBeRight($data);

        if (!$checkValid) {
            return $this->redirect("upload");
        }

        $dirUpload = Application::$ROOT . "/App/File_uploads/";

        if (!file_exists($dirUpload)) {
            mkdir($dirUpload, 0777, true);
        }

        $path = $_FILES['file']['name'];
        $FileType = pathinfo($path, PATHINFO_EXTENSION);

        $nameUpload = "file" . time() . "." . $FileType;
        $fileUpload = $dirUpload . $nameUpload;

        $fileUpload = str_replace("\\", "/", $fileUpload);

        if (!FileControl::validate($_FILES["file"]["size"], $FileType)) {
            return $this->redirect("upload");
        }

        $user = Auth::getUserName();
        $time_expire = "";

        if ($user == "Guest") {
            $time_expire = date(time() + 5000);
        }

        $file = (new File())->uploadFile($data["name"], $fileUpload, $user, $FileType, $_FILES["file"]["size"], $time_expire);


        if ($file != -1) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $fileUpload)) {
                (new Request())->insertRequest($file);
                Message::addMessage("Your files have been uploaded successfully. Wait for confirmation", Message::Successful);
                return $this->redirect("home");
            } else {
                (new File())->removeFile($file);
                Message::addMessage("UploadTrait operation failed", Message::Error);
                return $this->redirect("upload");
            }
        } else {
            Message::addMessage("UploadTrait operation failed", Message::Error);
            return $this->redirect("upload");
        }
    }
}