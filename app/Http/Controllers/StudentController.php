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

        // !!!!!!! NOTE: ORDER BY DEADLINE HAS NOT BEEN ACHIEVED YET
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


        // TO CHECK IF USER ALREADY ANSWERED THE ACTIVITY
        $userId = auth()->user()->id;


        // !!!!!!! NOTE: ORDER BY DEADLINE HAS NOT BEEN ACHIEVED YET
        return view('student.student_progress', compact('sections', 'userId', 'topic'));
    }

    //TEMPORARY
    public function showStudentDashboard(){
        $categories = Category::all();
        $categories->load('levels');
        $levels = Level::all();
        $tests = Level::with('category')->get();
        $subjects = Subject::all();
        $modules = Module::all();

        $modules->load('topics');
        $topics = Topic::all();

        $subjects->load('modules');
        return view('student.student_dashboard', compact('categories', 'levels', 'subjects', 'modules', 'tests', 'topics'));
    }

}
