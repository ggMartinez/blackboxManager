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
        
        $site->relevant = $request->post("relevant") ? true : false;

        if($request->post("username") != null){
            $site->username = $request->post("username");
            $site->password = base64_encode($request->post("password"));
        }

        $site->save();
        return redirect('/') ->
            with('success', true) ->
            with('action', 'add') ->
            with('url', $request->url) ->
            with('name', $request->name);
    }

    public function Update(Request $request){
        $site = Site::findOrFail($request->post("id"));
        $site->name = $request->post("name");
        $site->url = $request->post("url");
        $site->category = $request->post("category");
        $site->relevant = $request->post("relevant") ? true : false;
        $site->username = null;
        $site->password = null;

        if($request->post("username") != null){
            $site->username = $request->post("username");
            $site->password = base64_encode($request->post("password"));
        }
        $site->save();
        return redirect('/') ->
            with('success', true) ->
            with('action', 'update') ->
            with('url', $request->url) ->
            with('name', $request->name);
    }


    public function ListForWeb(Request $request){
        $categories = Site::select('category')->distinct()->get();
        $monitors = $this -> generateSitesForWeb($categories);
        return view('home', ['categorizedMonitors' => $monitors]);
    }

    public function ListForAPI(Request $request){
        $sites =  Site::all();
        $responses = $this -> generateSitesJson($sites);
        return $responses;
    }
    
    private function generateSitesForWeb($categories){
        $monitors = [];
        foreach($categories as $category){
            $sites = Site::where('category', $category->category)->get();
            $monitors[] = [
                'category' => $category->category,
                'sites' => $sites
            ];
        }
        return $monitors;
    }
    private function generateSitesJson($sites){
        $responses = [];
        foreach($sites as $site){
            $response = [
                'targets' => [$this -> generateTarget($site)],
                'labels' => [
                    'url' => $site->url,
                    'name' => $site->name,
                    'category' => $site->category,
                    'description' => $site->description,
                    'relevant' => $site->relevant ? "true" : "false"
                ]
            ];
            array_push($responses, $response);
        }
        return $responses;
    }


    private function generateTarget($site){
        if( $site -> username != null){
            $url = explode("://", $site -> url);
            return $url[0] . "://" . $site->username . ":" . base64_decode($site->password) . "@" . $url[1];
        }
        return $site -> url;
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
        if(count($sites) == 0) return redirect('/') -> with('error', true) -> with('action','export');
        $response = "name,url,category,description,username,password,relevant\n";

        foreach($sites as $site) {
            $response .= $site->name . "," . $site->url . "," . $site->category . "," . $site->description . "," . $site->username . "," . $site->password . "," . ($site->relevant ? '1' : '0') . "\n";
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
            $site->username = (isset($row[4]) && $row[4] !== '') ? $row[4] : null;
            $site->password = (isset($row[5]) && $row[5] !== '') ? $row[5] : null;
            $site->relevant = (isset($row[6]) && $row[6] !== '') ? (bool)$row[6] : null;
            $site->save();
        }
        return redirect('/') -> with('success', true) -> with('action', 'import');
    }
}
