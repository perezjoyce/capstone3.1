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
use Session;
use Redirect;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller
{
    //DASHBOARD
    public function showAdminDashboard(){
        $categories = Category::all();
        $categories->load('levels');
        $levels = Level::all();
        $tests = Level::with('category')->get();
        $subjects = Subject::all();
        $modules = Module::all();

        $modules->load('topics');
        $topics = Topic::all();

        $subjects->load('modules');
        return view('admin.admin_dashboard', compact('categories', 'levels', 'subjects', 'modules', 'tests', 'topics'));
    }

    //CURRICULUM
    public function showCurriculum(){
        $categories = Category::all();
        $categories->load('levels');
        $levels = Level::all();
        $tests = Level::with('category')->get(); //delete
        $subjects = Subject::all();
        $modules = Module::all();

        $modules->load('topics');
        $topics = Topic::take(100)->get();
        $reversetest = Topic::with('level')->get(); //delete

        $subjects->load('modules');
        return view('admin.admin_curriculum', compact('categories', 'levels', 'subjects', 'modules', 'tests', 'topics', 'reversetest'));
    }

    public function showModules(){
        $subject = Input::get('subject');
        $modules = Module::where('subject_id', '=', $subject)->get();

        $returnHTML = view('admin.partials.filtered_modules', ['modules'=> $modules])->render();
        return response()->json( array('success' => true, 'html'=> $returnHTML) );
    }

    public function showTopics(){
        $level = Input::get('level');
        $module = Input::get('module');

        $topics = Topic::where([
            ['level_id', '=', $level],
            ['module_id', '=', $module]
        ])->get();

        $returnHTML = view('admin.partials.filtered_topics', ['topics'=> $topics])->render();
        return response()->json( array('success' => true, 'html'=> $returnHTML) );
    }


    public function showLesson($topicId, Request $request){
        $user = auth()->user()->id;
        $topic = Topic::find($topicId);
        $topic->load('chapters', 'module', 'level', 'module.subject');
        $chapter = $topic->chapters->first();
        if(!$chapter) {
            $chapter = new Chapter([
                'name' => 'Default Name',
                'objective' => 'Default Objective',
                'discussion' => 'Default Discussion',
                'example' => 'Default Example',
                'guided_practice' => 'Default Practice',
                'tip' => 'Default Tips',
                'key_point' => 'Default Key Points',
                'topic_id' => $topicId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $chapter->save();
        }

        $chapterId = $chapter->id;
        $questions = Question::where('chapter_id', '=', $chapterId)->exists();
        if($questions == false){
            $questions = new Question ([
                'question' => 'Default Question',
                'hint' => 'Default Hint',
                'explanation' => 'Default Explanation',
                'order' => 1,
                'chapter_id' => $chapterId,
                'user_id' => $user,
            ]);
            $questions->save();

            $choices = new Choice ([
                'choice' => 'This is the correct answer.',
                'is_correct' => 1,
                'order' => 1,
                'question_id' => $questions->id,
            ]);

            $choices->save();

            $choices = new Choice ([
                'choice' => 'This is a wrong answer.',
                'order' => 2,
                'question_id' => $questions->id,
            ]);
            $choices->save();

            $choices = new Choice ([
                'choice' => 'This is another wrong answer.',
                'order' => 3,
                'question_id' => $questions->id,
            ]);
            $choices->save();

            $choices = new Choice ([
                'choice' => 'This is the last wrong answer.',
                'order' => 4,
                'question_id' => $questions->id,
            ]);
            $choices->save();

        }
        $questions = Question::where('chapter_id', '=', $chapterId)->get();
        $number_of_questions = $questions->count();
        $choices = $questions->load('choices');

        $module = $topic->module;
        return view('admin.admin_lesson', compact('topic', 'module', 'chapter', 'questions', 'choices', 'number_of_questions'));

    }
}
