<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        $activities = Activity::all();
        $activities->load('chapter', 'purpose', 'section', 'section.subject' ,'users');

        $owner = auth()->user();
        $sections = Section::whereHas('users', function($q){
            $userId = auth()->user()->id;
            $q->where('user_id', '=', $userId)->where('role', '=', 'teacher');
        })->where('status', '=', 'active')->get();

//        dd($sections); // malakas masinop matino

        $users = [];
        foreach ($sections as $section) {
            $users[] = $section->users()->where('section_id', $section->id)->where('role','=' ,'student')->get();
        }

        $users = collect($users)->collapse()->unique('id');

//      dd($users); // joey jem johnray johnray
//      $start = Carbon::setWeekStartsAt(Carbon::SUNDAY);
//      Carbon::setWeekEndsAt(Carbon::SATURDAY);
        $today = Carbon::today();
        $recent_activities  =[];
        foreach ($users as $user) {
            $recent_activities[] = $user->activities()->wherePivot('created_at', '>=', $today)->get();
        }
        $recent_activities = collect($recent_activities)->collapse(); // returns 2, 1 and 5 instead of 3
//        dd($recent_activities);

        $owner_email = $owner->email;
        preg_match('/^.\K[a-zA-Z\.0-9]+(?=.@)/',$owner_email,$matches);//here we are gathering this part bced
        $replacement= implode("",array_fill(0,strlen($matches[0]),"*"));//creating no. of *'s
        $owner_hiddenEmail = preg_replace('/^(.)'.preg_quote($matches[0])."/", '$1'.$replacement, $owner_email);

        return view('teacher.teacher_dashboard', compact('owner','owner_hiddenEmail', 'sections', 'users', 'recent_activities', 'categories', 'levels', 'subjects', 'modules', 'tests', 'topics'));
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
        $sections = Section::whereHas('users', function($q){
            $userId = auth()->user()->id;
            $q->where('user_id', '=', $userId)->where('role', '=', 'teacher');
        })->where('status', '=', 'active')->get();
        // dd($sections);
        Section::with('level', 'subject')->get();

        $levels = Level::all();
        $subjects = Subject::all();
        $yearNow = date('Y');
        $x = $yearNow + 1;
        $schoolYear = $yearNow .' - '. $x;

        $teacher = User::where('role', '=', 'teacher')->get();
        return view('teacher.teacher_sections', compact('sections', 'teacher', 'levels', 'subjects', 'schoolYear'));
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


    public function showArchivedSections(){
        $sections = Section::whereHas('users', function($q){
            $userId = auth()->user()->id;
            $q->where('user_id', '=', $userId)->where('role', '=', 'teacher');
        })->where('status', '=', 'archived')->get();
        Section::with('level', 'subject')->get();

        $teacher = User::where('role', '=', 'teacher')->get();
        return view('teacher.teacher_archived_sections', compact('sections', 'teacher'));

    }


    //STUDENT LIST ---> TO BE INTEGRATED IN TEACHER_SECTIONS PAGE. I WANT THE PAGE TO OPEN ON A DIFFERENT TAB
