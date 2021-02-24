<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeamController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        //
    }

    //
    public function teamotelyCall(Request $request)
    {
        //return $request->all();
        $headers = getallheaders();
        $str = '';
        if(!empty($headers['Authorization']) && $headers['Authorization'] == env('Auth_Key') ){
            if($request->Filter['access_key']=='accessKeyVki478' && $request->Filter['access_key']!=''){
                $tableData = $request->Filter['api_value'];
                if(count($tableData)>0){
                    //return count($tableData);
                    $str.= '<table width="100%"><tbody>';
                    for($i=0;$i<count($tableData);$i++){

                    //return $tableData[$i];
                        $str.='<tr>';
                        for($j=0;$j<count($tableData[$i]);$j++){
                            $str.='<td width="25%">'.$tableData[$i][$j].'</td>';
                        }
                        $str.='</tr>';
                    }
                    $str.= '</tbody></table>';
                    return $str;
                }else{
                    $str.= '<table><tbody></tbody></table>';
                    return $str;
                }
            }else {
                $this->apiArray["authenticate"] = false;
                $this->apiArray["authenticate_message"] = "invalid key";
                return response()->json($this->apiArray);
            }
        }else {
            $this->apiArray["authenticate"] = false;
            $this->apiArray["authenticate_message"] = "invalid authorization";
            return response()->json($this->apiArray);
        }
    }


    public function teamotelycsv(Request $request)
    {
        //return $request->all();
        $headers = getallheaders();
        $str = '';
        if(!empty($headers['Authorization']) && $headers['Authorization'] == env('Auth_Key') ){
            $hasval = app('hash')->make('AshishguptaTeamOtely434525');
            if(Hash::check('AshishguptaTeamOtely434525',$request->Filter['hash_val']) && $request->Filter['hash_val']!=''){
                $tableData = $request->Filter['api_value'];
                $csvData = explode(PHP_EOL, $tableData);
                if($csvData){
                    $str.= '<table width="100%"><tbody>';
                    foreach ($csvData as $key => $value) {
                        # code...
                        $str.='<tr>';
                        $csvDataTable = explode(',', $value);
                        foreach ($csvDataTable as $tablesval){
                             $str.='<td width="25%">'.$tablesval.'</td>';
                        }
                        $str.='</tr>';
                    }
                    $str.= '<tr><td width="25%"><a href="http://localhost/teamotelyfront/public/teamotleycsv">Back</a></td></tr></tbody></table>';
                }
                return $str;
            }else {
                $this->apiArray["authenticate"] = false;
                $this->apiArray["authenticate_message"] = "invalid key";
                return response()->json($this->apiArray);
            }
        }else {
            $this->apiArray["authenticate"] = false;
            $this->apiArray["authenticate_message"] = "invalid authorization";
            return response()->json($this->apiArray);
        }
    }
}
