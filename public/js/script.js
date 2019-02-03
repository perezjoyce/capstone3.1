$(document).ready(function(){


	//AJAX POST EXAMPLE
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

    // SHOW QUESTIONS
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
    })


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
                //var data = $.parseJSON(data);
                if(response.success == true) {
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

                    $('.edit-chapter-modal-btn').on('click', function(){
                        var answer = confirm('Do you want to save changes you made?');

                        if(answer ==  true) {
                            $('#'+'edit-'+response.column+'-form').attr('action', '/teacher_topic_chapters/edit-'+response.column+'/'+response.chapterId);
                        }
                    })


                } else {
                    $('#module-options').replaceWith(response.html);
                }
            },
            error: function(xhr,textStatus,thrownError) {
                alert(xhr + "\n" + textStatus + "\n" + thrownError);
            }
        });

    });
});