//    public function showStudents(){
//
//        //get the sections of the user
//        $sections = Section::whereHas('users', function($q){
//            $userId = auth()->user()->id;
//            $q->where('user_id', '=', $userId)->where('role', '=', 'teacher');
//        })->where('status', '=', 'active')->get();
//        Section::with('level', 'subject')->get();
//
//        $students[] = "";
//        foreach($sections as $section){
//            $sectionId = $section->id;
//            $students[] = User::whereHas('sections', function($q) use ($sectionId) {
//                $q->where('section_id', '=', $sectionId);
//            })->where('role', '=', 'student')->get();
//
//        }
////        dd($students);
//        $students = User::where('role', '=', 'student')->get();
//        $teachers = User::where('role', '=', 'teacher')->get();
//        $sections = Section::all();
//        Section::with('level', 'subject')->get();
//
//        return view('teacher.teacher_students_list', compact('students', 'teachers', 'sections'));
//    }


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
        $report->status = 'pending'; //
        $report->save();

        Session::flash("successmessage", "Your report has been successfully sent!");
        return Redirect::back();
    }


    //CLASS PROGRESS
    public function showProgress(){
        $sections = Section::whereHas('users', function($q){
            $userId = auth()->user()->id;
            $q->where('user_id', '=', $userId)->where('role', '=', 'teacher');
        })->where('status', '=', 'active')->get();

        $sections->load('subject', 'level', 'activities', 'activities.purpose', 'activities.chapter.topic', 'users');

        // TO CHECK IF USER ALREADY ANSWERED THE ACTIVITY
        $userId = auth()->user()->id;

        // !!!!!!! NOTE: ORDER BY DEADLINE HAS NOT BEEN ACHIEVED YET
        return view('teacher.teacher_section_progress', compact('sections', 'userId', 'topic'));
    }

    //STUDENTS' PROGRESS - DISPLAYS STUDENTS PROGRESS PER CLASS
    public function showStudentProgress($userId, Request $request){
        $subjectId = $request->get('subjectId');
//        dd($subjecId);

        $sections = Section::whereHas('users', function($q) use ($userId){
            $q->where('user_id', '=', $userId);
        })->where('status', '=', 'active')->get();

        $sections->load('subject', 'level', 'activities', 'activities.purpose', 'activities.chapter.topic');

        $user = User::find($userId);

        $template = 'teacher.partials.student_progress';
        $returnHTML = view($template, compact('sections', 'userId', 'topic', 'user', 'subjectId'))->render();
        return response()->json( array('success' => true, 'html'=> $returnHTML) );
    }



    //ANSWER HISTORY - DISPLAYS STUDENTS ANSWERS PER ACTIVITY
    public function showAnswerHistory($userId, Request $request){
        $subjectId = $request->get('subjectId');
        $activityId = $request->get('activityId');
        // dd($subjecId);

        $sections = Section::whereHas('users', function($q) use ($userId){
            $q->where('user_id', '=', $userId);
        })->where('status', '=', 'active')->get();

        $lastRecordedAttempt = Record::where('user_id', '=', $userId)->where('activity_id', '=', $activityId)->max('created_at'); // get results of last attempt

        $sections->load('subject', 'level', 'activities', 'activities.purpose', 'activities.chapter.topic', 'activities.records');
        $questions = Question::all();
        $questions->load('choices');

        $user = User::find($userId);
//        $subjectName = Subject::find($subjectId);

        $template = 'teacher.partials.student_answer_history';
        $returnHTML = view($template, compact('sections', 'userId', 'topic', 'user', 'subjectId', 'records', 'questions', 'lastRecordedAttempt', 'activityId'))->render();
        return response()->json( array('success' => true, 'html'=> $returnHTML) );
    }



    //STUDENT ITEM ANALYSIS PER SUBJECT - DISPLAYS STUDENTS ANSWERS PER SUBJECT
    public function showStudentSubjectProgress($userId, Request $request){
        $subjectId = $request->get('subjectId');
        $activityId = $request->get('activityId');
        $activity = Activity::find($activityId);
        $secId = $activity->section_id;
        $sections = Section::find($secId);
        $sections->load('level');
        $levelName = $sections->level->name;

        $sections = Section::whereHas('users', function($q) use ($userId){
            $q->where('user_id', '=', $userId);
        })->where('status', '=', 'active')->get();

        $records = Record::where('user_id', '=', $userId)->get();
        $sections->load('subject', 'level', 'activities', 'activities.purpose', 'activities.chapter.topic', 'activities.records');
        $questions = Question::all();
        $questions->load('choices');


        $user = User::find($userId);
        $subject = Subject::find($subjectId);

        $acts = Activity::all();

        return view('teacher.partials.student_subject_progress', compact('levelName', 'sections', 'userId', 'acts', 'topic', 'user', 'subjectId', 'subject', 'records', 'questions', 'activityId'));
    }



    //STUDENT ITEM ANALYSIS PER SUBJECT - DISPLAYS STUDENTS ANSWERS PER SUBJECT -- FROM CLASS LIST PAGE
    public function showStudentSubjectProgress2($userId, Request $request){
        $subjectId = $request->get('subjectId');
        $sectionId = $request->get('sectionId');
        $sections = Section::find($sectionId);
        $sections->load('level');
        $levelName = $sections->level->name;

        $sections = Section::whereHas('users', function($q) use ($userId){
            $q->where('user_id', '=', $userId);
        })->where('status', '=', 'active')->get();

        $records = Record::where('user_id', '=', $userId)->get();
        $sections->load('subject', 'level', 'activities', 'activities.purpose', 'activities.chapter.topic', 'activities.records');
        $questions = Question::all();
        $questions->load('choices');


        $user = User::find($userId);
        $subject = Subject::find($subjectId);

        $acts = Activity::all();

        return view('teacher.partials.subject_progress', compact('levelName', 'sections', 'userId', 'acts', 'topic', 'user', 'subjectId', 'subject', 'records', 'questions'));
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
