<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;
use App\Level;
use App\Subject;
use App\Module;
use App\Topic;

class AjaxController extends Controller
{
	//TESTING
    public function post(Request $request){
      $response = array(
          'status' => 'success',
          'msg' => $request->message,
      );
      return response()->json($response); 
   	}


   //NOT WORKING
   	public function showLevels($id, Request $request){

		// $response = array(
		// 	'status' => 'success',
		// 	'levels' => Level::has('category_id', $id)->get()
  //     	);
		// return response()->json($response); 
    	
    }

    // public function showQuestionsByGradeLevels($gradeLevel, Request $request) {

    // 	$questions = [
    // 		[ 
    // 			'question' => 'What is your name?', 
    // 			'answers' => 
	   //  			[
	   //  				'Joyce', 'John', 'Adam', 'Emma'
	   //  			]
    // 		],
    // 		[ 
    // 			'question' => 'Where do you leave?', 
    // 			'answers' => 
	   //  			[
	   //  				'Borongan', 'Tacloban', 'Manila', 'Koronadal'
	   //  			]
    // 		]
    // 	];
    // 	$returnHTML = view('question.questions_tablelist', ['questions'=> $questions])->render();
    //     return response()->json( array('success' => true, 'html'=>$returnHTML) );
    // }

}
