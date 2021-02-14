<?php

namespace App\Http\Controllers;

use App\Models\ThemeConfig;
use Illuminate\Http\Request;

class ThemeConfigController extends Controller
{
    public function store(Request $request)
    {


        $config = ThemeConfig::create([
            "first_color" => $request->first_color,
            "second_color" => $request->second_color,
            "third_color" => $request->third_color,
            "fourth_color" => $request->fourth_color,
        ]);

        return $config;
    }

    //
    public function update(Request $request, $config)
    {

        $config = ThemeConfig::findorfail($config);
        $config->update([
            "first_color" => $request->first_color,
            "second_color" => $request->second_color,
            "third_color" => $request->third_color,
            "fourth_color" => $request->fourth_color,
        ]);


        return $config;
    }

    public function destroy($config)

    {
        ThemeConfig::findorfail($config)->delete();
    }

    public function restore($config)
    {
        ThemeConfig::onlyTrashed()->findOrFail($config)->restore();
    }

    public function ajaxOne($config)

    {
        return ThemeConfig::findorfail($config);
    }

    public function ajaxAll()
    {
        return  ThemeConfig::all();;

    }
    //
}
