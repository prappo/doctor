<?php

namespace App\Http\Controllers;

use App\SiteSettings;
use Illuminate\Http\Request;

use App\Http\Requests;

class SettingsController extends Controller
{

    public function index()
    {
        return view('software.settings');
    }

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

    public static function getP_left()
    {
        return SiteSettings::where('key', 'p_left')->value('value');
    }

    public static function getP_right()
    {
        return SiteSettings::where('key', 'p_right')->value('value');
    }

    public static function get_news()
    {
        return SiteSettings::where('key', 'news')->value('value');
    }

    public function update(Request $request)
    {

        try {
            SiteSettings::where('key', 'news')->update([
                'value' => $request->news
            ]);

            SiteSettings::where('key', 'p_left')->update([
                'value' => $request->p_left
            ]);

            SiteSettings::where('key', 'p_right')->update([
                'value' => $request->p_right
            ]);

            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }


}
