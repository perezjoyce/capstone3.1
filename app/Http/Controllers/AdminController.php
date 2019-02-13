<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Carbon\Carbon;
use App\Level;
use App\Subject;
use App\Module;
use App\Topic;
use App\Chapter;
use App\Section;
use App\User;
use App\Question;
use App\Choice;
use App\Report;
Use \DB;
use Session;
use Redirect;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller
{
    //DASHBOARD
    public function showAdminDashboard(){
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





        $pending_reports = Report::select('chapter_id', 'field')
            ->groupBy('chapter_id', 'field')
            ->where('status', '=', 'pending')
            ->get();
        $pending_reports->load('chapter', 'chapter.topic', 'chapter.topic.level', 'chapter.topic.module.subject', 'user');
        $report_count = [];
//        $reports = Report::all();
        foreach($pending_reports as $pending_report){

            $report_count[] = Report::select('chapter_id', 'field')
                ->groupBy('chapter_id', 'field')
                ->where('chapter_id', '=', $pending_report->chapter_id)
                ->where('field', '=', $pending_report->field)
                ->count();
        }

        $reports = Report::all();

//        dd($report_count);

        return view('admin.admin_dashboard', compact('owner', 'owner_hiddenEmail', 'activities', 'pending_reports', 'report_count', 'reports'));

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
