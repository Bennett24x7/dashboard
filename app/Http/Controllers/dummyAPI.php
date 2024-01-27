<?php

namespace App\Http\Controllers;

use App\Models\leads;
use Illuminate\Http\Request;

class dummyAPI extends Controller
{
    function getData(Request $req)
    {
        $leads = new leads;
        $leads->fname=$req->fname;
        $leads->lname=$req->lname;
        $leads->email=$req->email;
        $leads->phone=$req->phone;
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
