<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Category;
use App\Level;
use App\Subject;
use App\Module;
use App\Topic;
use App\Chapter;
use App\Section;
use App\User;
use App\Activity;
use App\Question;
use App\Choice;
use Carbon\Carbon;
use Session;
use Redirect;

class StudentController extends Controller
{

    //CURRICULUM PAGE
    public function showCurriculum(){

        $sections = Section::whereHas('users', function($q){
            $userId = auth()->user()->id;
            $q->where('user_id', '=', $userId);
        })->where('status', '=', 'active')->get();

        $sections->load('subject', 'level', 'activities', 'activities.purpose', 'activities.chapter.topic');


        // TO CHECK IF USER ALREADY ANSWERED THE ACTIVITY
        $userId = auth()->user()->id;

        // ORDERED BY DEADLINE IN MODEL
        return view('student.student_curriculum', compact('sections', 'userId'));
    }

    //CURRICULUM TOPIC CHAPTER PAGE
    public function showLesson($topicId, Request $request){
        $topic = Topic::find($topicId);
        $activityId = $request->get('activity'); // get ID from URL
        $activity = Activity::find($activityId);

//        $activity->load('purpose');
        $number_of_items = $activity->number_of_items; //test

        $topic->load('chapters', 'module', 'level', 'module.subject');
        $chapter = $topic->chapters->first();
        $chapterId = $chapter->id;
//        $questions = Question::where('chapter_id', '=', $chapterId)->inRandomOrder()->get(); // this works!
//        DID THE FOLLOWING SO THAT THE NUMBER OF QUESTIONS WHEN THE TEACHER ADDED THE ACTIVITY WILL BE THE NUMBER OF QUESTIONS WHEN THE STUDENTS ANSWER THEM
        $questions = Question::where('chapter_id', '=', $chapterId)->where('is_approved', '=', 1)->limit($number_of_items)->inRandomOrder()->get(); //test
//        dd($questions->count());
        $numberOfItems = $questions->count();
        $questions->load('choices');
        $module = $topic->module;
        return view('student.student_lesson', compact('topic', 'module', 'chapter', 'questions', 'numberOfItems', 'activity'));

    }


    //CURRICULUM PAGE
    public function showProgress(){

        $sections = Section::whereHas('users', function($q){
            $userId = auth()->user()->id;
            $q->where('user_id', '=', $userId);
        })->where('status', '=', 'active')->get();

        $sections->load('subject', 'level', 'activities', 'activities.purpose', 'activities.chapter.topic');
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


        // !!!!!!! NOTE: ORDER BY DEADLINE HAS NOT BEEN ACHIEVED YET
        return view('student.student_progress', compact('sections', 'userId', 'topic', 'teachers', 'schoolYear'));
    }


    //ACTIVE CLASSES
    public function showActiveClasses(){
        $sections = Section::whereHas('users', function($q){
            $userId = auth()->user()->id;
            $q->where('user_id', '=', $userId)->where('role', '=', 'student');
        })->where('status', '=', 'active')->get();
        // dd($sections);
        Section::with('level', 'subject')->get();

        $levels = Level::all();
        $subjects = Subject::all();
        $yearNow = date('Y');
        $x = $yearNow + 1;
        $schoolYear = $yearNow .' - '. $x;

        $teachers = [];
        foreach ($sections as $section) {
            $teachers[] = $section->users()->where('section_id', $section->id)->where('role', 'teacher')->get();
        }

        $teachers = collect($teachers)->collapse();
//
        return view('student.student_active_classes', compact('sections', 'teachers', 'levels', 'subjects', 'schoolYear'));
    }

    //ARCHIVED CLASSES
    public function showArchivedClasses(){
        $sections = Section::whereHas('users', function($q){
            $userId = auth()->user()->id;
            $q->where('user_id', '=', $userId)->where('role', '=', 'student');
        })->where('status', '=', 'archived')->get();
//        Section::with('level', 'subject')->get();

        $sections->load('subject', 'level', 'activities', 'activities.purpose', 'activities.chapter.topic');
        $yearNow = date('Y');
        $x = $yearNow + 1;
        $schoolYear = $yearNow .' - '. $x;

        // TO CHECK IF USER ALREADY ANSWERED THE ACTIVITY
        $userId = auth()->user()->id;

        $teachers = [];
        foreach ($sections as $section) {
            $teachers[] = $section->users()->where('section_id', $section->id)->where('role', 'teacher')->get();
        }

        $teachers = collect($teachers)->collapse();
        return view('student.student_archived_classes', compact('sections','userId', 'topic', 'teachers', 'schoolYear'));
    }

    //SHOW STUDENT LIST WHEN CLASS IS SELECTED
    public function showStudentList($sectionId, Request $request){
        $section = Section::find($sectionId);
        $section->load('level', 'subject');

        $users = User::whereHas('sections', function($q) use ($sectionId) {
            $q->where('section_id', '=', $sectionId);
        })->where('role', '=', 'student')->get();

        $numberOfActivities = Activity::where('section_id', '=', $sectionId)->count();
        $totalScore = Activity::where('section_id', '=', $sectionId)->sum('number_of_items');
        $template = 'teacher.partials.teacher_student_list';
        $returnHTML = view($template, compact('users', 'section', 'sectionId', 'totalScore', 'numberOfActivities'))->render();
        return response()->json( array('success' => true, 'html'=> $returnHTML) );
    }



    //TEMPORARY
    public function showStudentDashboard()
    {
        $owner = auth()->user();
        $sections = Section::whereHas('users', function ($q) {
            $userId = auth()->user()->id;
            $q->where('user_id', '=', $userId)->where('role', '=', 'student');
        })->where('status', '=', 'active')->get();

//        dd($sections); // malakas masinop matino

        $activities = [];
        $today = Carbon::today();
        foreach ($sections as $section) {
            $activities[] = $section->activities->where('created_at', '>', $today);
        }

        $activities = collect($activities)->collapse()->unique('id');

//        dd($activities);

        $owner_email = $owner->email;
        preg_match('/^.\K[a-zA-Z\.0-9]+(?=.@)/', $owner_email, $matches);//here we are gathering this part bced
        $replacement = implode("", array_fill(0, strlen($matches[0]), "*"));//creating no. of *'s
        $owner_hiddenEmail = preg_replace('/^(.)' . preg_quote($matches[0]) . "/", '$1' . $replacement, $owner_email);

        return view('student.student_dashboard', compact('owner', 'owner_hiddenEmail', 'activities'));

    }

       

}
