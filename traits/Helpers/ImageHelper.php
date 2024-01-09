<?php

namespace Trait\Helpers;

class ImageHelper
{
    // public function saveFilesAction()
    // {
    //     if (empty($_FILES)) {
    //         die(json_encode(["status" => HttpStatusCodes::HTTP_NOT_FOUND, "message" => "Please Select File To Upload"]));
    //     }
    //     if (!isset($_POST["serial"])) {
    //         die(json_encode(["status" => HttpStatusCodes::HTTP_NOT_FOUND, "message" => "Serial Not found"]));
    //     }
    //     $mainDirectory = getcwd();
    //     $dataDirectory = self::createDirectory($mainDirectory, "data");
    //     $response = array();
    //     if ($dataDirectory["status"] == HttpStatusCodes::HTTP_NOT_FOUND)
    //         die(json_encode(["status" => HttpStatusCodes::HTTP_NOT_FOUND, "message" => "Data Directory Can't Create"]));
    //     $tasksDirectory = self::createDirectory($dataDirectory["path"], "tasks");
    //     if ($tasksDirectory["status"] == HttpStatusCodes::HTTP_NOT_FOUND)
    //         die(json_encode(["status" => HttpStatusCodes::HTTP_NOT_FOUND, "message" => "Tasks Directory Can't Create"]));

    //     $serial = $_POST["serial"];
    //     $serialTask = self::createDirectory($tasksDirectory["path"], $serial);
    //     if ($serialTask["status"] == HttpStatusCodes::HTTP_NOT_FOUND)
    //         die(json_encode(["status" => HttpStatusCodes::HTTP_NOT_FOUND, "message" => "$serial  Directory Can't Create"]));
    //     $countFileUpload = 0;
    //     foreach ($_FILES['files']['tmp_name'] as $key => $tmpName) {
    //         $baseName = basename($_FILES['files']['name'][$key]);
    //         if (!self::isAllowedFileExtension($baseName))
    //             continue;
    //         $newFilename = self::generateUniqueFilename($baseName, $serialTask["path"]);;
    //         $targetFile = $serialTask["path"] . $newFilename;
    //         self::uploadFile($tmpName, $key, $targetFile);
    //         array_push($response,  ["data" => $newFilename]);
    //         $countFileUpload++;
    //     }
    //     if ($countFileUpload == 0) {
    //         die(json_encode(["status" => HttpStatusCodes::HTTP_OK, "message" => "must be file image or *.docx or *.pdf"]));
    //     }
    //     die(json_encode(["status" => HttpStatusCodes::HTTP_OK, "message" => "upLoadSucessfully", "data" => $response]));
    // }
    // public function deleteFileAction()
    // {
    //     if (!isset($_POST["serial"])) {
    //         die(json_encode(["status" => HttpStatusCodes::HTTP_NOT_FOUND, "message" => "Serial Not found"]));
    //     }
    //     if (!isset($_POST["fileName"])) {
    //         die(json_encode(["status" => HttpStatusCodes::HTTP_NOT_FOUND, "message" => "fileName Not found"]));
    //     }
    //     $fileDirectory = getcwd() . "/data/tasks/" . $_POST["serial"] . "/" . $_POST["fileName"];
    //     if (file_exists($fileDirectory)) {
    //         // Attempt to delete the file
    //         if (unlink($fileDirectory)) {
    //             die(json_encode(["status" => HttpStatusCodes::HTTP_OK, "message" => "File Deleted successfully"]));
    //         }
    //         die(json_encode(["status" => HttpStatusCodes::HTTP_NOT_FOUND, "message" => "File Deleted Faild"]));
    //     }
    //     die(json_encode(["status" => HttpStatusCodes::HTTP_NOT_FOUND, "message" => "File Not Exist"]));
    // }
    public static function isAllowedFileExtension($filename)
    {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'docx'];
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $lowercaseExtension = strtolower($extension);
        return in_array($lowercaseExtension, $allowedExtensions);
    }
    public static function getFiles($serial)
    {
        $mainDirectory = getcwd() . "/data";
        if (!is_dir($mainDirectory))
            return (json_encode(["status" => HttpStatusCodes::HTTP_NOT_FOUND, "message" => "Data Directory NotFound"]));
        $mainDirectory = $mainDirectory . "/tasks";
        if (!is_dir($mainDirectory))
            return (json_encode(["status" => HttpStatusCodes::HTTP_NOT_FOUND, "message" => "tasks Directory NotFound"]));
        $mainDirectory = $mainDirectory . "/" . $serial;
        if (!is_dir($mainDirectory))
            return (json_encode(["status" => HttpStatusCodes::HTTP_NOT_FOUND, "message" => $serial . " Directory NotFound"]));
        $files = scandir($mainDirectory);
        $files = array_diff($files, array('.', '..'));
        return ["status" => HttpStatusCodes::HTTP_OK, "message" => "Fetch files Successfully", "data" => $files];
    }
    static function generateUniqueFilename($filename, $directory)
    {
        $number = 1;
        $originalFilename = $filename;
        while (file_exists($directory . DIRECTORY_SEPARATOR . $filename)) {
            $filename = self::incrementFilename($originalFilename, $number++);
        }
        return $filename;
    }
    static function incrementFilename($filename, $number)
    {
        $info = pathinfo($filename);
        $extension = isset($info['extension']) ? '.' . $info['extension'] : '';
        $baseFilename = isset($info['filename']) ? $info['filename'] : $filename;

        return $baseFilename . "($number)" . $extension;
    }
    public static function uploadFile($tmpName, $key, $targetFile)
    {
        if (move_uploaded_file($tmpName, $targetFile)) {
            return "File '{$targetFile}' uploaded successfully!<br>";
        }
        return "Error uploading file '{$_FILES['files']['name'][$key]}'.<br>";
    }
    public static function createDirectory($path, $directoryName)
    {
        if (!file_exists($path . "/$directoryName")) {
            if (mkdir($path . "/$directoryName", 0755, true)) {
                return ["status" => HttpStatusCodes::HTTP_OK, "path" => $path . "/$directoryName/"];
            } else {
                return ["status" => HttpStatusCodes::HTTP_NOT_FOUND];
            }
        } else {
            return ["status" => HttpStatusCodes::HTTP_ACCEPTED, "path" => $path . "/$directoryName/"];
        }
    }
}

// <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
// <div class="modal-dialog">
//     <div class="modal-content">
//         <div class="modal-header">
//             <h5 class="modal-title" id="ModalLabel">photo</h5>
//             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
//         </div>
//         <div class="modal-body w-100" style="height: 50;">
//             <div class="container mt-5">
//                 <h2 class="mb-4">Image Upload Profile personly</h2>

//                 <form action="upload.php" method="post" enctype="multipart/form-data">
//                     <div class="mb-3">
//                         <label for="image" class="form-label">Choose Image</label>
//                         <input type="file" class="form-control w-50" id="image" name="image" accept="image/*">
//                     </div>

//                     <button type="submit" class="btn btn-primary">Upload Image</button>
//                 </form>
//             </div>

//         </div>
//     </div>
// </div>
// </div>