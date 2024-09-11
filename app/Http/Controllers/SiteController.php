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

    public function Export(Request $request){
        $sites = Site::all();
        if(count($sites) == 0)
            return redirect('/') -> with('error', true) -> with('action','export');
        $response = "name,url,category,description\n";
        foreach($sites as $site){
            $response .= $site->name . "," . $site->url . "," . $site->category . "," . $site->description . "\n";
        }
        return response($response)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="sites.csv"');
    }

    public function Import(Request $request){
        $file = $request->file('file');
        $file->move('uploads', 'sites.csv');
        $file = fopen('uploads/sites.csv', 'r');
        $header = fgetcsv($file);
        while($row = fgetcsv($file)){
            $site = new Site;
            $site->name = $row[0];
            $site->url = $row[1];
            $site->category = $row[2];
            $site->description = $row[3];
            $site->save();
        }
        return redirect('/') -> with('success', true) -> with('action', 'import');
    }
}
