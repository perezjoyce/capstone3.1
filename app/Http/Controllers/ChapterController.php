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
                $template = 'chapters.objective';
                break;
            case 'discussion':
                $template = 'chapters.discussion';
                break;
            case 'example':
                $template ='chapters.example';
                break;
            case 'practice':
                $template = 'chapters.practice';
                break;
            case 'tips':
                $template = 'chapters.tips';
                break;
            case 'keypoints':
                $template = 'chapters.keypoints';
                break;
        }

        $returnHTML = view($template, compact('chapter'))->render();
        return response()->json( array('success' => true, 'html'=> $returnHTML, 'column' => $column, 'chapterId' => $chapterId) );
    }


    public function editObjective($chapterId, Request $request) {
        $rules = array(
            "edit_objective"=> "required",
        );

        $this->validate($request, $rules);
        $chapter = Chapter::find($chapterId);
        $chapter->objective = $request->edit_objective;
        $chapter->save();
        Session::flash("successmessage", "Changes to objective has been successfully saved!");
        return Redirect::back();
    }

    public function editExample($chapterId, Request $request){
        $rules = array(
            "edit_example"=> "required",
        );

        $this->validate($request, $rules);
        $chapter = Chapter::find($chapterId);
        $chapter->example = $request->edit_example;
        $chapter->save();
        Session::flash("successmessage", "Changes to example has been successfully saved!");
        return Redirect::back();
    }

    public function editDiscussion($chapterId, Request $request){
        $rules = array(
            "edit_discussion"=> "required",
        );

        $this->validate($request, $rules);
        $chapter = Chapter::find($chapterId);
        $chapter->discussion = $request->edit_discussion;
        $chapter->save();
        Session::flash("successmessage", "Changes to discussion has been successfully saved!");
        return Redirect::back();
    }

    public function editKeypoints($chapterId, Request $request){
        $rules = array(
            "edit_keypoints"=> "required",
        );

        $this->validate($request, $rules);
        $chapter = Chapter::find($chapterId);
        $chapter->key_point = $request->edit_keypoints;
        $chapter->save();
        Session::flash("successmessage", "Changes to key points has been successfully saved!");
        return Redirect::back();
    }

    public function editPractice($chapterId, Request $request){
        $rules = array(
            "edit_practice"=> "required",
        );

        $this->validate($request, $rules);
        $chapter = Chapter::find($chapterId);
        $chapter->guided_practice = $request->edit_practice;
        $chapter->save();
        Session::flash("successmessage", "Changes to practice has been successfully saved!");
        return Redirect::back();
    }


    public function editTips($chapterId, Request $request){
        $rules = array(
            "edit_tips"=> "required",
        );

        $this->validate($request, $rules);
        $chapter = Chapter::find($chapterId);
        $chapter->tip = $request->edit_tips;
        $chapter->save();
        Session::flash("successmessage", "Changes to tips has been successfully saved!");
        return Redirect::back();
    }

    public function getEditQuestionForm($chapterId, $questionId, $order) {
        $chapter = Chapter::find($chapterId);
        $question = Question::find($questionId);
        $choices = $question->load('choices');

        $template = 'chapters.questions';

        $returnHTML = view($template, compact('chapter', 'question','choices' ))->render();
        return response()->json( array('success' => true, 'html'=> $returnHTML, 'chapterId' => $chapterId, 'questionId' => $questionId, 'order' => $order) );
    }

    public function editQuestion($questionId, Request $request){
        $question = Question::find($questionId);
        $choice1 = Choice::where('question_id', '=', $questionId)->where('order', '=', 1)->first();
        $choice2 = Choice::where('question_id', '=', $questionId)->where('order', '=', 2)->first();
        $choice3 = Choice::where('question_id', '=', $questionId)->where('order', '=', 3)->first();
        $choice4 = Choice::where('question_id', '=', $questionId)->where('order', '=', 4)->first();

        $rules = array(
            "edit_question"=> "required",
            "edit_hint" => "required",
            "edit_explanation"=>"required",
            "edit_answer_1"=>'required',
            "edit_answer_1"=>'required',
            "edit_answer_2"=>'required',
            "edit_answer_3"=>'required',
            "edit_answer_4"=>'required',
        );

        $this->validate($request, $rules);
        $question->question = $request->edit_question;
        $question->hint = $request->edit_hint;
        $question->explanation = $request->edit_explanation;
        $choice1->choice = $request->edit_answer_1;
        $choice2->choice = $request->edit_answer_2;
        $choice3->choice = $request->edit_answer_3;
        $choice4->choice = $request->edit_answer_4;
        $question->save();
        $choice1->save();
        $choice2->save();
        $choice3->save();
        $choice4->save();

        return Redirect::back();

    }

    public function getAddQuestionForm($chapterId, $order){
        $chapter = Chapter::find($chapterId);
        $template = 'chapters.add_questions';
        $order = $order + 1;

        $returnHTML = view($template, compact('chapter', 'order'))->render();
        return response()->json( array('success' => true, 'html'=> $returnHTML, 'chapterId' => $chapterId) );
    }

    public function addQuestion($chapterId, Request $request) {
        $user = auth()->user()->id;
        $rules = array(
            "new_question"=> "required",
            "new_hint" => "required",
            "new_explanation"=>"required",
            "new_order"=>"required",
            "new_answer_1"=>'required',
            "new_answer_1"=>'required',
            "new_answer_2"=>'required',
            "new_answer_3"=>'required',
            "new_answer_4"=>'required',
        );

        $this->validate($request, $rules);
        $question = new Question;
        $question->question = $request->new_question;
        $question->hint = $request->new_hint;
        $question->explanation = $request->new_explanation;
        $question->order = $request->new_order;
        $question->chapter_id = $chapterId;
        $question->user_id = $user;
        $question->save();

        $questionId = Question::where('chapter_id', '=', $chapterId)->orderBy('order', 'desc')->first()->id;

        $choice = new Choice;
        $choice->choice = $request->new_answer_1;
        $choice->is_correct = 1;
        $choice->order = 1;
        $choice->question_id = $questionId;
        $choice->save();

        $choice = new Choice;
        $choice->choice = $request->new_answer_2;
        $choice->order = 2;
        $choice->question_id = $questionId;
        $choice->save();

        $choice = new Choice;
        $choice->choice = $request->new_answer_3;
        $choice->order = 3;
        $choice->question_id = $questionId;
        $choice->save();

        $choice = new Choice;
        $choice->choice = $request->new_answer_4;
        $choice->order = 4;
        $choice->question_id = $questionId;
        $choice->save();

        Session::flash("successmessage", "Your new question has been saved!");
        return Redirect::back();

    }

    public function deleteQuestion($questionId){
        $question = Question::find($questionId);
        $questionOrder = $question->order;
        $question->delete();
        Session::flash("successmessage", "Question # ".$questionOrder." has been successfully deleted.");
        return Redirect::back();
    }


    public function deleteChapter($chapterId){
        $chapter = Chapter::find($chapterId);
        $topic = $chapter->topic->name;
        $chapter->delete();
        Session::flash("successmessage", "The lesson for ".$topic." has been successfully deleted.");
        return redirect("/admin_dashboard");

    }

}

