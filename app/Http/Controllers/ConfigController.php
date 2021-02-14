<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function store(Request $request)
    {


         $request->validate([
            'name' => 'required|max:255',
             'logo'=>'required|file|mimes:jpeg,png,jpg,svg'
        ]);
        $imageController = new ImageController();
        $logo = $imageController->store($request->logo)->id;

        $config = Config::create([
            "name" => $request->name,
            "logo"=> $logo
        ]);

        return $config;
    }

    //
    public function update(Request $request, $config)
    {

     $request->validate([
            'name' => 'required|max:255',
        ]);

        $config = Config::findorfail($config);
        $config->name = $request->name;

//
        if ($request->hasFile('logo')) {
            $imageController = new ImageController();
            $logo = $imageController->store($request->logo)->id;
            $config->logo = $logo;
        }

        $config->update();

        return $config;
    }

    public function destroy($config)

    {
        Config::findorfail($config)->delete();
    }

    public function restore($config)
    {
        Config::onlyTrashed()->findOrFail($config)->restore();
    }

    public function ajaxOne($config)

    {
        return Config::findorfail($config);
;
    }

    public function ajaxAll()
    {
        return  Config::all();

    }
    public function index()
    {
        return view("admin.pages.configs");
    }
    //
}
