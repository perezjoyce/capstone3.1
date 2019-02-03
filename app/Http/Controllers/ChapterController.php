<?php

namespace App\Http\Controllers;

use App\Chapter;
use App\Question;
use App\Choice;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Session;
use Redirect;

class ChapterController extends Controller
{
    public function getEditForm($chapterId) {
        $chapter = Chapter::find($chapterId);
        $column = Input::get('column');
        $template = '';
        switch ($column) {
            case 'objective':
                $template = 'teacher.chapters.objective';
                break;
            case 'discussion':
                $template = 'teacher.chapters.discussion';
                break;
            case 'example':
                $template ='teacher.chapters.example';
                break;
            case 'practice':
                $template = 'teacher.chapters.practice';
                break;
            case 'tips':
                $template = 'teacher.chapters.tips';
                break;
            case 'keypoints':
                $template = 'teacher.chapters.keypoints';
                break;
            case 'questions':
                $template = 'teacher.chapters.questions';
                break;
        }

        $returnHTML = view($template, compact('chapter'))->render();
        return response()->json( array('success' => true, 'html'=> $returnHTML, 'column' => $column, 'chapterId' => $chapterId) );
    }

    public function editObjective($chapterId, Request $request) {
        $chapter = Chapter::find($chapterId);
        $chapter->objective = $request->edit_objective;
        $chapter->save();
        Session::flash("successmessage", "Changes to objective has been successfully saved!");
        return Redirect::back();
    }

    public function editExample($chapterId, Request $request){
        $chapter = Chapter::find($chapterId);
        $chapter->example = $request->edit_example;
        $chapter->save();
        Session::flash("successmessage", "Changes to example has been successfully saved!");
        return Redirect::back();
    }

    public function editDiscussion($chapterId, Request $request){
        $chapter = Chapter::find($chapterId);
        $chapter->discussion = $request->edit_discussion;
        $chapter->save();
        Session::flash("successmessage", "Changes to discussion has been successfully saved!");
        return Redirect::back();
    }

    public function editKeypoints($chapterId, Request $request){
        $chapter = Chapter::find($chapterId);
        $chapter->key_point = $request->edit_keypoints;
        $chapter->save();
        Session::flash("successmessage", "Changes to key points has been successfully saved!");
        return Redirect::back();
    }

    public function editPractice($chapterId, Request $request){
        $chapter = Chapter::find($chapterId);
        $chapter->guided_practice = $request->edit_practice;
        $chapter->save();
        Session::flash("successmessage", "Changes to practice has been successfully saved!");
        return Redirect::back();
    }

    public function editTips($chapterId, Request $request){
        $chapter = Chapter::find($chapterId);
        $chapter->tip = $request->edit_tips;
        $chapter->save();
        Session::flash("successmessage", "Changes to tips has been successfully saved!");
        return Redirect::back();
    }
}

