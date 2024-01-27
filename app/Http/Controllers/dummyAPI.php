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

        //Check if a file is uploaded
        if ($req->hasFile('resume')) {
            $file = $req->file('resume');
            $fileName = time() . '_' . $file->getClientOriginalName();
            // Move the uploaded file to a directory within the public folder
            $file->move(public_path('resumes'), $fileName);
            // Save the file name to the database
            $leads->resume = $fileName;
        }

        // Attempt to save the data
        if ($leads->save()) {
            return ["result" => "Data has been saved"];
        } else {
            return ["result" => "Failed to save data"];
        }
    }

    function list()
    {
        return leads::all();
    }
}
