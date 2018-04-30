<?php

namespace App\Http\Controllers;

use App\SiteSettings;
use Illuminate\Http\Request;

use App\Http\Requests;

class SettingsController extends Controller
{
    public function seed()
    {
        try {
            $settings = new SiteSettings();
            $settings->key = "p_left";
            $settings->value = "";
            $settings->save();

            $settings = new SiteSettings();
            $settings->key = "p_right";
            $settings->value = "";
            $settings->save();

            $settings = new SiteSettings();
            $settings->key = "news";
            $settings->value = "";
            $settings->save();

            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public static function getP_left(){
        return SiteSettings::where('key','p_left')->value('value');
    }

    public static function getP_right(){
        return SiteSettings::where('key','p_right')->value('value');
    }

    public static function get_news(){
        return SiteSettings::where('key','news')->value('value');
    }


}
