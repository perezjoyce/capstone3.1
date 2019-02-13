<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Level;
use App\Subject;
use App\Module;
use App\Topic;
use App\Chapter;
use App\Section;
use App\User;
use App\Question;
use App\Choice;
use App\Record;
use App\Activity;
use Session;
use Redirect;
use App\Report;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;


class SectionController extends Controller
{
    public function createClass(Request $request){
        $access_code = str_random(5);

        $rules = array(
            "grade_level"=> "required",
            "subject"=> "required",
            "class_name"=> "required",
            "school_year"=> "required",
        );

        $this->validate($request, $rules);
        $section = new Section;
        $section->name = $request->class_name;
        $section->school_year = $request->school_year;
        $section->level_id = $request->grade_level;
        $section->subject_id = $request->subject;
        $section->access_code = $access_code;
        $section->save();

        $user = auth()->user()->id;
        $section->users()->attach($user);

        $levelId = $section->level_id;
        $class_name = $section->name;
        $level = Level::find($levelId);
        $level = $level->name;

        Session::flash("successmessage", $level." - ".$class_name." has been successfully created!");
        return Redirect::back();

    }

    public function getForm($sectionId){
        $section = Section::find($sectionId);
        $section->load('level', 'subject');

        $levels = Level::all();
        $subjects = Subject::all();
        $yearNow = date('Y');
        $x = $yearNow + 1;
        $schoolYear = $yearNow .' - '. $x;

        $template = 'classes.partials.edit_class';
        $returnHTML = view($template, compact('section', 'levels', 'subjects', 'schoolYear'))->render();
        return response()->json( array('success' => true, 'html'=> $returnHTML) );
    }



    public function editClass($sectionId, Request $request){
//        dd($sectionId);
        $rules = array(
            "edit_grade_level"=> "required",
            "edit_subject"=> "required",
            "edit_class_name"=> "required",
            "edit_school_year"=> "required",
            "edit_status" => "required",
        );

        $this->validate($request, $rules);
        $section = Section::find($sectionId);
        $section->name = $request->edit_class_name;
        $section->school_year = $request->edit_school_year;
        $section->level_id = $request->edit_grade_level;
        $section->subject_id = $request->edit_subject;
        $section->status = $request->edit_status;
        $section->save();
        $section->load('level', 'subject');
        $level = $section->level->name;
        $class_name = $section->name;

        Session::flash("successmessage", $level." - ".$class_name." has been successfully edited!");
        //return Redirect::back();
    }


    public function deleteClass($sectionId, Request $request) {
        $section = Section::find($sectionId);
        $section->load('level', 'subject');
        $class_name = $section->name;
        $level = $section->level->name;

        $userId = auth()->user()->id;
        $users = User::whereHas('sections', function($q) use ($sectionId){
            $q->where('section_id', '=', $sectionId);
        })->get();

        $activities = Activity::where('section_id', '=', $sectionId)->get();
        $activities->load('records');
        $hasRecords = 0;
        foreach($activities as $activity){
            $hasRecords += Record::where('activity_id',$activity->id)->distinct()->count('user_id');
        }

        if($hasRecords > 0){
            Session::flash("deletemessage", $level." - ".$class_name." contains records and cannot be deleted.");
            return Redirect::back();
        } else {
            $section->delete();
            Session::flash("deletemessage", $level." - ".$class_name." has been successfully deleted!");
            return Redirect::back();
        }
    }

    public function searchClass(Request $request) {
        $searchkey = $request->get('searchkey');
        $user = auth()->user();
        if($user->role == "teacher"){
            $sections = Section::whereHas('users', function($q){
                $userId = auth()->user()->id;
                $q->where('user_id', '=', $userId)->where('role', '=', 'teacher');
            })->where('name', '=', $searchkey)->get();
        } elseif($user->role == "student"){
            $sections = Section::whereHas('users', function($q){
                $userId = auth()->user()->id;
                $q->where('user_id', '=', $userId)->where('role', '=', 'student');
            })->where('name', '=', $searchkey)->get();
        } else {
            $sections = Section::all();
        }

        $yearNow = date('Y');
        $x = $yearNow + 1;
        $schoolYear = $yearNow .' - '. $x;

        $template = 'classes.partials.filtered_active_sections';
        $returnHTML = view($template, compact('sections', 'levels', 'subjects', 'schoolYear'))->render();
        return response()->json( array('success' => true, 'html'=> $returnHTML) );
    }


    public function searchSubject(Request $request){
        $searchkey = $request->get('searchkey');
        $user = auth()->user();
        if($user->role == "teacher"){
            $sections = Section::whereHas('users', function($q){
                $userId = auth()->user()->id;
                $q->where('user_id', '=', $userId)->where('role', '=', 'teacher');
            })->where('name', '=', $searchkey)->get();
        } elseif($user->role == "student"){
            $sections = Section::whereHas('users', function($q){
                $userId = auth()->user()->id;
                $q->where('user_id', '=', $userId)->where('role', '=', 'student');
            })->whereHas('subject', function($q) use ($searchkey){
                $q->where('name', 'like', '%'.$searchkey.'%');
            })->get();
        } else {
            $sections = Section::all();
        }

//        dd($sections->isNotEmpty());

        $yearNow = date('Y');
        $x = $yearNow + 1;
        $schoolYear = $yearNow .' - '. $x;

        $teachers = [];
        foreach ($sections as $section) {
            $teachers[] = $section->users()->where('section_id', $section->id)->where('role', 'teacher')->get();
        }

        $teachers = collect($teachers)->collapse();


        // TO CHECK IF USER ALREADY ANSWERED THE ACTIVITY
        $userId = auth()->user()->id;

        $template = 'classes.partials.filtered_subjects';
        $returnHTML = view($template, compact('sections', 'levels', 'subjects', 'schoolYear', 'teachers', 'schoolYear', 'userId'))->render();
        return response()->json( array('success' => true, 'html'=> $returnHTML) );

    }


