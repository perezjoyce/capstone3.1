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
                        @endif

                        @if(Session::has("successmessage"))
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
                    <div class="col s12 m5">
                        <form action="/teacher_curriculum/showTopics" method="POST" id="topic-filter-form">
                            @csrf

                            <div class="no-margin-bottom">

                                <div class="input-field col s12">
                                    <select name="level">
                                        <option value="" disabled selected>Select Grade Level</option>
                                        @foreach($levels as $level)
                                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="input-field col s12">
                                    <select name="subject" id="selected-subject">
                                        <option value="" disabled selected>Select Subject</option>
                                        @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="input-field col s12" id="module-options">
                                    <select name="module" id="selected-module">
                                        <option value="" disabled selected>Select Module</option>
                                        @foreach($modules as $module)
                                        <option value="{{ $module->id }}">{{ $module->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="input-field col s12">
                                <button class='btn right orange disabled' type="submit" id="showTopics-btn">
                                    LOAD TOPICS
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="row" id='topic_container'>
                    {{--LIST OF TOPICS ARE LOADED HERE--}}
                </div>


                    
            </div>
        </div>
   
    </main>
    @endsection

    <!--MODAL TEMPLATE FOR ADDING AN ACTIVITY-->
    <div id="modal-add-activity" class="modal">

        <div class='right row'>
            <a href="#!" class="modal-close waves-effect waves-light-blue btn-flat">&#9587</a>
        </div>


        <div class="modal-content">
            <h4>Modal Header</h4>
            <form method="POST" action="" id="add-activity-form">
                @csrf

                <div class="row">
                    <div class="col s12">
                        <h6 id='add-activity-modal-question'></h6>
                    </div>
                </div>


                <div class="row">
                    <div class="input-field col s12">
                        <button type='submit' class="waves-effect waves-light btn orange">
                            <i class="material-icons right"></i>
                            {{ __('Add Task') }}
                        </button>

                    </div>
                </div>

            </form>
        </div>
    </div>





   

