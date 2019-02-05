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
}
