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

    Route::put('editProfile/{userId}', 'SectionController@editProfile');
    Route::put('changePassword/{userId}', 'SectionController@changePassword');

    //========== CURRICULUM ==========//
    //ADMIN
    Route::get('admin_curriculum', 'AdminController@showCurriculum')->middleware('admin');
    Route::get('/admin_curriculum/showModules', 'AdminController@showModules')->middleware('admin');
    Route::post('/admin_curriculum/showTopics', 'AdminController@showTopics')->middleware('admin');
    Route::get('admin_lesson/{topicId}', 'AdminController@showLesson')->middleware('admin');
    Route::post('edit_curriculum_level/{levelId}', 'AdminController@editLevel')->middleware('admin');
    Route::post('edit_curriculum_subject/{subjectId}', 'AdminController@editSubject')->middleware('admin');
    Route::post('edit_curriculum_module/{moduleId}', 'AdminController@editModule')->middleware('admin');
    Route::post('edit_curriculum_topic/{topicId}', 'AdminController@editTopic')->middleware('admin');
    Route::post('add_curriculum_level', 'AdminController@addLevel')->middleware('admin');
    Route::post('add_curriculum_subject', 'AdminController@addSubject')->middleware('admin');
    Route::post('add_new_module', 'AdminController@addModule')->middleware('admin');
    Route::post('add_new_topic', 'AdminController@addTopic')->middleware('admin');

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
    Route::get('teacher_chapter/add/{chapterId}/{order}', 'TeacherController@getAddQuestionForm')->middleware('teacher'); // test //
    Route::get('teacher_chapter/edit/{chapterId}/{questionId}/{order}', 'TeacherController@getEditQuestionForm')->middleware('teacher'); // test //

    Route::patch('teacher_chapter/edit-question/{questionId}', 'TeacherController@editQuestion')->middleware('teacher'); // test //

    Route::post('teacher_chapter/add-question/{chapterId}', 'TeacherController@addQuestion')->middleware('teacher'); // test //

    Route::delete('teacher_deleteQuestion/{questionId}', 'TeacherController@deleteQuestion')->middleware('teacher'); // test //

    //STUDENT

    //========== REPORT ==========//
    //TEACHER
    Route::patch('report-error/{chapterId}', 'TeacherController@reportError');

    //ADMIN
    Route::get('changeReportStatus/', 'AdminController@changeReportStatus');
    Route::get('view_completed_reports/', 'AdminController@view_completed_reports');

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
    Route::get('teacher_student_list/{sectionId}', 'TeacherController@showStudentList')->middleware('teacher');
    Route::get('teacher_archived_sections', 'TeacherController@showArchivedSections')->middleware('teacher');


    //STUDENT
    Route::get('student_active_classes', 'StudentController@showActiveClasses')->middleware('student');
    Route::get('student_archived_classes', 'StudentController@showArchivedClasses')->middleware('student');

    //========== STUDENT LIST ==========//
    //TEACHER
    Route::get('teacher_students_list', 'TeacherController@showStudents')->middleware('teacher');

    //STUDENT
//    Route::get('teacher_student_list/{sectionId}', 'TeacherController@showStudentList')->middleware('student'); //working on this

    //========== STUDENT PROGRESS ==========//
    //TEACHER
    Route::get('teacher_section_progress', 'TeacherController@showProgress')->middleware('teacher');
    Route::get('student_progress/{studentId}', 'TeacherController@showStudentProgress')->middleware('teacher');
    Route::get('student_answer_history/{studentId}', 'TeacherController@showAnswerHistory')->middleware('teacher');
    Route::get('student_subject_progress/{userId}', 'TeacherController@showStudentSubjectProgress')->middleware('teacher');
    Route::get('subject_progress/{userId}', 'TeacherController@showStudentSubjectProgress2')->middleware('teacher');

    //STUDENT
    Route::get('student_progress', 'StudentController@showProgress')->middleware('student');
    Route::get('searchSubject/', 'SectionController@searchSubject');


    //========== CLASSES ==========//
    //TEACHER
    Route::post('createClass', 'SectionController@createClass')->middleware('teacher');
    Route::get('showEditClassForm/{sectionId}', 'SectionController@getForm')->middleware('teacher');
    Route::post('editClass/{sectionId}', 'SectionController@editClass')->middleware('teacher');
    Route::delete('deleteClass/{sectionId}', 'SectionController@deleteClass')->middleware('teacher');
    Route::get('searchClass/', 'SectionController@searchClass');
//    Route::get('showStudentList/{sectionId}', 'TeacherController@showStudentList')->middleware('teacher'); //NOT WORKING
    Route::delete('removeStudent/{userId}', 'SectionController@removeStudent');
    Route::put('editStudentSettings/{userId}', 'SectionController@editStudentSettings');

    //STUDENT
    Route::post('joinClass', 'SectionController@joinClass')->middleware('student');



    //========== APPROVAL ==========//
    Route::get('admin_questions_approval', 'AdminController@showApproval')->middleware('admin'); //show page
    Route::get('view_submitted_question/{questionId}', 'AdminController@showSubmittedQuestion')->middleware('admin');
    Route::post('approve_submitted_question/{questionId}', 'AdminController@approveQuestion')->middleware('admin');
    Route::get('view_approved_questions', 'AdminController@showApprovedQuestions')->middleware('admin');
    Route::post('undo_approval/{questionId}', 'AdminController@undoApproval')->middleware('admin');


    //========== USERS ==========//
    Route::get('admin_users_list', 'AdminController@showAllUsers')->middleware('admin'); //show page
    Route::post('change_user_status/{userId}', 'AdminController@changeUserStatus')->middleware('admin');

});


//LINKS
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// Image uploads
Route::post('image-uploads', 'ImageController@upload')->middleware('student');


//AJAX
//Route::get('ajax', function(){ return view('ajax'); });
// Route::post('/postajax','AjaxController@post');
// Route::get('/questions/{id}','AjaxController@showQuestionsByGradeLevels');// not working
Route::get('/teacher_curriculum_content', 'TeacherController@curriculumContent'); //DELETE LATER
