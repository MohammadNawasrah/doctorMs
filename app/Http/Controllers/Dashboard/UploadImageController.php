<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\ImageHelper;
use Trait\Helpers\RequsetHelper;
use Trait\Helpers\SessionHelper;

class UploadImageController
{
    public function uploadProfileImage(Request $request)
    {
        $userName = session()->get("userName");
        $imageExtensions = ['.jpg', '.jpeg', '.png', '.gif', '.bmp', '.tiff', '.webp'];
        foreach ($imageExtensions  as  $value) {
            $filePath = public_path('image/profile') . "/$userName$value";
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }
        $filename = $userName . '.' . $request->file('file')->extension();
        $request->file('file')->move(public_path('image/profile'), $filename);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, SessionHelper::baseUrl($request) . "/image/profile/$filename");
    }
    public function getUserProfileImage(Request $request)
    {
        $userName = session()->get("userName");
        $imageExtensions = ['.jpg', '.jpeg', '.png', '.gif', '.bmp', '.tiff', '.webp'];
        foreach ($imageExtensions  as  $value) {
            $filePath = public_path('image/profile') . "/$userName$value";
            if (File::exists($filePath)) {
                return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, SessionHelper::baseUrl($request) . "/image/profile/$userName$value");
            }
        }
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, SessionHelper::baseUrl($request) . "/image/profile/tokenusdafiosdajlodsafj.png");
    }
    public function uploadProfileImageForPatient(Request $request)
    {
        $patientToken = $request->input("patientToken");
        $recordId = $request->input("recordId");

        $files = $request->file('files');
        foreach ($files as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();  // Ensure unique filenames
            $file->move(public_path('image/' . "$patientToken/$recordId"), $filename);
            $responseMessages[] = SessionHelper::baseUrl($request) . "/image/$patientToken/$recordId/$filename";
        }

        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, $responseMessages);
    }
}
