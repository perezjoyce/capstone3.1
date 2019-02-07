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

        //NOTE: ORDER BY DEADLINE HAS NOT BEEN ACHIEVED YET

        return view('student.student_curriculum', compact('sections'));
    }

    //CURRICULUM TOPIC CHAPTER PAGE
    public function showLesson($topicId, Request $request){
        $topic = Topic::find($topicId);
        $topic->load('chapters', 'module', 'level', 'module.subject');
        $chapter = $topic->chapters->first();
        $chapterId = $chapter->id;
        $questions = Question::where('chapter_id', '=', $chapterId)->inRandomOrder()->get(); // this works!
        $questions->load('choices');
        $number_of_questions = $questions->count();
//        dd($number_of_questions);
        //dd($questions);
        // $questions->load('choices');

//        // $questions = [];
//        foreach ($questions as &$question) {
//          $choices = $question->choices->shuffle();
//          dd($choices);
//        }
//
////        dd($questions);


        $module = $topic->module;
        return view('student.student_lesson', compact('topic', 'module', 'chapter', 'questions', 'number_of_questions'));

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
