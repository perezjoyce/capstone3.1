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
use App\Report;
use Illuminate\Support\Facades\Input;

class TeacherController extends Controller
{
    // DASHBOARD
    public function showTeacherDashboard(){
        $categories = Category::all();
        $categories->load('levels');
        $levels = Level::all();
        $tests = Level::with('category')->get();
        $subjects = Subject::all();
        $modules = Module::all();

        $modules->load('topics');
        $topics = Topic::all();

        $subjects->load('modules');
        return view('teacher.teacher_dashboard', compact('categories', 'levels', 'subjects', 'modules', 'tests', 'topics'));
    }

	//CURRICULUM PAGE
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
    	return view('teacher.teacher_curriculum', compact('categories', 'levels', 'subjects', 'modules', 'tests', 'topics', 'reversetest'));
    }

    public function showModules(){
        $subject = Input::get('subject');
        $modules = Module::where('subject_id', '=', $subject)->get();

        $returnHTML = view('teacher.partials.filtered_modules', ['modules'=> $modules])->render();
        return response()->json( array('success' => true, 'html'=> $returnHTML) );
    }

    public function showTopics(){
        $level = Input::get('level');
        $module = Input::get('module');

        $topics = Topic::where([
            ['level_id', '=', $level],
            ['module_id', '=', $module]
        ])->get();

//        $chapters = Chapter::all();

//       $tests= $topics->load('chapters', 'chapters.questions');
//        dd($test);


        $returnHTML = view('teacher.partials.filtered_topics', ['topics'=> $topics])->render();
        return response()->json( array('success' => true, 'html'=> $returnHTML) );
    }

    //CURRICULUM TOPIC CHAPTER PAGE
    public function showLesson($topicId, Request $request){
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
//        QUESTIONS ARE NOT AUTO-GENERATED
//        $questions = Question::where('chapter_id', '=', $chapterId)->exists();
//        if($questions == false){
//            $questions = new Question ([
//                'question' => 'Default Question',
//                'hint' => 'Default Hint',
//                'explanation' => 'Default Explanation',
//                'order' => 1,
//                'chapter_id' => $chapterId,
//                'user_id' => 1,
//            ]);
//            $questions->save();
//
//            $choices = new Choice ([
//                'choice' => 'This is the correct answer.',
//                'is_correct' => 1,
//                'order' => 1,
//                'question_id' => $questions->id,
//            ]);

//            $choices->save();
//
//            $choices = new Choice ([
//                'choice' => 'This is a wrong answer.',
//                'order' => 2,
//                'question_id' => $questions->id,
//            ]);
//            $choices->save();
//
//            $choices = new Choice ([
//                'choice' => 'This is another wrong answer.',
//                'order' => 3,
//                'question_id' => $questions->id,
//            ]);
//            $choices->save();
//
//            $choices = new Choice ([
//                'choice' => 'This is the last wrong answer.',
//                'order' => 4,
//                'question_id' => $questions->id,
//            ]);
//            $choices->save();
//
//        }
            $questions = Question::where('chapter_id', '=', $chapterId)->where('is_approved', '=', 1)->get();
            $number_of_questions = $questions->count();
            $choices = $questions->load('choices');

            $module = $topic->module;
            return view('teacher.teacher_lesson', compact('topic', 'module', 'chapter', 'questions', 'choices', 'number_of_questions'));

    }


    //CLASS LIST
    public function showSections(){
        $sections = Section::all();
        Section::with('level', 'subject')->get();

        $teacher = User::where('role', '=', 'teacher')->get();
        // dd($levels);
        return view('teacher.teacher_sections', compact('sections', 'teacher'));

    }

    public function showArchivedSections(){
        $sections = Section::all();
        Section::with('level', 'subject')->get();

        $teacher = User::where('role', '=', 'teacher')->get();

        // dd($levels);
        return view('teacher.teacher_archived_sections', compact('sections', 'teacher'));

    }


    //STUDENT LIST
    public function showStudents(){
        $students = User::where('role', '=', 'student')->get();
        $teachers = User::where('role', '=', 'teacher')->get();
        $sections = Section::all();
        Section::with('level', 'subject')->get();

        return view('teacher.teacher_students_list', compact('students', 'teachers', 'sections'));
    }


    public function reportError($chapterId, Request $request){
        $column = Input::get('column');
        $user = auth()->user()->id;

        $rules = array(
            "details"=> "required",
        );

        $this->validate($request, $rules);
        $report = new Report;
        $report->chapter_id = $chapterId;
        $report->field = $column;
        $report->message = $request->details;
        $report->user_id = $user;
        $report->save();

        Session::flash("successmessage", "Your report has been successfully sent!");
        return Redirect::back();
    }


    //TEMPORARY PAGES
    public function curriculumContent(){
        $categories = Category::all();
        $categories->load('levels');
        $levels = Level::all();
        $tests = Level::with('category')->get();
        $subjects = Subject::all();
        $modules = Module::all();

        $modules->load('topics');
        $topics = Topic::all();

        $subjects->load('modules');
        return view('teacher.teacher_curriculum_content', compact('categories', 'levels', 'subjects', 'modules', 'tests', 'topics'));
    }



    
}
