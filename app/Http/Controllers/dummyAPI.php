<?php

namespace App\Http\Controllers;

use App\Models\leads;
use Illuminate\Http\Request;

class dummyAPI extends Controller
{
    function getData(Request $req)
    {
        // Basic validation to check if required fields are not empty
        if (empty($req->name) || empty($req->email)) {
            return ["result" => "Failed: Required fields are empty"];
        }

        $leads = new leads;
        $leads->name = $req->name;
        $leads->email = $req->email;    
        $leads->phone = $req->phone;
        $leads->address = $req->address;
        $leads->website = $req->website;
        $leads->linkedin =$req->linkedin;
        $leads->country = $req->country;
        $leads->native_english_speaker = $req->native_english_speaker;
        $leads->skill = $req->skill;
        $leads->other_skill = $req->other_skill;
        $leads->experience = $req->experience;
        $leads->subject_speciality = $req->subject_speciality;
        $leads->other_subject_speciality = $req->other_subject_speciality;
        $leads->genre = $req->genre;
        $leads->other_genre = $req->other_genre;
        $leads->education = $req->education;
        $leads->specialization = $req->specialization;
        $leads->non_english = $req->non_english;
        $leads->french = $req->french;
        $leads->spanish = $req->spanish;
        $leads->italian = $req->italian;
        $leads->japanese = $req->japanese;
        $leads->chinease = $req->chinease;
        $leads->dutch = $req->dutch;
        $leads->german = $req->german;
        $leads->special_instruction = $req->special_instruction;
        $leads->work_handled = $req->work_handled;
        $leads->publisher_vendor = $req->publisher_vendor;
        $leads->format_handle = $req->format_handle;
        $leads->other_format = $req->other_format;
        $leads->currency = $req->currency;
        $leads->other_currency = $req->other_currency;
        $leads->testimony = $req->testimony;
        $leads->file_upload = $req->file_upload;


        //Check if a file is uploaded
        if ($req->hasFile('resume')) {
            $file = $req->file('resume');
            $fileName = time() . '_' . $file->getClientOriginalName();
            // Move the uploaded file to a directory within the public folder
            $file->move(public_path('resumes'), $fileName);
            // Save the file path to the database
            $leads->resume = $fileName; // Store the relative path
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
        $leads = Leads::select('name','email','phone','address','website','linkedin','country','native_english_speaker','skill',
        'other_skill','experience','subject_speciality','other_subject_speciality','genre','other_genre','education','specialization',
        'non_english','french','spanish','italian','japanese','chinease','dutch','german','special_instruction','work_handled',
        'publisher_vendor','format_handle','other_format','currency','other_currency','testimony','file_upload')
        -> get();
        return response()->json($leads);
    }
}