    public function joinClass(Request $request){

        $access_code = $request->get('access_code');
        $sections = Section::where('access_code', '=' ,$access_code)->where('status', '=', 'active')->limit(1)->get();
        $sections->load('level', 'subject');


        if($sections->isEmpty()){
            Session::flash("deletemessage", "Sorry. There is no class with such class code... :( ");
        } else {
            $userId = auth()->user()->id;
            $user = User::find($userId);
            foreach($sections as $section){
                $name = $section->name;
                $level = $section->level->name;
                $subject = $section->subject->name;
                $section->users()->attach($user);
                Session::flash("successmessage", "Hooray! You're now a part of " .$level." - ".$name."'s ".$subject." class ! :)");
            }
        }

        return Redirect::back();

    }


    public function showStudentList($sectionId, Request $request){
        $section = Section::find($sectionId);
        $section->load('level', 'subject');

        $users = User::whereHas('sections', function($q) use ($sectionId) {
            $q->where('section_id', '=', $sectionId);
        })->where('role', '=', 'student')->get();

        $numberOfActivities = Activity::where('section_id', '=', $sectionId)->count();
        $totalScore = Activity::where('section_id', '=', $sectionId)->sum('number_of_items');
        $template = 'classes.class_list';
        $returnHTML = view($template, compact('users', 'section', 'sectionId', 'totalScore', 'numberOfActivities'))->render();
        return response()->json( array('success' => true, 'html'=> $returnHTML) );
    }


    public function removeStudent($userId, Request $request) {
        $student = User::find($userId);
        $sectionId = $request->get('remove-from-section');
        $section = Section::find($sectionId);
        $studentName = $request->get('remove-student');
        $level = $request->get('remove-from-level');
        $sectionName = $request->get('remove-from-sectionName');


        $activities = Activity::where('section_id', '=', $sectionId)->get();
        $activities->load('records');
        $hasRecords = 0;
        foreach($activities as $activity){
            $hasRecords += Record::where('activity_id',$activity->id)->where('user_id',$userId)->distinct()->count('user_id');
        }

        if($hasRecords > 0){
            Session::flash("deletemessage", $studentName." cannot be deleted due to his/her records in ".$level." - ".$sectionName.".");
            return Redirect::back();
        } else {
            $section->users()->detach($student);
            Session::flash("deletemessage", $studentName." has been successfully deleted from ".$level." - ".$sectionName."!");
            return Redirect::back();
        }
    }

    public function editStudentSettings($userId, Request $request){
//        $level = $request->get('edit-student-level');
//        $sectionName = $request->get('edit-student-section');
//        $subject = $request->get('edit-student-subject');

        $studentName = $request->get('edit-student-name');
        $password = Hash::make($request->get('edit-student-password'));

        $rules = array(
            'edit-student-name' => 'required|string|max:255',
            'edit-student-password' => 'required|string|min:6',
        );
        $this->validate($request, $rules);
        $student = User::find($userId);
        if($password != null){
            $student->password = $password;
            $student->name = $studentName;
        } else {
            $student->name = $studentName;
        }
        $student->save();
        Session::flash("successmessage", $studentName."'s account has been successfully updated!");
        return Redirect::back();
    }

    public function editProfile($userId, Request $request){
        $user = User::find($userId);
        $currentEmail = $user->email;
        $newemail = $request->get('email');
        $newusername = $request->get('username');
        $newname = $request->get('name');

        if($newemail == $currentEmail && $newname == $user->name && $newusername == $user->username) {
            Session::flash("successmessage", "No changes have been made to your account details.");
            return Redirect::back();
        } else {

            if ($currentEmail != $newemail) {
                $rules = array(
                    'name' => 'required|string|max:255',
                    'username' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                );

                $this->validate($request, $rules);
                $user->name = $request->name;
                $user->username = $request->username;
                $user->email = $request->email;

                $user->save();
                Session::flash("successmessage", "Your account has been successfully updated!");
                return Redirect::back();

            } else {
                $rules = array(
                    'name' => 'required|string|max:255',
                    'username' => 'required|string|max:255',
                );
                $this->validate($request, $rules);
                $user->name = $request->name;
                $user->username = $request->username;

                $user->save();
                Session::flash("successmessage", "Your account has been successfully updated!");
                return Redirect::back();

            }
        }
    }

    public function changePassword($userId, Request $request) {

        $password = Hash::make($request->get('password'));

        $rules = array(
            'password' => 'required|string|min:6',
        );
        
        $this->validate($request, $rules);
        $user = User::find($userId);
        $user->password =  $password;
        $user->save();
        Session::flash("successmessage", "Your password has been successfully changed!");
        return Redirect::back();
    }





}

