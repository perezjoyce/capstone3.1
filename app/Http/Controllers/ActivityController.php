<?php

namespace App\Http\Controllers;
use App\Activity;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Chapter;
use App\Question;
use App\Choice;
use App\Topic;
use App\Purpose;
use App\Section;
use App\Presentation;
use Session;
use Redirect;


class ActivityController extends Controller
{
    //SHOW MODAL
    public function getForm($topicId){
        $topic = Topic::find($topicId);
        $purposes = Purpose::all();

        $sections = Section::whereHas('users', function($q){
            $userId = auth()->user()->id;
            $q->where('user_id', '=', $userId);
        })->get();

        $template = 'activities.add_activity';
        $returnHTML = view($template, compact('topic', 'questions', 'purposes', 'sections' ))->render();
        return response()->json( array('success' => true, 'html'=> $returnHTML, 'topicId' => $topicId) );
    }

    //ADD ACTIVITY
    public function addActivity($topicId, Request $request){


        $topic = Topic::find($topicId); //use to find chaper's questions and save them into activity question
        $chapterId = $topic->chapters->first()->id;
        $questions = Question::where('chapter_id', '=', $chapterId)->get();
        $number_of_items = $questions->count();
        $deadline = str_replace('.', '-', $request->input('deadline'));

        /**
         * Parse the date based on the given date format
         * http://php.net/manual/en/function.date.php
         *
         * M - Jan-Dec(3 letter months)
         * d - 1-31 days
         * Y - 4 digit year
         */
        $deadline = Carbon::createFromFormat('M d, Y', $deadline);

        $rules = array(
            "name" => "required",
            "presentation" => "required|numeric",
            "section" => "required|numeric",
            "purpose" => "required|numeric",
            "deadline" => "required"
        );

        $this->validate($request, $rules);
        $activity = new Activity(); // Model class of Activity
        $activity->name = $request->name;
        $activity->section_id = $request->section;
        $activity->purpose_id = $request->purpose;
        $activity->presentation_id = $request->presentation;
        $activity->number_of_items = $number_of_items;
        $activity->deadline = $deadline->format("Y-m-d");
        $activity->save();
        $section = $activity->section->name;
        $topic = $topic->name;

        Session::flash("successmessage", $topic." has been successfully added as task to ".$section);
        //redirect to class next time
        return Redirect::back();
    }


}
