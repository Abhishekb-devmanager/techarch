<?php

namespace App\Http\Controllers;

use App\Credits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Response;

class CreditsController extends Controller
{
    const FAV_ACTORS = "favourite_actors";
    
    function index(){
        return response()->json(Credits::get(),200);
    }

    function show($id){
        $credit = Credits::find($id);
        if(is_null($credit)){
             return Response()->json(null, 404);
         }
        return response()->json(Credits::findOrFail($id),200);
    }

    function save(Request $request){

        $rules = [
            'movie_id' => 'required|unique:credits|numeric',
            'title'=> 'required|unique:credits|string',
            'cast'=>'required|string',
            'crew'=>'required|string'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $credit = Credits::create($request->all());
        return response()->json($credit, 201);
    }

    function update(Request $request, Credits $credit){
        $credit->update($request->all());
        return response()->json($credit, 200);
    }

    function delete(Request $request, Credits $credit){
        $credit->delete();
        return response()->json($credit,204);
    }

    function search(Request $request, $userId){
        
        $searchStr = $request->query('searchStr');
        
        // Check for presence of searchStr parameter and its non-nil value
        if(!isset($searchStr)) 
            return response()->json(null,404);

        $searchStringComps = explode($searchStr,',');
        if(count($searchStringComps)>0){
            // Need to implement logic for a comma separated screen
        }
        $credits = Credits::query();

        $result = $credits->select('title')
                          ->where('title', 'LIKE', '%'.$searchStr.'%')
                          ->orwhere('cast', 'LIKE', '%'.$searchStr.'%')
                          ->orwhere('crew', 'LIKE', '%'.$searchStr.'%')
                          ->orderBy('title','asc')
                          ->get();

         $searchResult['results'] = $result;
         return response()->json($searchResult);  
    }

    function searchPref($preferencesArray, $prefType = "favourite_actors"){
        
        $resultArr = array();
        $credits = Credits::query();
        

        $finalQuery = $this->getQuerySting();

        
        $result =  DB::table('credits')
                        ->select('credits.title')
                        ->whereRaw($finalQuery)
                        ->orderBy('credits.title')
                        ->groupBy('credits.id')
                        ->get();
        /*                
        DB::enableQueryLog();
            
        $actorSQ = "JSON_SEARCH(credits.cast,'one','Denzel Washington') IS NOT NULL";
        $directorSQ = "JSON_SEARCH(credits.crew,'one','Steven Spielberg') IS NOT NULL";

        $result =  DB::table('credits')
                        ->select('credits.title')
                        ->whereRaw($actorSQ)
                        ->orWhereRaw($directorSQ)
                        ->orderBy('credits.title')
                        ->groupBy('credits.id')
                        ->get();
        
        dd(DB::getQueryLog());
        //dd(json_decode($result));
        //}
        */
        array_push($resultArr,$result);
        $searchResult['results'] = $resultArr;  
        echo count($searchResult['results'][0]);
        return $searchResult;
    }

    function searchFor(Request $request, $type){
        $typeStr = $request->query('type');
        $searchResult=[];

        switch ($typeStr) {
             case '1':
                 $preferencesArray = array("Denzel Washington",
                                  "Kate Winslet",
                                  "Emma Suárez",
                                  "Tom Hanks");
                 $searchResult = $this->searchPref($preferencesArray);
                 break;
            
            case '2':
                 $preferencesArray = array("Steven Spielberg",
                                            "Martin Scorsese",
                                            "Pedro Almodóvar");
                 $searchResult = $this->searchPref($preferencesArray);
                 break;
            
             default:
                 break;
        }
        return response()->json($searchResult);
    }

    /*
        function to generate different query string based on different types of searches criteria 
        for eg. user preferences, fav actors, directors or a combination of both
    */
    function getQuerySting($prefType = Config::get('constants.fav_actors')){
        //if(empty($prefType))
            // $prefType = Config::get('constants.fav_actors');

            switch ($prefType) {
                case Config::get('constants.fav_actors'):

                    $queryp1 ="JSON_SEARCH(credits.cast,'one',";
                    $queryp2 = ") IS NOT NULL";
                    $operator = " or ";
                    $finalQuery = "";
                
                foreach($preferencesArray as $key => $pref){
                    
                    $finalQuery = $finalQuery.$queryp1."'".$pref."'".$queryp2;
                    
                    end($preferencesArray);
        
                    if ($key !== key($preferencesArray))
                        $finalQuery = $finalQuery.$operator;
                    
                }
                echo $finalQuery;
        
                    break;
               
                case Config::get('constants.fav_directors'):
                    $preferencesArray = array("Steven Spielberg",
                                               "Martin Scorsese",
                                               "Pedro Almodóvar");
                    $searchResult = $this->searchPref($preferencesArray);
                    break;
                
                case Config::get('constants.fav_actors_directors'):


                    break;

                default:
                    break;


    }
}
