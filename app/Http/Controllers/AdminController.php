<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Level;
use App\Subject;
use App\Module;
use App\Topic;

class AdminController extends Controller
{
    public function showCurriculum(){
        $categories = Category::all();
        $categories->load('levels');
    	$levels = Level::all();
    	$subjects = Subject::all();
    	$modules = Module::all();
        $modules->load('topics');
        $topics = Topic::all();
    	return view('modals', compact('categories', 'levels', 'subjects', 'modules', 'topics'));
    }
}
