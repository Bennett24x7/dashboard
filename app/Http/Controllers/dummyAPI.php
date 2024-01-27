<?php

namespace App\Http\Controllers;

use App\Models\leads;
use Illuminate\Http\Request;

class dummyAPI extends Controller
{
    function getData(Request $req)
    {
        $leads = new leads;
        $leads->Field_1=$req->fname;
        $leads->Field_2=$req->lname;
        $leads->Field_3=$req->email;
        $leads->Field_4=$req->phone;
        $result = $leads->save();
        if($result){
            return ["result"=>"data has been saved"];
        }
        else
        {
            return ["result"=>"failed"];
        }
    }
}
