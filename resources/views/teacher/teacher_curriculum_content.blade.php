<!DOCTYPE html>
@extends('layouts.app')
@section('main')
<main>
    @include('sidenav_teacher')

        <div class="row no-margin-bottom">
            <div class="col s12">

                <div class="col s12 hide-on-med-and-down">
                    <h4 class='deep-purple-text text-darken-4 right custom-heading'>Curriculum</h4>    
                </div>
                       
                
                <div class="row hide-on-large-only deep-purple darken-4">
                    <div class="col s6">
                        <h4 class='white-text custom-heading'>Curriculum</h4>
                    </div>
                    <div class="col s6 right">
                        <ul class="right hide-on-large-only">
                            <a href="#" data-target="slide-out" class="sidenav-trigger orange-text"><i class="material-icons white-text"><h5>menu</h5></i></a>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12">
                        @if($errors->any())
                            <div class="alert alert-danger mb-5 rounded-0">
                                <ul class='list-unstyled'>
                                    @foreach ($errors->all() as $error)
                                        <script>

                                            var toastHTML = '<span>{{ $error }}</span>';
                                            M.toast({html: toastHTML, classes: 'rounded'});

                                        </script>
                                    @endforeach
                                </ul>
                            </div>
                        @elseif(Session::has("successmessage"))
                            <div class="alert alert-danger mb-5 rounded-0">
                                <ul class='list-unstyled'>

                                    <script>

                                        var toastHTML = '<span>{{ Session::get('successmessage') }}</span>';
                                        M.toast({html: toastHTML, classes: 'rounded'});

                                    </script>
                                </ul>
                            </div>
                        @elseif(Session::has("deletemessage"))
                            <div class="alert alert-danger mb-5 rounded-0">
                                <ul class='list-unstyled'>
                                    <script>
                                        var toastHTML = '<span>{{ Session::get('deletemessage') }}</span>';
                                        M.toast({html: toastHTML, classes: 'rounded'});
                                    </script>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>



                 <div class="row">
                    <div class="col s12">
                        <br>
                        <ul class="tabs tabs-fixed-width tab-demo z-depth-0">
                            <li class="tab"><a href="#grade_levels">Grade Levels</a></li>
                            <li class="tab"><a href="#subject_listing" class='active'>Subjects</a></li>
                            <li class="tab"><a href="#module_listing">Modules</a></li>
                            <li class="tab"><a href="#topic_listing">Topics</a></li>
                            <li class="tab"><a href="#chapter_content">Chapters</a></li>
                        </ul>
                    </div>
                 </div>
                
               
                <div class="row" id='grade_levels'>
                    <div class="col s12">
                        <br>
                        <div class="container">
                            <div class="row">
                                <div class="col s12">
                                    <table class='responsive-table'>
                                        <thead>
                                          <tr>
                                            <th>Categories</th>
                                            <th>Grade Levels</th>                            
                                          </tr>
                                        </thead>

                                        <tbody>
                                        
                                        @foreach($categories as $category)
                                          <tr>
                                            <td>{{$category->name}}</td>
                                            
                                            <td>
                                                @foreach($category->levels as $level)
                                                <div>
                                                    <table class="inner responsive-table highlight">
                                                        <tr>
                                                            <td>{{ $level->name }}</td>
                                                            <td class='right'><button class='btn orange'>Update</button></td>
                                                            <td class='right'><button class='btn orange lighten-3'>Delete</button></td>
                                                        </tr>    
                                                    </table>
                                                    
                                                </div>
                                                @endforeach
                                            </td>
                                           
                                          </tr>
                                        @endforeach
                                            
                                      </table>

                                </div>

                                <div class="col s12">
                                    <br>
                                    <div class="row">
                                        <div class="col s3">
                                            <button class='btn orange lighten-3 left'>
                                                <i class="material-icons left">edit</i>
                                                <span>Edit Category</span>
                                            </button>
                                        </div>
                                  
                                        <div class="col s3">
                                            <button class='btn orange left'>
                                                <i class="material-icons left">add</i>
                                                Add Category
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container" id='subject_listing'>
               
                                <div class="col s12">
                                    <ul class="collapsible" data-collapsible="accordion">

                                        @foreach($levels as $level)
                                        <li class='active'>
                                            <div class="collapsible-header">
                                                <span class='bold'>Level:&nbsp;</span>
                                                <span>{{ $level->name }}</span>
                                            </div>
                                            <div class="collapsible-body custom-padding">
                                                <ul class="collapsible" data-collapsible="accordion">
                                                    @foreach($subjects as $subject)
                                                    <li class='active'>
                                                        <div class="collapsible-header">
                                                            <span class='bold'>Subject {{ $subject->id }}:&nbsp;</span>
                                                            <span>{{ $subject->name }}</span>
                                                        </div>
                                                        <div class="collapsible-body custom-padding">
                                                            <ul class="collapsible" data-collapsible="accordion">
                                                                @foreach($subject->modules as $module)
                                                                <li class='active'>
                                                                    <div class="collapsible-header">
                                                                        <span class='bold'>Module:&nbsp;</span>
                                                                        <span>{{ $module->name }}</span>
                                                                    </div>
                                                                    <div class="collapsible-body border-bottom-none custom-padding">               
                                                                            <table class='inner responsive-table'>
                                                                                <tbody>
                                                                                
                                                                                    @foreach($module->topics as $topic)
                                                                                    @if($level->id == $topic->level_id)
                                                                                    <tr class='border-bottom-none'>
                                                                                       
                                                                                        <ul class="collapsible" data-collapsible="accordion">
                                                                                            <li class='active'>
                                                                                                <div class="collapsible-header">
                                                                                                    <span class='bold'>Topic:&nbsp;</span>
                                                                                                     {{ $topic->name }}
                                                                                                </div>
                                                                                                <div class="collapsible-body custom-padding">
                                                                                                    <button class='btn orange'>Update</button>
                                                                                                    <button class='btn orange lighten-3'>Delete</button>
                                                                                                </div>
                                                                                            </li>
                                                                                        </ul>
                                                                                        
                                                                                    </tr>

                                                                                    @endif
                                                                                    @endforeach
                                                                                </tbody>
                                                                                    
                                                                            </table>

                                                                       
                                                                           
                                                                    </div>
                                                                </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                        </li>
                                        @endforeach
                                    </ul>



                                </div>
                           
                </div>

                <div class="row" id='module_listing'>
                   modules
                </div>

                 <div class="row" id='topic_listing'>
                    <div class="col s4">
                   
                        <div class="no-margin-bottom">
                            <div class="input-field col l12 m3 s12">
                                <select>
                                    <option value="" disabled selected>Select Grade Level</option>
                                    @foreach($levels as $level)
                                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="input-field col l12 m3 s12">
                                <select>
                                    <option value="" disabled selected>Select Subject</option>
                                    @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        

                            <div class="input-field col l12 m6 s12">
                                <select>
                                    <option value="" disabled selected>Select Module</option>
                                    @foreach($modules as $module)
                                    <option value="{{ $subject->id }}">{{ $module->name }}</option>
                                    @endforeach
                                </select>
                            </div>



                             <div class="input-field col l12 m6 s12">
                                <select>
                                    <option value="" disabled selected>Select Topic</option>
                                    @foreach($topics as $topic)
                                    <option value="{{ $subject->id }}">{{ $topic->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            
                        </div>
                    
                        <ul class="collapsible col l12 m4 s12">
                            @foreach($modules as $module)
                            <li>
                               
                                <div class="collapsible-header" id='{{ $module->name }}'>
                                    <i class="material-icons orange-text text-lighten-2 list_alt_custom">list_alt</i>
                                     <!-- <span class='orange-text'>{{$module->id}} . </span> -->
                                    <span class='grey-text text-darken-3'> {{ $module->name }}</span>
                                </div>
                               
                                

                                @foreach($module->topics as $topic)
                                <div class="collapsible-body">
                                    <!-- <form action="#"> -->
                                      <label>
                                        <input type="checkbox" class='orange lighten-3 filled-in'/>
                                        <span onclick="{{ $topic->id }}">{{$topic->name}}xx</span>
                                      </label>
                                    <!-- </form> -->
                                </div>
                                @endforeach

                               
                            </li>
                            @endforeach
                            
                        </ul>


                       
                   
                    </div>
                </div>

                <div class="row" id='chapter_content'>
                    <div class="col s12">
                   
                        <div class="no-margin-bottom">
                            <div class="input-field col l3 m3 s12">
                                <select>
                                    <option value="" disabled selected>Select Grade Level</option>
                                    @foreach($levels as $level)
                                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="input-field col l3 m3 s12">
                                <select>
                                    <option value="" disabled selected>Select Subject</option>
                                    @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        

                            <div class="input-field col l3 m6 s12">
                                <select>
                                    <option value="" disabled selected>Select Module</option>
                                    @foreach($modules as $module)
                                    <option value="{{ $subject->id }}">{{ $module->name }}</option>
                                    @endforeach
                                </select>
                            </div>



                             <div class="input-field col l3 m6 s12">
                                <select>
                                    <option value="" disabled selected>Select Topic</option>
                                    @foreach($topics as $topic)
                                    <option value="{{ $subject->id }}">{{ $topic->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            
                        </div>
                    
                        <ul class="collapsible col l3 m4 s12">
                            @foreach($modules as $module)
                            <li>
                               
                                <div class="collapsible-header" id='{{ $module->name }}'>
                                    <i class="material-icons orange-text text-lighten-2 list_alt_custom">list_alt</i>
                                     <!-- <span class='orange-text'>{{$module->id}} . </span> -->
                                    <span class='grey-text text-darken-3'> {{ $module->name }}</span>
                                </div>
                               
                                

                                @foreach($module->topics as $topic)
                                <div class="collapsible-body">
                                    <!-- <form action="#"> -->
                                      <label>
                                        <input type="checkbox" class='orange lighten-3 filled-in'/>
                                        <span onclick="{{ $topic->id }}">{{$topic->name}}xx</span>
                                      </label>
                                    <!-- </form> -->
                                </div>
                                @endforeach

                               
                            </li>
                            @endforeach
                            
                        </ul>


                        <div class="col l9 m8 s12">
                            
                            <textarea id='display' style="height:50vh;"></textarea>

                        </div>
                   
                    </div>
                </div>

                    
            </div>
        </div>
   
</main>
@endsection

<!-- <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=yteahm9v51k11igyavl4mvnrdpgt89b78qma0whsx6gp6z12"></script>
<script>
    tinymce.init({ 
        selector:'textarea' 
    });
</script> -->
<style>
    table table.inner tr:last-child {
        border-bottom: none;
    }
</style>

<script>
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
</script>





   

