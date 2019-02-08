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
        $levelId = $topic->level_id;
        $purposeId = "";

        //ADDED SECOND WHERE SO ONLY ACTIVE CLASSES OF THE TEACHER THAT MATCH SELECTED LEVEL WILL BE SHOWN
        $sections = Section::whereHas('users', function($q){
            $userId = auth()->user()->id;
            $q->where('user_id', '=', $userId);
        })->where('status', '=', 'active')->where('level_id', '=', $levelId)->get();
        //dd($sections);

        $sections->load('activities', 'activities.purpose');

        $template = 'activities.add_activity';
        $returnHTML = view($template, compact('topic', 'questions', 'purposes', 'sections' ))->render();
        return response()->json( array('success' => true, 'html'=> $returnHTML, 'topicId' => $topicId) );
    }

    //SHOW PURPOSE BASED ON SELECTED CLASS/SECTION

    /**
     * @param $sectionId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function showPurposes($sectionId){
        $activities = Activity::where('section_id', '=', $sectionId)->get();
        $activities->load('purpose');

        $existingPurposesIds = [];
        foreach ($activities as $activity) {
            $existingPurposesIds[] = $activity->purpose->id;
        }

        $purposes = Purpose::whereNotIn('id', $existingPurposesIds)->get();

        $returnHTML = view('activities.partials.filtered_purposes',
            ['activities'=> $activities,
                'purposes' => $purposes])->render();
        return response()->json( array('success' => true, 'html'=> $returnHTML) );
    }

    //ADD ACTIVITY
    public function addActivity($topicId, Request $request){

        $topic = Topic::find($topicId); //use to find chapter's questions and save them into activity question //NEEDED TO GET CHAPTER ID FOR NOW BUT THIS COULD HAVE BEEN PASSED AS WILDCARD INSTEAD
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
        //ADD CHAPTER ID FIELD HERE FOR NOW. REMOVE THIS WHEN YOU DECIDE TO HAVE MULTIPLE CHAPTERS TO AN ACTIVITY IN THE FUTURE.
        $this->validate($request, $rules);
        $activity = new Activity(); // Model class of Activity
        $activity->name = $request->name;
        $activity->chapter_id = $chapterId;
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


    //CHECK ACTIVITY
    public function checkAnswers($activityId, Request $request){

        $activity = Activity::find($activityId);

        $numberOfItems = $request->numberOfItems;
        $score = 0;
        for($i=0; $i<$numberOfItems; $i++) {
            $answer = Choice::find($request->input('answer'.$i));
            if($answer->is_correct) {
                $score++;
            }
        }

        $average = ($score / $numberOfItems)*100;
        $template = "";

        if($average <= 30){
            $template = 'activities.partials.activity_result_poor';
        } elseif ($average > 30 && $average <= 50){
            $template = 'activities.partials.activity_result_fair';
        } elseif ($average > 50 && $average <= 70){
            $template = 'activities.partials.activity_result_good';
        } elseif($average > 70 && $average < 100){
            $template = 'activities.partials.activity_result_very_good';
        } elseif($average == 100){
            $template = 'activities.partials.activity_result_excellent';
        }

        //LIMIT RETAKE DEPENDING ON PURPOSE. 0 RETAKE FOR EVALUATION AND ASSESSMENT

        $user = auth()->user()->id;
        $activity->users($user)->attach($score, ['score' => $score]);

        $returnHTML = view($template, compact('activity', 'numberOfItems', 'score', 'average'))->render();
        return response()->json( array('success' => true, 'html'=> $returnHTML) );


    }


}
