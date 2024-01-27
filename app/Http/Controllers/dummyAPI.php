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

        // Check if a file is uploaded
        if ($req->hasFile('resume')) {
            // Access the file using $req->file('resume')
            $file = $req->file('resume');
            // Store the uploaded file in the specified directory
            $upload_file = $file->store('public/resume');

            // Create a new leads instance
            $leads = new leads;
            // Assign values to the leads instance properties
            $leads->fname = $req->fname;
            $leads->lname = $req->lname;
            $leads->email = $req->email;
            $leads->phone = $req->phone;
            // Store the file path in the 'resume' field
            $leads->resume = $upload_file;

            // Attempt to save the data
            if ($leads->save()) {
                return ["result" => "Data has been saved"];
            } else {
                return ["result" => "Failed to save data"];
            }
        } else {
            return ["result" => "Failed: No file uploaded"];
        }
    }

    function list()
    {
        return leads::all();
    }
}
