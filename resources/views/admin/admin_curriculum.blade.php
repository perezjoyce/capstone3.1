<!DOCTYPE html>
@extends('layouts.app')
@section('main')
    <main>
        @include('sidenav_admin')
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
                    <div class="col s12">
                        <br>
                        <ul class="tabs tabs-fixed-width tab-demo z-depth-0">
                            <li class="tab"><a href="#grade_levels" id="tab-level" class="">Levels</a></li>
                            <li class="tab"><a href="#subject_listing" id="tab-subject" class="">Subjects</a></li>
                            <li class="tab"><a href="#module_listing" id="tab-module" class="">Modules</a></li>
                            <li class="tab"><a href="#topic_listing" id="tab-topic" class="">Topics</a></li>
                        </ul>
                    </div>
                </div>

                {{--GRADE LEVELS--}}
                <div class="row" id='grade_levels'>
                    <div class="col s12">
                        <div class="container">
                            <table class="grey-text text-darken-3 striped">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Level</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($levels as $level)
                                    <tr>
                                        <td></td>
                                        <td>{{ $level->name }}</td>
                                        <td class="right">
                                            <button class="btn red lighten-2 btn_add_or_delete_curriculum"
                                                    data-component="level"
                                                    data-action="delete"
                                                    data-id="{{ $level->id }}"
                                                    data-name="{{ $level->name }}"
                                                    data-color="red"
                                                >
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <button class="btn orange lighten-1 btn-edit-curriculum"
                                                    data-component="level"
                                                    data-id="{{ $level->id }}"
                                                    data-name="{{ $level->name }}"
                                                    data-color="orange"
                                                >
                                                <i class="material-icons">edit</i>
                                            </button>
                                        </td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="container">
                            <table>
                                <thead>
                                    <tr class="border-bottom-none">
                                        <th></th>
                                        <th></th>
                                        <th>
                                            <button class="btn green lighten-1 right btn_add_or_delete_curriculum"
                                                    data-component="level"
                                                    data-action="add"
                                                    data-color="green"
                                            >
                                                <i class="material-icons">add</i>
                                            </button>
                                        </th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                {{--SUBJECT LISTING--}}
                <div class="row" id='subject_listing'>
                    <div class="col s12">
                        <div class="container">
                            <table class="grey-text text-darken-3 striped">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>Subject</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($subjects as $subject)
                                    <tr>
                                        <td></td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $subject->name }}</td>
                                        <td class="right">
                                            <button class="btn red lighten-2 btn_add_or_delete_curriculum"
                                                    data-component="subject"
                                                    data-action="delete"
                                                    data-id="{{ $level->id }}"
                                                    data-name="{{ $level->name }}"
                                                    data-color="red"
                                            >
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <button class="btn orange lighten-1 btn-edit-curriculum"
                                                    data-component="subject"
                                                    data-id="{{ $subject->id }}"
                                                    data-name="{{ $subject->name }}"
                                                    data-color="orange"
                                            >
                                                <i class="material-icons">edit</i>
                                            </button>
                                        </td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="container">
                            <table>
                                <thead>
                                <tr class="border-bottom-none">
                                    <th></th>
                                    <th></th>
                                    <th>
                                        <button class="btn green lighten-1 right btn_add_or_delete_curriculum"
                                                data-component="subject"
                                                data-action="add"
                                                data-color="green">
                                            <i class="material-icons">add</i>
                                        </button>
                                    </th>
                                    <th></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                {{--MODULE LISTING--}}
                <div class="row" id='module_listing'>
                   <div class="col s12">
                        <div class="container">
                            <table class="grey-text text-darken-3 striped">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>Module</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($modules as $module)
                                    <tr>
                                        <td></td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $module->name }}</td>
                                        <td class="right">
                                            <button class="btn red lighten-2 btn-delete-curriculum"
                                                    data-component="module"
                                                    data-id="{{ $module->id }}"
                                                    data-name="{{ $module->name }}"
                                                    data-color="red"
                                            >
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <button class="btn orange lighten-1 btn-edit-curriculum"
                                                    data-component="module"
                                                    data-id="{{ $module->id }}"
                                                    data-name="{{ $module->name }}"
                                                    data-color="orange"
                                            >
                                                <i class="material-icons">edit</i>
                                            </button>
                                        </td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="container">
                            <table>
                                <thead>
                                <tr class="border-bottom-none">
                                    <th></th>
                                    <th>

                                        <a href="#admin_add_module_modal" class="btn green lighten-1 right btn-add-module modal-trigger"
                                                data-component="module">
                                            <i class="material-icons left">add</i>
                                            Module
                                        </a>
                                        <a href="#admin_add_topic_modal" class="btn blue right btn-add-topic modal-trigger" style="margin-right:10px;"
                                           data-component="topic">
                                            <i class="material-icons left">add</i>
                                            Topic
                                        </a>
                                    </th>
                                    <th></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>


                {{--LESSON : WHERE YOU FILTER BY TOPICS --}}
                <div class="row" id='topic_listing'>
                    <div class="col s12">
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
                            {{--FILTERED TOPICS ARE LOADED HERE--}}
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </main>

    {{--MODAL FOR ADDING MODULES --}}
    <div id="admin_add_module_modal" class="modal modal-small">
        <div class="row">
            <div class="modal-content">
                <p id="admin_add_module_question" class="light"></p>
                <br>
                <form method="POST" id="admin_add_module_form">
                    @csrf
                    <input id="admin_add_module_name" name="newModule" placeholder="Name of Module">
                    <label>Select A Subject</label>
                    <select class="browser-default" id="admin_add_module_subjectId" name="subjectId">
                        @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                    <br>
                    <button class="btn green lighten-1" id="btn_admin_add_module">Submit</button>
                </form>
            </div>
        </div>
    </div>

    {{--MODAL FOR ADDING TOPICS --}}
    <div id="admin_add_topic_modal" class="modal modal-small">
        <div class="row">
            <div class="modal-content">
                <p id="admin_add_topic_question" class="light"></p>
                <br>
                <form method="POST" id="admin_add_topic_form">
                    @csrf
                    <input id="admin_add_topic_name" name="newTopic" placeholder="Name of New Topic">
                    <label>Select A Level</label>
                    <select class="browser-default" id="admin_add_topic_levelId" name="levelId">
                        @foreach($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                        @endforeach
                    </select>
                    <br>
                    <label>Select A Module</label>
                    <select class="browser-default" id="admin_add_topic_moduleId" name="moduleId">
                        @foreach($modules as $module)
                            <option value="{{ $module->id }}">{{ $module->name }}</option>
                        @endforeach
                    </select>
                    <br>
                    <button class="btn green lighten-1" id="btn_admin_add_topic">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection








