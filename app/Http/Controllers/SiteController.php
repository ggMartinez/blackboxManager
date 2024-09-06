<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;

class SiteController extends Controller
{
    public function Add(Request $request){
        $site = new Site;
        $site->name = $request->post("name");
        $site->url = $request->post("url");
        $site->category = $request->post("category");
        $site->save();
        return redirect('/') ->
            with('success', true) ->
            with('action', 'add') ->
            with('url', $request->url) ->
            with('name', $request->name);
    }


    public function ListForWeb(Request $request){
        $categories = Site::select('category')->distinct()->get();
        $monitors = [];
        foreach($categories as $category){
            $sites = Site::where('category', $category->category)->get();
            $monitors[] = [
                'category' => $category->category,
                'sites' => $sites
            ];
        }

        

        return view('home', ['categorizedMonitors' => $monitors]);
    }

    public function ListForAPI(Request $request){
        $sites =  Site::all();
        foreach($sites as $site){
            $response[] = [
                'targets' => [$site->url],
                'labels' => [
                    'name' => $site->name,
                    'category' => $site->category,
                    'description' => $site->description
                ]
            ];
        }
        return $response;
    }
    
    public function Delete(Request $request, $id){
        $site = Site::findOrFail($id);
        $site->delete();
        return redirect('/') ->
            with('success', true) ->
            with('action', 'delete') ->
            with('url', $site->url) ->
            with('name', $site->name);
    }
}
