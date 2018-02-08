<?php
namespace langs\langssystem;

use App\Helpers\CustomHelper;
use App\Http\Controllers\Controller;
use langs\langssystem\Models\Lang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;


class LangsController extends Controller
{

    public function index(Request $request,$lang)
    {



        $path = resource_path() . '/lang/' . $lang . '.json';

        $lines = @file_get_contents($path);

        $lines = json_decode($lines, true);


        $lang = $lang;
        // paginator custom can generate bad updates of chains!!!!!
        //  $currentPage = LengthAwarePaginator::resolveCurrentPage();
 
        // // Create a new Laravel collection from the array data
        // $itemCollection = collect($lines);
 
        // // Define how many items we want to be visible in each page
        // $perPage = 10;
 
        // // Slice the collection to get the items to display in current page
        // $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
 
        // // Create our paginator and pass it to the view
        // $lines= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
 
        // // set url path for generted links
        // $lines->setPath($request->url());

        return view('langs::admin.index', compact('lines', 'lang'));
    }




    public function translate(Request $request, $lang)
    {

        $json = $request->all();

        unset($json['_token']);
        // print_r($json);

        $path = resource_path() . '/lang/' . $lang . '.json';

        $pathunlink = unlink($path);

        $newfile = CustomHelper::generateJson($path, $json);

        return back()->with('alert-success', 'The chain has been updated successfully.');

    }

    public function add(Request $request)
    {

        $json = $request->all();

        unset($json['_token']);

        $new   = '' . $json['newkey'] . '';
        $langs = Lang::getLangsCountdos();

        foreach ($langs as $lang) {
            $path = resource_path() . '/lang/' . $lang['name'] . '.json';

            $contents = file_get_contents($path);

            $contentsDecoded = json_decode($contents, true);

            $contentsDecoded[$new] = $new;

            $json = json_encode($contentsDecoded);

            file_put_contents($path, $json);

        }

        return back()->with('alert-success', 'The chain has been added successfully.');

    }

}
