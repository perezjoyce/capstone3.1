$(document).ready(function(){

    //ACTIVITY
    $('#answered-activity-form').on('submit', function(e){
        e.preventDefault();
        e.stopPropagation();
        var activityId = $("#activityId").val();

        var answer = confirm('Do you want to submit your answers?');
        if(answer ==  true) {
            //$('#modal-show-activity-result .modal-content').html();
            //M.AutoInit();
            //$('#modal-show-activity-result').modal('open');
            // $_token = "{{ csrf_token() }}";
            $.ajax({
                headers: {'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')},
                url: '/checkAnswers/' + activityId,
                type: 'POST',
                cache: false,
                data: $('#answered-activity-form').serialize(),
                datatype: 'json',
                beforeSend: function () {
                    //something before send
                },
                success: function (response) {

                    if (response.success == true) {
                        $('#modal-show-activity-result').html(response.html);
                        M.AutoInit();
                        // $('#modal-show-activity-result').openModal({dismissible:false});
                        $('#modal-show-activity-result').modal('open');


                    } else {
                        alert('Please try again.');
                    }
                },
                error: function (xhr, textStatus, thrownError) {
                    alert(xhr + "\n" + textStatus + "\n" + thrownError);
                }
            });
        }
    });

    $(document).on('click', '.reload-btn', function(){
        window.location.reload();
    })

    //SEARCH
    $(document).on('click', '.btn-teacher-search', function(){
        var searchkey = $('#teacher_search').val();
        // alert(searchkey);
        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: 'searchSubject/',
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


    //=========CODE BELOW DO NOT BELONG TO STUDENT ===========
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

    // REPORTING ERRORS
    $(document).on('click', '.report-modal-btn', function(){
        var column = $(this).data('column');
        var chapterId = $(this).data('id');

        $('#modal-report-error').modal('open');
        $('#column_with_error').val(column);

    });







});