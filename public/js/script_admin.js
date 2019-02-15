$(document).ready(function(){


	//AJAX POST EXAMPLE // delete
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	$(".postbutton").click(function(){
	  $.ajax({
	      /* the route pointing to the post function */
	      url: '/postajax',
	      type: 'POST',
	      /* send the csrf-token and the input to the controller */
	      data: {_token: CSRF_TOKEN, message:$(".getinfo").val()},
	      dataType: 'JSON',
	      /* remind that 'data' is the response of the AjaxController */
	      success: function (data) { 
	          $(".writeinfo").append(data.msg); 
	      }
	  }); 
	});

    // SHOW QUESTIONS // delete
    function showQuestionsByGradeLevels(gradeLevelId) {
        $_token = "{{ csrf_token() }}";
        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: "{{ url('/questions/1') }}",
            type: 'GET',
            cache: false,
            data: { 'grade_level': gradeLevelId, '_token': $_token },
            datatype: 'json',
            beforeSend: function() {
                //something before send
            },
            success: function(response) {

                //success
                //var data = $.parseJSON(data);
                if(response.success == true) {
                    //user_jobs div defined on page
                    $('#display_output').html(response.html);
                } else {
                    $('#display_output').html(response.html);
                }
            },
            error: function(xhr,textStatus,thrownError) {
                alert(xhr + "\n" + textStatus + "\n" + thrownError);
            }
        });
    }

	// FILTER FORM TO VIEW TOPICS
    $("#topic-filter-form").on('submit', function(e){
    	e.preventDefault();
    	e.stopPropagation();
        $_token = "{{ csrf_token() }}";
        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: '/admin_curriculum/showTopics',
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
    })


    // FILTER MODULES BASED ON SUBJECT
    $("#selected-subject").on('change', function(e){
        e.preventDefault();
        e.stopPropagation();
        $_token = "{{ csrf_token() }}";
        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: '/admin_curriculum/showModules',
            type: 'GET',
            cache: false,
            data: {'subject': $(this).val()},
            datatype: 'json',
            beforeSend: function() {
                //something before send
            },
            success: function(response) {

                //success
                //var data = $.parseJSON(data);
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

    // EDIT LESSON
    $(document).on('click', '.edit-chapter-modal', function(){
        const chapterId = $(this).data('id');
        const column = $(this).data('column');

        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: '/chapter/edit/'+chapterId,
            type: 'GET',
            cache: false,
            data: {
                chapterId: chapterId,
                column: column
            },
            datatype: 'json',
            beforeSend: function() {
                //something before send
            },
            success: function(response) {

                if(response.success == true) {
                    $('#modal-edit-chapter .modal-content').html(response.html);
                    M.AutoInit();
                    $('#modal-edit-chapter').modal('open');
                    // tinymce.init({
                    //     selector: '.wysiywg',
                    //     menubar: true,
                    //     plugins: [
                    //         'advlist lists image charmap preview textcolor',
                    //         'searchreplace visualblocks code fullscreen',
                    //         'insertdatetime media contextmenu table paste code wordcount'
                    //     ],
                    //     toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
                    //     content_css: [
                    //         '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                    //         '//www.tinymce.com/css/codepen.min.css']
                    // });
                    var editor_config = {
                        path_absolute : "/",
                        selector: ".wysiywg",
                        plugins: [
                            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                            "searchreplace wordcount visualblocks visualchars code fullscreen",
                            "insertdatetime media nonbreaking save table contextmenu directionality",
                            "emoticons template paste textcolor colorpicker textpattern"
                        ],
                        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
                        relative_urls: false,
                        file_browser_callback : function(field_name, url, type, win) {
                            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                            if (type == 'image') {
                                cmsURL = cmsURL + "&type=Images";
                            } else {
                                cmsURL = cmsURL + "&type=Files";
                            }

                            tinyMCE.activeEditor.windowManager.open({
                                file : cmsURL,
                                title : 'Filemanager',
                                width : x * 0.8,
                                height : y * 0.8,
                                resizable : "yes",
                                close_previous : "no"
                            });
                        },
                        content_css: [
                            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                            '//www.tinymce.com/css/codepen.min.css']
                    };

                    tinymce.init(editor_config);

                    $('.edit-chapter-modal-btn').on('click', function(){
                        var answer = confirm('Do you want to save changes you made to ' + response.column +  '?');

                        if(answer ==  true) {
                            $('#'+'edit-'+response.column+'-form').attr('action', '/chapter/edit-'+response.column+'/'+response.chapterId);
                        }
                    })


                } else {
                    alert('Error in editing form. Please try again.');
                }
            },
            error: function(xhr,textStatus,thrownError) {
                alert(xhr + "\n" + textStatus + "\n" + thrownError);
            }
        });
    });


    // EDIT CHAPTER QUESTIONS AND CHOICES
    $(document).on('click', '.edit-question-modal', function(){
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
                    // tinymce.init({
                    //     selector: '.wysiywg',
                    //     menubar: true,
                    //     plugins: [
                    //         'advlist lists image charmap preview textcolor',
                    //         'searchreplace visualblocks code fullscreen',
                    //         'insertdatetime media contextmenu table paste code wordcount'
                    //     ],
                    //     toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
                    //     content_css: [
                    //         '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                    //         '//www.tinymce.com/css/codepen.min.css']
                    // });

                    var editor_config = {
                        path_absolute : "/",
                        selector: ".wysiywg",
                        plugins: [
                            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                            "searchreplace wordcount visualblocks visualchars code fullscreen",
                            "insertdatetime media nonbreaking save table contextmenu directionality",
                            "emoticons template paste textcolor colorpicker textpattern"
                        ],
                        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
                        relative_urls: false,
                        file_browser_callback : function(field_name, url, type, win) {
                            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                            if (type == 'image') {
                                cmsURL = cmsURL + "&type=Images";
                            } else {
                                cmsURL = cmsURL + "&type=Files";
                            }

                            tinyMCE.activeEditor.windowManager.open({
                                file : cmsURL,
                                title : 'Filemanager',
                                width : x * 0.8,
                                height : y * 0.8,
                                resizable : "yes",
                                close_previous : "no"
                            });
                        },
                        content_css: [
                            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                            '//www.tinymce.com/css/codepen.min.css']
                    };

                    tinymce.init(editor_config);

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
                    // tinymce.init({
                    //     selector: '.wysiywg',
                    //     menubar: true,
                    //     plugins: [
                    //         'advlist lists image charmap preview textcolor',
                    //         'searchreplace visualblocks code fullscreen',
                    //         'insertdatetime media contextmenu table paste code wordcount'
                    //     ],
                    //     toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
                    //     content_css: [
                    //         '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                    //         '//www.tinymce.com/css/codepen.min.css']
                    // });

                    var editor_config = {
                        path_absolute : "/",
                        selector: ".wysiywg",
                        plugins: [
                            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                            "searchreplace wordcount visualblocks visualchars code fullscreen",
                            "insertdatetime media nonbreaking save table contextmenu directionality",
                            "emoticons template paste textcolor colorpicker textpattern"
                        ],
                        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
                        relative_urls: false,
                        file_browser_callback : function(field_name, url, type, win) {
                            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                            if (type == 'image') {
                                cmsURL = cmsURL + "&type=Images";
                            } else {
                                cmsURL = cmsURL + "&type=Files";
                            }

                            tinyMCE.activeEditor.windowManager.open({
                                file : cmsURL,
                                title : 'Filemanager',
                                width : x * 0.8,
                                height : y * 0.8,
                                resizable : "yes",
                                close_previous : "no"
                            });
                        },
                        content_css: [
                            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                            '//www.tinymce.com/css/codepen.min.css']
                    };

                    tinymce.init(editor_config);

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


    //DELETING CHAPTER CONTENT
    $(document).on('click', '.delete-modal-btn', function(){
        var column = $(this).data('column');
        var id = $(this).data('id');
        var text = "";

        if(column == 'questions'){
            var order = $(this).data('order');
            text = 'Do you want to delete question # '+order+'?';
            M.AutoInit();
            $('#delete-modal').modal('open');
            $('#delete-modal-question').text(text);
            $('#delete-modal-form').attr('action', '/deleteQuestion/' + id);

        } else {
            var order = $(this).data('order');
            text = 'Do you want to delete the contents of this lesson?';
            M.AutoInit();
            $('#delete-modal').modal('open');
            $('#delete-modal-question').text(text);
            $('#delete-modal-form').attr('action', '/deleteChapter/' + id);
        }


    })



    //REPORT STATUS MODAL
    $(document).on('change','.report-status', function(e){
        e.preventDefault();
        e.stopPropagation();

        var status = $(this).val();
        var chapterId = $(this).data('chapterid');
        var field = $(this).data('field');
        var topic = $(this).data('topic');
        var level = $(this).data('level');
        var subject = $(this).data('subject');

        // alert(status);
        // alert(chapterId);
        // alert(field);
        // alert(topic);
        // alert(level);
        // alert(subject);

        var text = "Do you want to mark "+topic+" of "+level+" - "+subject+" as "+status+" ?";
        M.AutoInit();
        $('#report-status-modal').modal('open');
        $('#report-status-modal-question').text(text);
        $('#report-status-modal-form').attr('action', 'changeReportStatus/');
        $('#report-status-modal-chapter').val(chapterId);
        $('#report-status-modal-field').val(field);

    });

    $(document).on('click', '#btn-view-completed-reports', function(e){
        e.preventDefault();
        e.stopPropagation();

        var status = $(this).val();
        var chapterId = $(this).data('chapterid');
        var field = $(this).data('field');

        $_token = "{{ csrf_token() }}";
        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: 'view_completed_reports/',
            type: 'GET',
            cache: false,
            data: {
                chapterId:chapterId,
                field:field
            },
            datatype: 'json',
            beforeSend: function() {
                //something before send
            },
            success: function(response) {

                //success
                //var data = $.parseJSON(data);
                if(response.success == true) {
                    $("#admin-modal-container .modal-content").html(response.html);
                    M.AutoInit();
                    $('#admin-modal-container').modal('open');
                } else {
                    $("#admin-modal-container .modal-content").html(response.html);
                }
            },
            error: function(xhr,textStatus,thrownError) {
                alert(xhr + "\n" + textStatus + "\n" + thrownError);
            }
        });

    });


    $(document).on('click', '.btn-open-question-modal', function(e){
        e.preventDefault();
        e.stopPropagation();

        var questionId = $(this).data('id');

        $_token = "{{ csrf_token() }}";
        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: 'view_submitted_question/'+questionId,
            type: 'GET',
            cache: false,
            data: {
                questionId:questionId
            },
            datatype: 'json',
            beforeSend: function() {
                //something before send
            },
            success: function(response) {

                //success
                //var data = $.parseJSON(data);
                if(response.success == true) {
                    $("#admin-modal-container .modal-content").html(response.html);
                    M.AutoInit();
                    $('#admin-modal-container').modal('open');
                } else {
                    $("#admin-modal-container .modal-content").html(response.html);
                }
            },
            error: function(xhr,textStatus,thrownError) {
                alert(xhr + "\n" + textStatus + "\n" + thrownError);
            }
        });
    });

    // $(document).on('click', '.btn-approve-question', function(e){
    //     e.preventDefault();
    //     e.stopPropagation();
    //
    //     var questionId = $(this).data('id');
    //     var answer = confirm('Do you want to mark this question as approved?');
    //
    //     if(answer ==  true) {
    //       $('.approve_question_form_'+questionId).attr('action', 'approve_submitted_question/'+questionId);
    //         // M.AutoInit();
    //     }
    // });


    $(document).on('click', '#btn-view-approved_questions', function(e){
        e.preventDefault();
        e.stopPropagation();

        var chapterId = $(this).data('chapterid');
        var field = $(this).data('field');

        // alert(chapterId);
        // alert(field);

        $_token = "{{ csrf_token() }}";
        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: 'view_approved_questions/',
            type: 'GET',
            cache: false,
            data: {
                chapterId:chapterId,
                field:field
            },
            datatype: 'json',
            beforeSend: function() {
                //something before send
            },
            success: function(response) {

                //success
                //var data = $.parseJSON(data);
                if(response.success == true) {
                    $("#admin-modal-container .modal-content").html(response.html);
                    M.AutoInit();
                    $('#admin-modal-container').modal('open');
                } else {
                    $("#admin-modal-container .modal-content").html(response.html);
                }
            },
            error: function(xhr,textStatus,thrownError) {
                alert(xhr + "\n" + textStatus + "\n" + thrownError);
            }
        });

    });


    $(document).on('change', '.btn-user-status', function(){
        var userId = $(this).val();
        // alert(userId);
        var action = "";

        if (this.checked) {
            var action = 'activate';
        } else {
            var action = 'deactivate';
        }

        $_token = "{{ csrf_token() }}";
        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: 'change_user_status/'+userId,
            type: 'POST',
            cache: false,
            data: {
                userId:userId,
                action:action
            },
            datatype: 'json',
            beforeSend: function() {
                //something before send
            },
            success: function(response) {

                if(response.success == true) {
                    M.toast({html: response.html , classes: 'rounded'});
                } else {
                    M.toast({html: response.html , classes: 'rounded'});
                }
            },
            error: function(xhr,textStatus,thrownError) {
                alert(xhr + "\n" + textStatus + "\n" + thrownError);
            }
        });
    });

    //EDIT CURRICULUM
    $(document).on('click', '.btn-edit-curriculum', function(){
        var component = $(this).data('component');
        var componentId = $(this).data('id');
        var componentName = $(this).data('name');
        var color = $(this).data('color')

        var question = 'Type and save your changes to '+componentName+'.';
        $("#admin-modal-container-small-question").text(question);
        $("#admin-modal-container-small-input").attr('placeholder',componentName);
        $("#admin-modal-container-small-input").attr('name', component);
        $("#admin-modal-container-small-input").attr('data-id',componentId);
        $("#btn-admin-modal-container-small").addClass(color);
        $("#btn-admin-modal-container-small").attr('data-component', component);
        $("#btn-admin-modal-container-small").attr('data-id', componentId);
        $("#btn-admin-modal-container-small").attr('data-name', componentName);

        M.AutoInit();
        $('#admin-modal-container-small').modal('open');
    });


    //SAVE CURRICULUM EDIT
    $(document).on('click', '#btn-admin-modal-container-small', function(){
       // e.preventDefault();
       // e.stopPropagation();

        var component = $(this).data('component');
        var componentId = $(this).data('id');
        var componentName = $(this).data('name');
        var newComponent =  $("#admin-modal-container-small-input").val();

        // alert(newComponent);

        var answer = confirm('Would you like to save your changes to '+componentName+' '+component+'?');

        if(answer ==  true) {
            // $('#edit-curriculum-form').attr('action', 'edit_curriculum_'+component+'/'+componentId);

            $_token = "{{ csrf_token() }}";
            $.ajax({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                url: 'edit_curriculum_'+component+'/'+componentId,
                type: 'POST',
                cache: false,
                data: {
                    component:component,
                    componentId:componentId,
                    newComponent:newComponent
                },
                datatype: 'json',
                beforeSend: function() {
                    //something before send
                },
                success: function(response) {

                    if(response.success == true) {
                        // alert(response.component);

                        if(response.component == 'level'){
                            $('#grade_levels').html(response.html);
                            M.AutoInit();
                            M.toast({html: response.confirmation , classes: 'rounded'});
                        } else if (response.component == 'subject'){
                            $('#subject_listing').html(response.html);
                            // $('#tab-level').attr('class', 'active');
                            M.AutoInit();
                            M.toast({html: response.confirmation , classes: 'rounded'});
                        } else if (response.component == 'module'){
                            // $('#tab-module').attr('class', 'active');
                            // M.Tabs.init(el, options);
                            // instance.select('tab-subject');
                            $('#module_listing').html(response.html);
                            M.AutoInit();
                            M.toast({html: response.confirmation , classes: 'rounded'});
                        } else if (response.component == 'topic'){
                            $('#topic_container').html(response.html);
                            // $('#tab-topic').attr('class', 'active');
                            M.AutoInit();
                            M.toast({html: response.confirmation , classes: 'rounded'});
                        }

                    } else {
                        M.toast({html: response.confirmation , classes: 'rounded'});
                    }
                },
                error: function(xhr,textStatus,thrownError) {
                    alert(xhr + "\n" + textStatus + "\n" + thrownError);
                }
            });
        }
    });


    //ADD OR DELETE CURRICULUM LEVEL AND SUBJECT
    $(document).on('click', '.btn_add_or_delete_curriculum',  function(){
        var action = $(this).data('action');
        var component = $(this).data('component');
        var color = $(this).data('color');

        // alert(action);
        // alert(component);
        // alert(color);

        if(action == 'delete' || action == 'undelete'){
            var componentId = $(this).data('id');
            var componentName = $(this).data('name');

            var question = "Do you want to delete"+componentName+"?";
            $("#admin_addOrDeleteLevelOrSubject_question").text(question);
            $("#admin_addOrDeleteLevelOrSubject_input").attr('type', 'hidden');
            $("#btn_admin_addOrDeleteLevelOrSubject").addClass(color);
            $("#btn_admin_addOrDeleteLevelOrSubject").attr('data-id', componentId);
            $("#btn_admin_addOrDeleteLevelOrSubject").attr('data-action', action);
            $("#btn_admin_addOrDeleteLevelOrSubject").attr('data-component', component);
            $("#btn_admin_addOrDeleteLevelOrSubject").attr('data-name', componentName);

        } else {

            var question = 'Type the name of the '+component+' you want to add.';
            $("#admin_addOrDeleteLevelOrSubject_question").text(question);
            $("#admin_addOrDeleteLevelOrSubject_input").attr('type', 'text');
            $("#btn_admin_addOrDeleteLevelOrSubject").addClass(color);
            $("#btn_admin_addOrDeleteLevelOrSubject").attr('data-action', action);
            $("#btn_admin_addOrDeleteLevelOrSubject").attr('data-component', component);

        }
        M.AutoInit();
        $('#admin_addOrDeleteLevelOrSubject_modal').modal('open');

    });



    //SUBMIT ACTIONS : ADD OR DELETE
    $(document).on('click', '#btn_admin_addOrDeleteLevelOrSubject', function(){
        var action = $(this).data('action');
        var component = $(this).data('component');

        if(action == 'add'){
            var newComponent = $("#admin_addOrDeleteLevelOrSubject_input").val();
            var answer = confirm('Would you like to save this as a new '+component+"?");

            if(answer == true){
                $_token = "{{ csrf_token() }}";
                $.ajax({
                    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                    url: 'add_curriculum_'+component,
                    type: 'POST',
                    cache: false,
                    data: {
                        component:component,
                        newComponent:newComponent
                    },
                    datatype: 'json',
                    beforeSend: function() {
                        //something before send
                    },
                    success: function(response) {

                        if(response.success == true) {
                            alert(response.component);

                            if(response.component == 'level'){
                                $('#grade_levels').html(response.html);
                                M.AutoInit();
                                M.toast({html: response.confirmation , classes: 'rounded'});
                            } else if (response.component == 'subject'){
                                $('#subject_listing').html(response.html);
                                // $('#tab-level').attr('class', 'active');
                                M.AutoInit();
                                M.toast({html: response.confirmation , classes: 'rounded'});
                            } else if (response.component == 'module'){
                                // $('#tab-module').attr('class', 'active');
                                // M.Tabs.init(el, options);
                                // instance.select('tab-subject');
                                $('#module_listing').html(response.html);
                                M.AutoInit();
                                M.toast({html: response.confirmation , classes: 'rounded'});
                            } else if (response.component == 'topic'){
                                $('#topic_container').html(response.html);
                                // $('#tab-topic').attr('class', 'active');
                                M.AutoInit();
                                M.toast({html: response.confirmation , classes: 'rounded'});
                            }

                        } else {
                            M.toast({html: response.negation , classes: 'rounded'});
                        }
                    },
                    error: function(xhr,textStatus,thrownError) {
                        alert(xhr + "\n" + textStatus + "\n" + thrownError);
                    }
                });
            }
        } else if($action == 'delete') {
            //delete
        } else {
            //undelete
        }

    });

    //ADD MODULE
    $(document).on('click', '#btn_admin_add_module', function(e){
        e.preventDefault();
        e.stopPropagation();

        var newModule = $('#admin_add_module_name').val();
        var subjectId =  $('#admin_add_module_subjectId').val();

        // alert(categoryId);
        // alert(newModule);

        var answer = confirm('Would you like to save '+newModule+' as a new module?');
        if(answer == true){
            $_token = "{{ csrf_token() }}";
            $.ajax({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                url: 'add_new_module',
                type: 'POST',
                cache: false,
                data: {
                    newModule:newModule,
                    subjectId:subjectId
                },
                datatype: 'json',
                beforeSend: function() {
                    //something before send
                },
                success: function(response) {

                    if(response.success == true) {

                        $('#module_listing').html(response.html);
                        M.AutoInit();
                        M.toast({html: response.confirmation , classes: 'rounded'});

                    } else {
                        M.toast({html: response.negation , classes: 'rounded'});
                    }
                },
                error: function(xhr,textStatus,thrownError) {
                    alert(xhr + "\n" + textStatus + "\n" + thrownError);
                }
            });
        }
    });

    //ADD TOPIC
    $(document).on('click', '#btn_admin_add_topic', function(e){
        e.preventDefault();
        e.stopPropagation();

        var newTopic = $('#admin_add_topic_name').val();
        var levelId =  $('#admin_add_topic_levelId').val();
        var moduleId =  $('#admin_add_topic_moduleId').val();

        // alert(categoryId);
        // alert(newModule);

        var answer = confirm('Would you like to save '+newTopic+' as a new topic?');
        if(answer == true){
            $_token = "{{ csrf_token() }}";
            $.ajax({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                url: 'add_new_topic',
                type: 'POST',
                cache: false,
                data: {
                    newTopic:newTopic,
                    levelId:levelId,
                    moduleId:moduleId
                },
                datatype: 'json',
                beforeSend: function() {
                    //something before send
                },
                success: function(response) {

                    if(response.success == true) {

                        $('#topic_container').html(response.html);
                        M.AutoInit();
                        M.toast({html: response.confirmation , classes: 'rounded'});

                    } else {
                        M.toast({html: response.negation , classes: 'rounded'});
                    }
                },
                error: function(xhr,textStatus,thrownError) {
                    alert(xhr + "\n" + textStatus + "\n" + thrownError);
                }
            });
        }
    });







});