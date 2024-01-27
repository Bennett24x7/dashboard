<?php

namespace App\Http\Controllers;

use App\Models\leads;
use Illuminate\Http\Request;

class dummyAPI extends Controller
{
    function getData(Request $req)
    {
        // Basic validation to check if required fields are not empty
        if (empty($req->fname) || empty($req->email)) {
            return ["result" => "Failed: Required fields are empty"];
        }

        $leads = new leads;
        $leads->fname = $req->fname;
        $leads->lname = $req->lname;
        $leads->email = $req->email;
        $leads->phone = $req->phone;

        // Attempt to save the data
        if ($leads->save()) {
            return ["result" => "Data has been saved"];
        } else {
            return ["result" => "Failed to save data"];
        }
    }

    function getMethod()
    {
        return getData::all();
    }
}
