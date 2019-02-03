<!DOCTYPE html>
@extends('layouts.app')
@section('main')
    <style>

        .tabs .tab a {
            color: gray!important;
        }

        .tabs .tab a:hover {
            color: white!important;
            background:darkgray!important;
        }

        .tabs .indicator {
            background-color: gray;
        }

        .tabs .tab a.active{
            background-color: gray!important;
            color: white!important;
        }


        .btn {
            background-color: gainsboro;
            color:white;
        }



    </style>
    <main>
        @include('sidenav')
        <div class="row no-margin-bottom">
            <div class="col s12">

                <div class="col s12 hide-on-med-and-down">
                    <h4 class='deep-purple-text text-darken-4 right custom-heading'>Chapter</h4>
                </div>

                <div class="row hide-on-large-only deep-purple darken-4">
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

                                        var toastHTML = '<span>{!! Session::get('successmessage') !!}</span>';
                                        M.toast({html: toastHTML, classes: 'rounded'});

                                    </script>
                                </ul>
                            </div>
                        @elseif(Session::has("deletemessage"))
                            <div class="alert alert-danger mb-5 rounded-0">
                                <ul class='list-unstyled'>
                                    <script>

                                        var toastHTML = '<span>{!! Session::get('deletemessage') !!}</span>';
                                        M.toast({html: toastHTML, classes: 'rounded'});
                                    </script>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>


                <div class="row hide-on-large-only deep-purple darken-4">
                    <div class="col s6">
                        <h4 class='white-text custom-heading'>Chapter</h4>
                    </div>
                    <div class="col s6 right">
                        <ul class="right hide-on-large-only">
                            <a href="#" data-target="slide-out" class="sidenav-trigger orange-text"><i class="material-icons white-text"><h5>menu</h5></i></a>
                        </ul>
                    </div>
                </div>

                <div class="col s12">
                    <div class="row">
                        <div class="col l1 m2 s3"><span class='bold'>Level:</span></div>
                        <div class="col l11 m10 s9">{{ $topic->level->name }}</div>
                    </div>
                    <div class="row">
                        <div class="col l1 m2 s3"><span class='bold'>Subject:</span></div>
                        <div class="col l11 m10 s9">{{ $topic->module->subject->name }}</div>
                    </div>
                    <div class="row">
                        <div class="col l1 m2 s3"><span class='bold'>Module:</span></div>
                        <div class="col l11 m10 s9">{{ $topic->module->name }}</div>
                    </div>
                    <div class="row">
                        <div class="col l1 m2 s3"><span class='bold'>Topic:</span></div>
                        <div class="col l11 m10 s9">{{ $topic->name }}</div>
                    </div>
                </div>

                <div class="col s12" style="margin-top:2em;">
                    <ul class="tabs">
                        <li class="tab">
                            <a href="#chapter-objective" class="card btn">
                                <h6 class="">1</h6>
                            </a>
                        </li>
                        <li class="tab">
                            <a href="#chapter-discussion" class="card btn">
                                <h6>2</h6>
                            </a>
                        </li>
                        <li class="tab">
                            <a href="#chapter-example" class="card btn">
                                <h6>3</h6>
                            </a>
                        </li>
                        <li class="tab">
                            <a href="#chapter-practice" class="card btn">
                                <h6>4</h6>
                            </a>
                        </li>
                        <li class="tab">
                            <a href="#chapter-tip" class="card btn">
                                <h6>5</h6>
                            </a>
                        </li>
                        <li class="tab">
                            <a href="#chapter-keypoints" class="card btn">
                                <h6>6</h6>
                            </a>
                        </li>
                        <li class="tab">
                            <a href="#chapter-questions" class="card btn">
                                <h6 class="hide-on-small-only">Questions</h6>
                                <h6 class="hide-on-med-and-up"><i class="material-icons small">help_outline</i></h6>
                            </a>
                        </li>

                    </ul>
                </div>

                <div class="col s12">
                    <div class="row">
                        <div class="col s12 card" id="chapter-objective">
                            <div class="row card-content fixed-height-20em">
                                <div class="col s12">
                                    <div class="row">
                                        <h5 class="orange-text bold"><i class="material-icons small left">track_changes</i>&nbsp;Objective</h5>
                                    </div>
                                    <div class="row">
                                        <p>{!! html_entity_decode($chapter->objective, ENT_QUOTES, 'UTF-8') !!}</p>
                                    </div>
                                </div>
                            </div>
                            {{--edit--}}
                            <div class="col s12 card-action">
                                <div class="row no-margin-bottom">
                                    <p class="grey-text col s6 m8">Last Update: {{$chapter->updated_at->format('m-d-Y') }}</p>
                                    <a class="btn right orange edit-chapter-modal margin-top-18px-mobile" data-column="objective" data-id="{{ $chapter->id }}">Edit</a>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 card" id="chapter-discussion">
                            <div class="row card-content fixed-height-20em">
                                <div class="col s12">
                                    <div class="row">
                                        <h5 class="orange-text bold"><i class="material-icons small left">local_library</i>&nbsp;Discussion</h5>
                                    </div>
                                    <div class="row">
                                        <p>{!! html_entity_decode($chapter->discussion, ENT_QUOTES, 'UTF-8') !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 card-action">
                                <div class="row no-margin-bottom">
                                    <p class="grey-text col s6 m8">Last Update: {{$chapter->updated_at->format('m-d-Y') }}</p>
                                    <a class="btn right orange edit-chapter-modal margin-top-18px-mobile" data-column="discussion" data-id="{{ $chapter->id }}">Edit</a>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 card" id="chapter-example">
                            <div class="row card-content fixed-height-20em">
                                <div class="col s12">
                                    <div class="row">
                                        <h5 class="orange-text bold"><i class="material-icons small left">lightbulb_outline</i>&nbsp;Example</h5>
                                    </div>
                                    <div class="row">
                                        <p>{!! html_entity_decode($chapter->example, ENT_QUOTES, 'UTF-8') !!}</p>
                                    </div>
                                </div>
                            </div>
                            {{--edit--}}
                            <div class="col s12 card-action">
                                <div class="row no-margin-bottom">
                                    <p class="grey-text col s6 m8">Last Update: {{$chapter->updated_at->format('m-d-Y') }}</p>
                                    <a class="btn right orange edit-chapter-modal margin-top-18px-mobile" data-column="example" data-id="{{ $chapter->id }}">Edit</a>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 card" id="chapter-practice">
                            <div class="row card-content fixed-height-20em">
                                <div class="col s12">
                                    <div class="row">
                                        <h5 class="orange-text bold"><i class="material-icons small left">supervisor_account</i>&nbsp;Practice</h5>
                                    </div>
                                    <div class="row">
                                        <p>{!! html_entity_decode($chapter->guided_practice, ENT_QUOTES, 'UTF-8') !!}</p>
                                    </div>
                                </div>
                            </div>
                            {{--edit--}}
                            <div class="col s12 card-action">
                                <div class="row no-margin-bottom">
                                    <p class="grey-text col s6 m8">Last Update: {{$chapter->updated_at->format('m-d-Y') }}</p>
                                    <a class="btn right orange edit-chapter-modal margin-top-18px-mobile" data-column="practice" data-id="{{ $chapter->id }}">Edit</a>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 card" id="chapter-tip">
                            <div class="row card-content fixed-height-20em">
                                <div class="col s12">
                                    <div class="row">
                                        <h5 class="orange-text bold"><i class="material-icons small left">bookmark</i>&nbsp;Tips</h5>
                                    </div>
                                    <div class="row">
                                        <p>{!! html_entity_decode($chapter->tip, ENT_QUOTES, 'UTF-8') !!}</p>
                                    </div>
                                </div>
                            </div>
                            {{--edit--}}
                            <div class="col s12 card-action">
                                <div class="row no-margin-bottom">
                                    <p class="grey-text col s6 m8">Last Update: {{$chapter->updated_at->format('m-d-Y') }}</p>
                                    <a class="btn right orange edit-chapter-modal margin-top-18px-mobile" data-column="tips" data-id="{{ $chapter->id }}">Edit</a>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 card" id="chapter-keypoints">
                            <div class="row card-content fixed-height-20em">
                                <div class="col s12">
                                    <div class="row">
                                        <h5 class="orange-text bold"><i class="material-icons small left">vpn_key</i>&nbsp;Key Points</h5>
                                    </div>
                                    <div class="row">
                                        <p>{!! html_entity_decode($chapter->key_point, ENT_QUOTES, 'UTF-8') !!}</p>
                                    </div>
                                </div>
                            </div>
                            {{--edit--}}
                            <div class="col s12 card-action">
                                <div class="row no-margin-bottom">
                                    <p class="grey-text col s6 m8">Last Update: {{$chapter->updated_at->format('m-d-Y') }}</p>
                                    <a class="btn right orange edit-chapter-modal margin-top-18px-mobile" data-column="keypoints" data-id="{{ $chapter->id }}">Edit</a>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 card" id="chapter-questions">
                            <div class="row card-content fixed-height-20em">
                                <div class="col s12">
                                    <div class="row">
                                        <h5 class="orange-text bold"><i class="material-icons small left">help</i>&nbsp;Questions</h5>
                                    </div>
                                    <div class="row">
                                        <p>Test</p>
                                    </div>
                                </div>
                            </div>
                            {{--edit--}}
                            <div class="col s12 card-action">
                                <div class="row no-margin-bottom">
                                    <p class="grey-text col s6 m8">Last Update: {{ $chapter->updated_at->format('m-d-Y') }}</p>
                                    <a class="btn right orange edit-chapter-modal margin-top-18px-mobile" data-column="questions" data-id="{{ $chapter->id }}">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




            </div>

        </div>
    </main>

    {{--MODAL TEMPLATE--}}
    <div id="modal-edit-chapter" class="modal">

        <div class='right row'>
            <a href="#!" class="modal-close waves-effect waves-light-blue btn-flat">&#9587</a>
        </div>


        <div class="modal-content">
            <h4>Modal Header</h4>
            <form method="POST" action="">
                @csrf

                <div class="row">
                    <div class="col s12">
                        <h4>{{ __('Edit Discussion Modal') }}</h4>
                    </div>
                </div>


                <div class="row">
                    <div class="input-field col s12">
                        <button type='submit' class="waves-effect waves-light btn light-blue">
                            <i class="material-icons right"></i>
                            {{ __('Save Changes') }}
                        </button>

                    </div>
                </div>

            </form>
        </div>

    </div>
@endsection




{{--// golf_course-- for objective}}

{{--track_changes for objectives--}}

{{--// ightbulb_outline-- for example}}

{{--local_library-- for learn about it}}

{{--note_add-- for add to assignmment}}

{{--report -- for report errors--}}

{{--toys --- for whatevs--}}

{{--vpn_key -- for key points--}}