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
})->name('landing');


Route::middleware('auth')->group(function(){

    //REDIRECT TO CORRECT DASHBOARD UPON LOGIN
    Route::get('/handle_redirects', 'HandleRedirectController@handle')
        ->name('handle_redirects');

    //============ DASHBOARD ==========//
    //ADMIN
    Route::get('/admin_dashboard', 'AdminController@showAdminDashboard')
        ->middleware('admin')
        ->name('admin_dashboard');

    //TEACHER
    Route::get('/teacher_dashboard', 'TeacherController@showTeacherDashboard')
        ->middleware('teacher')
        ->name('teacher_dashboard');

    //STUDENT
    Route::get('/student_dashboard', 'StudentController@showStudentDashboard')
        ->middleware('student')
        ->name('student_dashboard');

    //========== CURRICULUM ==========//
    //ADMIN
    Route::get('admin_curriculum', 'AdminController@showCurriculum')->middleware('admin');
    Route::get('/admin_curriculum/showModules', 'AdminController@showModules')->middleware('admin');
    Route::post('/admin_curriculum/showTopics', 'AdminController@showTopics')->middleware('admin');
    Route::get('admin_lesson/{topicId}', 'AdminController@showLesson')->middleware('admin');

    //TEACHER
    Route::get('teacher_curriculum', 'TeacherController@showCurriculum')->middleware('teacher');
    Route::get('/teacher_curriculum/showModules', 'TeacherController@showModules')->middleware('teacher');
    Route::post('/teacher_curriculum/showTopics', 'TeacherController@showTopics')->middleware('teacher');
    Route::get('teacher_lesson/{topicId}', 'TeacherController@showLesson')->middleware('teacher'); //LESSONS AKA CHAPTERS

    //STUDENT
    Route::get('student_curriculum', 'StudentController@showCurriculum')->middleware('student');
    Route::get('student_lesson/{topicId}/', 'StudentController@showLesson')->middleware('student');

    //========== LESSON/CHAPTER ==========//
    //ADMIN
    Route::get('chapter/edit/{chapterId}', 'ChapterController@getEditForm')->middleware('admin');
    Route::get('chapter/add/{chapterId}/{order}', 'ChapterController@getAddQuestionForm')->middleware('admin'); // ADD TEACHER MIDDLEWARE
    Route::get('chapter/edit/{chapterId}/{questionId}/{order}', 'ChapterController@getEditQuestionForm')->middleware('admin'); // ADD TEACHER MIDDLEWARE

    Route::patch('chapter/edit-objective/{chapterId}', 'ChapterController@editObjective')->middleware('admin');
    Route::patch('chapter/edit-discussion/{chapterId}', 'ChapterController@editDiscussion')->middleware('admin');
    Route::patch('chapter/edit-example/{chapterId}', 'ChapterController@editExample')->middleware('admin');
    Route::patch('chapter/edit-keypoints/{chapterId}', 'ChapterController@editKeypoints')->middleware('admin');
    Route::patch('chapter/edit-practice/{chapterId}', 'ChapterController@editPractice')->middleware('admin');
    Route::patch('chapter/edit-tips/{chapterId}', 'ChapterController@editTips')->middleware('admin');
    Route::patch('chapter/edit-question/{questionId}', 'ChapterController@editQuestion')->middleware('admin'); // ADD TEACHER MIDDLEWARE

    Route::post('chapter/add-question/{chapterId}', 'ChapterController@addQuestion')->middleware('admin'); // ADD TEACHER MIDDLEWARE

    Route::delete('deleteChapter/{chapterId}', 'ChapterController@deleteChapter')->middleware('admin');
    Route::delete('deleteQuestion/{questionId}', 'ChapterController@deleteQuestion')->middleware('admin'); // ADD TEACHER MIDDLEWARE

    //TEACHER
    //STUDENT

    //========== REPORT ==========//
    //TEACHER
    Route::patch('report-error/{chapterId}', 'TeacherController@reportError')->middleware('teacher'); //CREATE FOR STUDENT


    //========== ACTIVITIES ==========//
    //TEACHER
    Route::get('activity/{topicId}', 'ActivityController@getForm')->middleware('teacher');
    Route::get('activity/show_purposes/{sectionId}', 'ActivityController@showPurposes')->middleware('teacher');
    Route::post('/activity/add_activity/{topicId}', 'ActivityController@addActivity')->middleware('teacher');

    //STUDENT
    Route::post('checkAnswers/{activityId}', 'ActivityController@checkAnswers')->middleware('student');

    //========== CLASS LIST ==========//
    //TEACHER
    Route::get('teacher_sections', 'TeacherController@showSections')->middleware('teacher');
    Route::get('teacher_archived_sections', 'TeacherController@showArchivedSections')->middleware('teacher');

    //========== STUDENT LIST ==========//
    //TEACHER
    Route::get('teacher_students_list', 'TeacherController@showStudents')->middleware('teacher');


});


//LINKS
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


//AJAX
//Route::get('ajax', function(){ return view('ajax'); });
// Route::post('/postajax','AjaxController@post');
// Route::get('/questions/{id}','AjaxController@showQuestionsByGradeLevels');// not working
Route::get('/teacher_curriculum_content', 'TeacherController@curriculumContent'); //DELETE LATER
