<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\RequsetHelper;

class UserType extends Model
{
    protected $table = "type_of_user";
    protected $fillable = [
        'type',
    ];
    public static function addType($type)
    {
        try {
            if (session()->has('token')) {
                self::where("type", strtolower($type))->firstOrFail();
                die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Type already exsit"));
            }
        } catch (\Throwable $th) {
            self::create([
                "type" => strtolower($type)
            ]);
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Add Type Successfully"));
        }
    }
}
