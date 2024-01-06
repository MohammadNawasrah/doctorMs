<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\RequsetHelper;

class HtmlCode extends Model
{
    protected $table = "htmlCodeForPage";
    protected $fillable = [
        'pageName',
        "actionName",
        'htmlCode',
    ];
    public static function getHtmlCodeForPage($pageName)
    {
        try {
            $htmlCodesPageData = self::where("pageName", $pageName)->select("actionName", "htmlCode")->get();
            $actions = array();
            foreach ($htmlCodesPageData as $key => $value) {
                $actions[$value["actionName"]] = $value["htmlCode"];
            }
            return $actions;
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, $th->getMessage()));
        }
    }
    public static function getHtmlCodeForPageToUpdateIt($pageName, $actionName, $newData)
    {
        try {
            $htmlCodesPageData = self::where("pageName", $pageName)->where("actionName", $actionName)->firstOrFail();
            $htmlCodesPageData->update([
                "htmlCode" => $newData
            ]);
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, $th->getMessage()));
        }
    }
    public static function updateHtmlCodeByActionName($actionName, $newData)
    {
        try {
            $htmlCodesPageData = self::where("actionName", $actionName)->firstOrFail();
            $htmlCodesPageData->update([
                "htmlCode" => $newData
            ]);
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, $th->getMessage()));
        }
    }
    public static function getAllHtmlCode()
    {
        try {

            return  count(self::all()) > 0 ? self::all() : die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, "No Data In Html Code"));;
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, $th->getMessage()));
        }
    }
}
