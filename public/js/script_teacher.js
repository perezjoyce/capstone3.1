$(document).ready(function(){

	// FILTER FORM TO VIEW TOPICS
    $("#topic-filter-form").on('submit', function(e){
    	e.preventDefault();
    	e.stopPropagation();
        $_token = "{{ csrf_token() }}";
        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: '/teacher_curriculum/showTopics',
            type: 'POST',
            cache: false,
            data: $(this).serialize(),
            datatype: 'json',
            beforeSend: function() {
                //something before send
            },
            success: function(response) {

                //success
                //var data = $.parseJSON(data);
                if(response.success == true) {
                    $('#topic_container').html(response.html);
                    $('.collapsible').collapsible();
                } else {
                    $('#topic_container').html(response.html);
				}
            },
            error: function(xhr,textStatus,thrownError) {
                alert(xhr + "\n" + textStatus + "\n" + thrownError);
            }
        });
    });


    // LOAD MODULES BASED ON SELECTED SUBJECT
    $("#selected-subject").on('change', function(e){
        e.preventDefault();
        e.stopPropagation();
        $_token = "{{ csrf_token() }}";
        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: '/teacher_curriculum/showModules',
            type: 'GET',
            cache: false,
            data: {'subject': $(this).val()},
            datatype: 'json',
            beforeSend: function() {
                //something before send
            },
            success: function(response) {

                //success

                if(response.success == true) {
                    $('#topic_container').html("");
                    $('#module-options').replaceWith(response.html);
                    $('.dropdown-trigger').dropdown();
                    M.AutoInit();
                } else {
                    $('#module-options').replaceWith(response.html);
				}
            },
            error: function(xhr,textStatus,thrownError) {
                alert(xhr + "\n" + textStatus + "\n" + thrownError);
            }
        });
    });

    // ENABLE BUTTON WHEN MODULE IS CHOSEN
    $(document).on('change', '#selected-module', function(e){
        e.preventDefault();
        e.stopPropagation();
        $('#topic_container').html("");
        $("#showTopics-btn").removeClass("disabled");
    });

    //ADD ACTIVITY
    $(document).on('click', '.add-activity-modal', function(){
        var topicId = $(this).data('id');

        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: '/activity/'+topicId,
            type: 'GET',
            cache: false,
            data: {
               topicId:topicId
            },
            datatype: 'json',
            success: function(response) {
                if(response.success == true) {
                    $('#modal-add-activity .modal-content').html(response.html);
                    M.AutoInit();
                    $('#modal-add-activity').modal('open');
                    $('#add-activity-form').attr('action', '/activity/add_activity/'+ response.topicId);



                } else {
                    alert("Error in loading modal.");
                }
            },
                error: function(xhr,textStatus,thrownError) {
                    alert(xhr + "\n" + textStatus + "\n" + thrownError);
            }
        });
    });


    // REPORTING ERRORS
    $(document).on('click', '.report-modal-btn', function(){
        var column = $(this).data('column');
        var chapterId = $(this).data('id');

        $('#modal-report-error').modal('open');
        $('#column_with_error').val(column);

    });

    // LOAD PURPOSES BASED ON SELECTED SECTION/CLASS
    $(document).on('change', '#selected-section', function(e){
        e.preventDefault();
        e.stopPropagation();
        var sectionId = $(this).val();

        $_token = "{{ csrf_token() }}";
        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: '/activity/show_purposes/'+sectionId,
            type: 'GET',
            cache: false,
            data: {
                'sectionId': sectionId
            },
            datatype: 'json',
            beforeSend: function() {
                //something before send
            },
            success: function(response) {
                //success
                if(response.success == true) {
                    $('#purpose-options').replaceWith(response.html);
                    $('select').formSelect();
                    // M.AutoInit();
                } else {
                    alert('error');
                }
            },
            error: function(xhr,textStatus,thrownError) {
                alert(xhr + "\n" + textStatus + "\n" + thrownError);
            }
        });
    });


    // EDIT CHAPTER QUESTIONS AND CHOICES
    $('.edit-question-modal').on('click', function(){
        const chapterId = $(this).data('id');
        const questionId = $(this).data('questionid');
        const order = $(this).data('order');

        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: '/chapter/edit/'+chapterId+'/'+questionId+'/'+ order,
            type: 'GET',
            cache: false,
            data: {
                chapterId: chapterId,
                questionId: questionId,
                order: order
            },
            datatype: 'json',
            beforeSend: function() {
                //something before send
            },
            success: function(response) {

                if(response.success == true) {
                    $('#modal-edit-question .modal-content').html(response.html);
                    M.AutoInit();
                    $('#modal-edit-question').modal('open');
                    tinymce.init({
                        selector: '.wysiywg',
                        menubar: true,
                        plugins: [
                            'advlist lists image charmap preview textcolor',
                            'searchreplace visualblocks code fullscreen',
                            'insertdatetime media contextmenu table paste code wordcount'
                        ],
                        toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
                        content_css: [
                            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                            '//www.tinymce.com/css/codepen.min.css']
                    });

                    $('.edit-question-modal-btn').on('click', function(){
                        var answer = confirm('Do you want to save changes you made to question # ' + response.order + '?');

                        if(answer ==  true) {
                            $('#edit-question-form').attr('action', '/chapter/edit-question/'+ response.questionId);
                        }
                    })

                } else {
                    alert('Error in editing question. Please try again.');
                }
            },
            error: function(xhr,textStatus,thrownError) {
                alert(xhr + "\n" + textStatus + "\n" + thrownError);
            }
        });
    });




    // ADD QUESTIONS AND CHOICES
    $(document).on('click', '.add-question-modal', function(){
        var chapterId = $(this).data('id');
        var order = $(this).data('order');

        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: '/chapter/add/'+chapterId+'/'+order,
            type: 'GET',
            cache: false,
            data: {
                chapterId: chapterId,
                order: order
            },
            datatype: 'json',
            success: function(response) {
                if(response.success == true) {
                    $('#modal-edit-question .modal-content').html(response.html);
                    M.AutoInit();
                    $('#modal-edit-question').modal('open');
                    tinymce.init({
                        selector: '.wysiywg',
                        menubar: true,
                        plugins: [
                            'advlist lists image charmap preview textcolor',
                            'searchreplace visualblocks code fullscreen',
                            'insertdatetime media contextmenu table paste code wordcount'
                        ],
                        toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
                        content_css: [
                            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                            '//www.tinymce.com/css/codepen.min.css']
                    });

                    $('.add-question-modal-btn').on('click', function(){
                        var answer = confirm('Do you want to save changes you made to question #' + response.order + '?');

                        if(answer ==  true) {
                            $('#add-question-form').attr('action', '/chapter/add-question/'+ response.chapterId);
                        }
                    })

                } else {
                    alert('Error in editing question. Please try again.');
                }
            }
        });
    });


    //DISPLAY STUDENTS' PROGRESS
    $(document).on('click', '.btn-view-progress', function(){
        var userId = $(this).data('id');
        var subjectId = $(this).data('subjectid');

        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: 'student_progress/'+ userId,
            type: 'GET',
            cache: false,
            data: {
                userId: userId,
                subjectId:subjectId
            },
            datatype: 'json',
            success: function(response) {
                if(response.success == true) {
                    $('#progress-modal .modal-content').html(response.html);
                    M.AutoInit();
                    $('#progress-modal').modal('open');


                    var instance = M.Collapsible.getInstance($('.collapsible'));
                    instance.open(1);

                } else {
                    alert('Error in editing question. Please try again.');
                }
            }
        });

    });

    //DISPLAY STUDENTS' ANSWER HISTORY
    $(document).on('click', '.btn-view-history', function(){
        var userId = $(this).data('id');
        var subjectId = $(this).data('subjectid');
        var activityId = $(this).data('activityid');

        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: 'student_answer_history/'+ userId,
            type: 'GET',
            cache: false,
            data: {
                userId: userId,
                subjectId:subjectId,
                activityId:activityId
            },
            datatype: 'json',
            success: function(response) {
                if(response.success == true) {
                    $('#progress-modal .modal-content').html(response.html);
                    M.AutoInit();
                    $('#progress-modal').modal('open');


                    var instance = M.Collapsible.getInstance($('.collapsible'));
                    instance.open(1);

                } else {
                    alert('Error in editing question. Please try again.');
                }
            }
        });

    });



    //DISPLAY CLASS LIST WHEN CLASS IS SELECTED
    $(document).on('click', '.btn-view-class-list', function(){
        var sectionId = $(this).data('id');

        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: 'teacher_student_list/'+ sectionId,
            type: 'GET',
            cache: false,
            data: {
                sectionId: sectionId
            },
            datatype: 'json',
            success: function(response) {
                if(response.success == true) {
                    $('#teacher-sections-modal .modal-content').html(response.html);
                    M.AutoInit();
                    $('#teacher-sections-modal').modal('open');

                    // var instance = M.Collapsible.getInstance($('.collapsible'));
                    // instance.open(1);

                } else {
                    alert('Error in editing question. Please try again.');
                }
            }
        });
    });


    //EDIT A CLASS
    $(document).on('click', '.btn-open-edit-class-modal', function(e){
        e.preventDefault();
        e.stopPropagation();

        var sectionName = $(this).data('name');
        var sectionId = $(this).data('id');

            $.ajax({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                url: 'showEditClassForm/'+sectionId,
                type: 'GET',
                cache: false,
                data: {
                    sectionId: sectionId
                },
                datatype: 'json',
                success: function(response) {
                    $('#teacher-sections-modal .modal-content').html(response.html);
                    M.AutoInit();
                    $('#teacher-sections-modal').modal('open');
             }
        });
    });


    $(document).on('click', '.btn-edit-class', function(e){
        e.preventDefault();
        e.stopPropagation();

        var sectionName = $(this).data('name');
        var sectionId = $(this).data('id');

        var answer = confirm('Do you want to save changes you made to ' + sectionName + '?');

        if(answer ==  true) {
            var formData = $('[name=edit-class-form]').serialize();
            $.ajax({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                url: 'editClass/'+sectionId,
                type: 'POST',
                cache: false,
                data: formData,
                datatype: 'json',
                success: function(response) {
                    window.location.reload();
                }
            });
        }
    });

    //DELETING A CLASS
    $(document).on('click', '.btn-open-delete-class-modal', function(){
        var sectionId = $(this).data('id');
        var name = $(this).data('name');
        var level = $(this).data('level');
        var text = 'Do you want to delete '+ level+ ' - ' + name+'?';
        M.AutoInit();
        $('#delete-class-modal').modal('open');
        $('#delete-class-modal-question').text(text);
        $('#delete-class-modal-form').attr('action', '/deleteClass/' + sectionId);
    });


    $(document).on('click', '.reload-btn', function(){
        window.location.reload();
    });


    //SEARCH
    $(document).on('click', '.btn-teacher-search', function(){
       var searchkey = $('#teacher_search').val();
       alert(searchkey);
        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: 'searchClass/',
            type: 'GET',
            cache: false,
            data: { searchkey: searchkey },
            datatype: 'json',
            success: function(response) {
                $('#section-container').html("");
                $('#section-container').html(response.html);
            }
        });

    });


    //DELETING A STUDENT FROM A CLASS
    $(document).on('click', '.btn-open-remove-student-modal', function(){
        var userId = $(this).data('id');
        var sectionId = $(this).data('sectionid');
        var name = $(this).data('name');
        var level = $(this).data('level');
        var section = $(this).data('section');

        var text = 'Do you want to remove '+name+" from "+level+ ' - ' + section+'?';
        M.AutoInit();
        $('#remove-student-modal').modal('open');
        $('#remove-student-modal-question').text(text);
        $('#remove-from-section').val(sectionId);
        $('#remove-student').val(name);
        $('#remove-from-level').val(level);
        $('#remove-from-sectionName').val(section);
        $('#remove-student-modal-form').attr('action', '/removeStudent/' + userId);

        // data-id="{{ $user->id }}"
        // data-sectionid="{{ $section->id }}"
        // data-name="{{ $user->name }}"
        // data-level="{{ $section->level->name }}"
        // data-section="{{ $section->name }}"
    });

    //EDITING STUDENT DETAILS
    $(document).on('click', '.btn-open-edit-student-modal', function(){
        var userId = $(this).data('id');
        var name = $(this).data('name');
        var level = $(this).data('level');
        var section = $(this).data('section');
        var subject = $(this).data('subject');

        var text = "Type the changes you want to make to "+name+"'s account.";
        M.AutoInit();
        $('#edit-student-settings').modal('open');
        $('#edit-student-settings-question').text(text);
        $('#edit-student-name').val(name);
        $('#student-id').val(userId);
        $('#edit-student-level').val(level);
        $('#edit-student-section').val(section);
        $('#edit-student-subject').val(subject);
        $('#edit-student-settings-form').attr('action', '/editStudentSettings/' + userId);

    });





});