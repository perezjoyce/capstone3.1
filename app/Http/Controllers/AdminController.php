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
use App\Activity;
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

    //CHANGE REPORT STATUS
    public function changeReportStatus(Request $request){
        $user = auth()->user();
        $field = $request->get('field');
        $chapter = $request->get('chapter');

        $reports = Report::all();

        foreach ($reports as $report) {
            if($report->chapter_id == $chapter && $report->field == $field){
                if($report->status == 'pending'){
                    $report->status = 'completed';
                    $report->save();
                } else {
                    $report->status = 'pending';
                    $report->save();
                }
            }
        }

//STRETCH GOAL: PUSH TO NOTIFICATION TABLE SO TEACHER WILL BE NOTIFIED

        Session::flash("successmessage", "Report status of has been successfully updated!");
        return Redirect::back();
    }

    //VIEW COMPLETED REPORTS
    public function view_completed_reports(Request $request){
        $pending_reports = Report::select('chapter_id', 'field')
            ->groupBy('chapter_id', 'field')
            ->where('status', '=', 'completed')
            ->get();
        $pending_reports->load('chapter', 'chapter.topic', 'chapter.topic.level', 'chapter.topic.module.subject', 'user');
        $report_count = [];
        foreach($pending_reports as $pending_report){

            $report_count[] = Report::select('chapter_id', 'field')
                ->groupBy('chapter_id', 'field')
                ->where('chapter_id', '=', $pending_report->chapter_id)
                ->where('field', '=', $pending_report->field)
                ->count();
        }

        $reports = Report::all();

        //        dd($report_count);

        $template = 'admin.partials.completed_reports';
        $returnHTML = view($template, compact('pending_reports', 'report_count', 'reports'))->render();
        return response()->json( array('success' => true, 'html'=> $returnHTML) );
    }




    //SHOW APPROVAL PAGE
    public function showApproval(){

        $questions = Question::with('user')->where('is_approved', '=', 0)->get();
        $questions->load('user', 'choices', 'chapter', 'chapter.topic', 'chapter.topic.level', 'chapter.topic.module', 'chapter.topic.module.subject');
    //        dd($questions);

        return view('admin.admin_questions_approval', compact('questions'));
    }

    public function showSubmittedQuestion($questionId){
        $questions = Question::where('id', '=', $questionId)->get();
        $questions->load('user', 'choices', 'chapter', 'chapter.topic', 'chapter.topic.level', 'chapter.topic.module', 'chapter.topic.module.subject');

        $choices = Choice::with('question')->where('question_id', '=', $questionId)->get();
        //        dd($question->count());
        //        dd($choices->count());

        $template = 'admin.partials.question_for_approval';
        $returnHTML = view($template, compact('questions', 'choices'))->render();
        return response()->json( array('success' => true, 'html'=> $returnHTML) );
    }

    public function approveQuestion($questionId){
    //        dd($questionId);
        $question = Question::find($questionId);

        $question->is_approved = 1;
        $question->save();

//STRETCH GOAL: PUSH TO NOTIFICATION TABLE

        Session::flash("successmessage", "Question has been successfully approved!");
        return Redirect::back();
    }


    public function showApprovedQuestions(){
        $today = Carbon::today();
        $questions = Question::orderBy('updated_at', 'desc')->where('is_approved', '=', 1)->where('updated_at', '>',$today)->get();
        $questions->load('user', 'choices', 'chapter', 'chapter.topic', 'chapter.topic.level', 'chapter.topic.module', 'chapter.topic.module.subject');
        //        dd($question->count());
        //        dd($choices->count());

        $template = 'admin.partials.recently_approved_questions';
        $returnHTML = view($template, compact('questions'))->render();
        return response()->json( array('success' => true, 'html'=> $returnHTML) );
    }

    public function undoApproval($questionId){
        $question = Question::find($questionId);

        $question->is_approved = 0;
        $question->save();

//STRETCH GOAL: PUSH TO NOTIFICATION TABLE

        Session::flash("successmessage", "Question has been set as unapproved!");
        return Redirect::back();
    }

    public function showAllUsers(){
        $users = User::withTrashed()->get(); // displays even those with softdelete
        $users->load('sections', 'sections.activities', 'records', 'questions', 'activities');

        $teachers = User::where('role', '=', 'teacher')->get();
        $teachers->load('sections', 'sections.activities');
        return view('admin.admin_users_list', compact('users', 'teachers'));

    }

    public function changeUserStatus($userId, Request $request){
        $user = User::withTrashed()
            ->where('id', $userId)
            ->first();
        $userName = $user->name;
        $action = $request->get('action');

        if($action == 'deactivate'){
            $user->delete();
            return response()->json( array('success' => true, 'html'=> $userName."'s account has been successfully deleted."));
        } else {
            $user->restore();
            return response()->json( array('success' => true, 'html'=> $userName."'s account has been successfully restored."));
        }
    }

    public function editLevel($levelId, Request $request){
        $level = Level::find($levelId);
        $levelBefore = $level->name;
        $component = $request->get('component');
        $levelId = $request->get('componentId');
        $levelNow = $request->get('newComponent');
        $level->name = $levelNow;
        $level->save();

        //INCLUDE ALL MODELS NECESSARY FOR THE PAGE TO WORK SINCE YOU'RE USING TABS
        $levels = Level::all();
        $subjects = Subject::all();
        $modules = Module::all();
        $modules->load('topics');
        $topics = Topic::take(100)->get();
        $subjects->load('modules');

        $template = 'admin.partials.levels';
        $returnHTML = view($template, compact('levels', 'subjects', 'modules', 'topics'))->render();
        return response()->json( array('success' => true,
            'component' => $component,
            'html'=> $returnHTML,
            'confirmation' => $levelBefore. " has been successfully changed to ".$levelNow."."));

    }

    public function editSubject($subjecId, Request $request){
        $subject = Subject::find($subjecId);
        $subjectBefore = $subject->name;
        $component = $request->get('component');
        $subjectId = $request->get('componentId');
        $subjectNow = $request->get('newComponent');
        $subject->name = $subjectNow;
        $subject->save();

        //INCLUDE ALL MODELS NECESSARY FOR THE PAGE TO WORK SINCE YOU'RE USING TABS
        $levels = Level::all();
        $subjects = Subject::all();
        $modules = Module::all();
        $modules->load('topics');
        $topics = Topic::take(100)->get();
        $subjects->load('modules');

        $template = 'admin.partials.subjects';
        $returnHTML = view($template, compact('levels', 'subjects', 'modules', 'topics'))->render();
        return response()->json( array('success' => true,
            'component' => $component,
            'html'=> $returnHTML,
            'confirmation' => $subjectBefore. " has been successfully changed to ".$subjectNow."."));
    }

    public function editModule($moduleId, Request $request){
        $module = Module::find($moduleId);
        $moduleBefore = $module->name;
        $component = $request->get('component');
        $moduleNow = $request->get('newComponent');
        $module->name = $moduleNow;
        $module->save();

        //INCLUDE ALL MODELS NECESSARY FOR THE PAGE TO WORK SINCE YOU'RE USING TABS
        $levels = Level::all();
        $subjects = Subject::all();
        $modules = Module::all();
        $modules->load('topics');
        $topics = Topic::take(100)->get();
        $subjects->load('modules');

        $template = 'admin.partials.modules';
        $returnHTML = view($template, compact('levels', 'subjects', 'modules', 'topics'))->render();
        return response()->json( array('success' => true,
            'component' => $component,
            'html'=> $returnHTML,
            'confirmation' => $moduleBefore. " has been successfully changed to ".$moduleNow."."));
    }

    public function editTopic($topicId, Request $request){
        $topic = Topic::find($topicId);
        $topicBefore = $topic->name;
        $component = $request->get('component');
        $topicNow = $request->get('newComponent');
        $topic->name = $topicNow;
        $topic->save();

        $levelId = $topic->level_id;
        $moduleId = $topic->module_id;
        $topics = Topic::where([
            ['level_id', '=', $levelId],
            ['module_id', '=', $moduleId]
        ])->get();

        //INCLUDE ALL MODELS NECESSARY FOR THE PAGE TO WORK SINCE YOU'RE USING TABS
        $levels = Level::all();
        $subjects = Subject::all();
        $modules = Module::all();
        $modules->load('topics');
        $subjects->load('modules');

        $template = 'admin.partials.filtered_topics';
        $returnHTML = view($template, compact('levels', 'subjects', 'modules', 'topics'))->render();
        return response()->json( array('success' => true,
            'component' => $component,
            'html'=> $returnHTML,
            'confirmation' => $topicBefore. " has been successfully changed to ".$topicNow."."));
    }

    public function addLevel(Request $request){
        $component = $request->get('component');
        $newLevel = $request->get('newComponent');

        $count = Level::where('name', '=', $newLevel)->count();

        if($count == 0){
            //since we already grade levels up to 10 and we will only soft delete the rest
            $categoryId = 3;
            $level = new Level;
            $level->name = $newLevel;
            $level->category_id = $categoryId;
            $level->save();

            //INCLUDE ALL MODELS NECESSARY FOR THE PAGE TO WORK SINCE YOU'RE USING TABS
            $levels = Level::all();
            $subjects = Subject::all();
            $modules = Module::all();
            $modules->load('topics');
            $topics = Topic::take(100)->get();
            $subjects->load('modules');

            $template = 'admin.partials.levels';
            $returnHTML = view($template, compact('levels', 'subjects', 'modules', 'topics'))->render();
            return response()->json( array('success' => true,
                'component' => $component,
                'html'=> $returnHTML,
                'confirmation' => $newLevel. " has been successfully added as a ".$component."."));
        } else {
            return response()->json( array('success' => false,
                'negation'=> $newLevel." already exists."));
        }
    }


    public function addSubject(Request $request){
        $component = $request->get('component');
        $newSubject = $request->get('newComponent');

        $count = Subject::where('name', '=', $newSubject)->count();

        if($count == 0){
            $subject = new Subject;
            $subject->name = $newSubject;
            $subject->save();

            //INCLUDE ALL MODELS NECESSARY FOR THE PAGE TO WORK SINCE YOU'RE USING TABS
            $levels = Level::all();
            $subjects = Subject::all();
            $modules = Module::all();
            $modules->load('topics');
            $topics = Topic::take(100)->get();
            $subjects->load('modules');

            $template = 'admin.partials.subjects';
            $returnHTML = view($template, compact('levels', 'subjects', 'modules', 'topics'))->render();
            return response()->json( array('success' => true,
                'component' => $component,
                'html'=> $returnHTML,
                'confirmation' => $newSubject. " has been successfully added as a ".$component."."));
        } else {
            return response()->json( array('success' => false,
                'negation'=> $newSubject." already exists."));
        }
    }

    public function addModule(Request $request){
        $newModule = $request->get('newModule');
        $subjectId = $request->get('subjectId');
        $subject = Subject::find($subjectId)->first();
        $subjectName = $subject->name;

        $count = Module::where('name', '=', $newModule)->count();

        if($count == 0){
            $module = new Module;
            $module->name = $newModule;
            $module->subject_id = $subjectId;
            $module->save();

            //INCLUDE ALL MODELS NECESSARY FOR THE PAGE TO WORK SINCE YOU'RE USING TABS
            $levels = Level::all();
            $subjects = Subject::all();
            $modules = Module::all();
            $modules->load('topics');
            $topics = Topic::take(100)->get();
            $subjects->load('modules');

            $template = 'admin.partials.modules';
            $returnHTML = view($template, compact('levels', 'subjects', 'modules', 'topics'))->render();
            return response()->json( array('success' => true,
                'html'=> $returnHTML,
                'confirmation' => $newModule. " has been successfully added to as a module to ".$subjectName."."));
        } else {
            return response()->json( array('success' => false,
                'negation'=> $newModule." already exists."));
        }
    }


    public function addTopic(Request $request){
        $newTopic = $request->get('newTopic');
        $levelId = $request->get('levelId');
        $moduleId = $request->get('moduleId');

        $count = Topic::where('name', '=', $newTopic)->count();
        if($count == 0){
            $topic = new Topic;
            $topic->name = $newTopic;
            $topic->level_id = $levelId;
            $topic->module_id = $moduleId;
            $topic->save();


            //INCLUDE ALL MODELS NECESSARY FOR THE PAGE TO WORK SINCE YOU'RE USING TABS
            $levelId = $topic->level_id;
            $moduleId = $topic->module_id;
            $topics = Topic::where([
                ['level_id', '=', $levelId],
                ['module_id', '=', $moduleId]
            ])->get();


            $levels = Level::all();
            $subjects = Subject::all();
            $modules = Module::all();
            $modules->load('topics');
            $subjects->load('modules');

            $template = 'admin.partials.filtered_topics';
            $returnHTML = view($template, compact('levels', 'subjects', 'modules', 'topics'))->render();
            return response()->json( array('success' => true,
                'html'=> $returnHTML,
                'confirmation' => $newTopic. " has been successfully added to as a topic!"));
        } else {
            return response()->json( array('success' => false,
                'negation'=> $newTopic." already exists."));
        }

    }

}
