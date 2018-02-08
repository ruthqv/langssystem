<?php 
namespace langs\langssystem;

use langs\langssystem\Models\Lang;
use langs\langssystem\Models\LangFields;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\CustomHelper;


class LanguagesController extends Controller {

   public function index()
   {
    
    $languages = Lang::all();

    return view('langs::admin.languages.index')->with('languages', $languages);

   }
  
   public function create()
   {

    return view('admin.languages.create');

   }
 
   public function controlurislang(Request $request)
   {
        $data = $request->all();
        print_r($data);die();
        if(isset($data['id']) && isset($data['type']) && isset($data['id_lang'])){
             $chain = LangFields::where('uri', '=', $data['uriclean'])->where('langstable_id', '!=', $data['id'])->where('langstable_type', '!=', $data['type'])->where('id_lang','!=', $data['id_lang'] )->first();
        }else{
            $chain = LangFields::where('uri', '=', $data['uriclean'])->firstOrFail();
        }
        if(isset($chain) && !empty($chain) ){
            return 'exist'; 
        }    
       
   }
   public function store(Request $request)
    {
        $data = $request->all();

        // Validation
       $this->validate($request, [
            'id' =>'required|unique:langs',
            'id_lang'=>'required|unique:langs',
            'iso_code' => 'required|min:2|max:3',
            'name' => 'required|min:2|max:45',
        ]);

        
        $lang = Lang::create($data);

            $firstlang = Lang::first();

            if(!empty($firstlang['iso_code'])){
                $firstlangfilepath =  resource_path() . '/lang/' . $firstlang['iso_code'] . '.json';   

                $lines = @file_get_contents($firstlangfilepath);
                $lines = json_decode($lines, true);
            }else{
                $lines = '';
            }
                        
            
            $path = resource_path() . '/lang/' . $lang['iso_code'] . '.json';                           
            
            $newfile = CustomHelper::generateJson($path, $lines);

        return redirect(route('admin.languages.index'))->with('alert-success', 'The Language has been added successfully.');
    
    }

    public function destroy($language)
    {      



            
            $filelangtodestroy = Lang::find($language);

            $path = resource_path() . '/lang/' . $filelangtodestroy['iso_code'] . '.json';                           
           
            if(file_exists($path)){
                unlink($path);
            }
            if(count(Lang::all())>1){
            $lang= Lang::destroy($language);
            cache()->forget('languages');

            return redirect(route('admin.languages.index'))->with('alert-success', 'The Language has been removed successfully.');
            }else{

                return redirect(route('admin.languages.index'))->with('alert-danger', 'You cannot remove the first id of languages.');
     
            }

        
    }

    }