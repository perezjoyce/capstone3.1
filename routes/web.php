<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//LANDING PAGE
Route::get('/', function () {
    return view('landing');
});

/*
Route::middleware('auth')->group(function(){
});
*/

//AJAX
//Route::get('ajax', function(){ return view('ajax'); });
// Route::post('/postajax','AjaxController@post');
// Route::get('/questions/{id}','AjaxController@showQuestionsByGradeLevels');// not working

//TEACHER CURRICULUM VIEW // BEING USED FOR ADMIN FOR NOW
Route::get('teacher_curriculum', 'TeacherController@showCurriculum');
Route::get('/teacher_curriculum_content', 'TeacherController@curriculumContent');
Route::post('/teacher_curriculum/showTopics', 'TeacherController@showTopics');
Route::get('/teacher_curriculum/showModules', 'TeacherController@showModules');
Route::get('/teacher_topic_chapters/{topicId}', 'TeacherController@showChapters');

//TEACHER CLASS LIST
Route::get('teacher_sections', 'TeacherController@showSections');
Route::get('teacher_archived_sections', 'TeacherController@showArchivedSections');

//TEACHER STUDENTS LIST
Route::get('teacher_students_list', 'TeacherController@showStudents');

//ADMIN
// Route::get('/modals', 'AdminController@showCurriculum');

// CHAPTER
Route::get('chapter/edit/{chapterId}', 'ChapterController@getEditForm');
Route::get('chapter/edit/{chapterId}/{questionId}/{order}', 'ChapterController@getEditQuestionForm');
Route::get('chapter/add/{chapterId}/{order}', 'ChapterController@getAddQuestionForm');
Route::patch('/teacher_topic_chapters/edit-objective/{chapterId}', 'ChapterController@editObjective');
Route::patch('/teacher_topic_chapters/edit-discussion/{chapterId}', 'ChapterController@editDiscussion');
Route::patch('/teacher_topic_chapters/edit-example/{chapterId}', 'ChapterController@editExample');
Route::patch('/teacher_topic_chapters/edit-keypoints/{chapterId}', 'ChapterController@editKeypoints');
Route::patch('/teacher_topic_chapters/edit-practice/{chapterId}', 'ChapterController@editPractice');
Route::patch('/teacher_topic_chapters/edit-tips/{chapterId}', 'ChapterController@editTips');
Route::patch('/teacher_topic_chapters/edit-question/{questionId}', 'ChapterController@editQuestion');
Route::post('/teacher_topic_chapters/add-question/{chapterId}', 'ChapterController@addQuestion');



//LINKS
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
