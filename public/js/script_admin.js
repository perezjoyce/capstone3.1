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
    $('.edit-chapter-modal').on('click', function(){
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

        alert(status);
        alert(chapterId);
        alert(field);
        alert(topic);
        alert(level);
        alert(subject);

        var text = "Do you want to mark "+topic+" of "+level+" - "+subject+" as "+status+" ?";
        M.AutoInit();
        $('#report-status-modal').modal('open');
        $('#report-status-modal-question').text(text);
        $('#report-status-modal-form').attr('action', 'update_report_status');



        // <input type="text" value="{{ $pending_reports[$i]->chapter_id }}" name="reported_chapter">
        //         <input type="text" value="{{ $pending_reports[$i]->field }}" name="reported_field">
        //         <select class="browser-default" class="report-status">
        //         <option value="1" selected name="report-status">Pending</option>
        //         <option value="2" name="report-status">Completed</option>
        //         </select>
    })









});