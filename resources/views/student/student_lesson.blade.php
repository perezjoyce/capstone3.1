<!DOCTYPE html>
@extends('layouts.app')
@section('main')

    <main>
        @include('sidenav_student')
        <div class="row no-margin-bottom">
            <div class="col s12">

                <div class="col s12 hide-on-med-and-down">
                    <h4 class='deep-purple-text text-darken-4 right custom-heading'>Lesson</h4>
                </div>

                <div class="row hide-on-large-only deep-purple darken-4">
                    <div class="col s6">
                        <h4 class='white-text custom-heading'>Lesson</h4>
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
                    {{--<div class="row">--}}
                        {{--<div class="col l1 m2 s3"><span class='bold'>Purpose:</span></div>--}}
                        {{--<div class="col l11 m10 s9">{{ $activity->purpose->name }}</div>--}}
                    {{--</div>--}}
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
                            @if($questions->count() > 0)
                                <a href="#chapter-questions" class="card btn">
                                    <h6 class="hide-on-small-only">Questions</h6>
                                    <h6 class="hide-on-med-and-up"><i class="material-icons small">help_outline</i></h6>
                                </a>
                            @else
                                <a href="#chapter-questions" class="card btn active">
                                    <h6 class="hide-on-small-only">Questions</h6>
                                    <h6 class="hide-on-med-and-up"><i class="material-icons small">help_outline</i></h6>
                                </a>
                            @endif
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

                            <div class="col s12 card-action">
                                <div class="row no-margin-bottom">
                                    @if($chapter->updated_at)
                                        <p class="grey-text col s5 m6">Last Update: {{$chapter->updated_at->format('m-d-Y') }}</p>
                                    @else
                                        <p class="grey-text col s5 m6">Last Update: {{ date_create('now')->format('m-d-Y') }}</p>
                                    @endif
                                    <a href="#" class="btn-flat grey-text text-lighten-1 report-modal-btn right margin-top" data-column="objectives" data-id="{{ $chapter->id }}">
                                        <i class="material-icons left">report_problem</i>
                                        <span class="hide-on-small-only">Report</span> Error
                                    </a>
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
                                    @if($chapter->updated_at)
                                        <p class="grey-text col s5 m6">Last Update: {{$chapter->updated_at->format('m-d-Y') }}</p>
                                    @else
                                        <p class="grey-text col s5 m6">Last Update: {{ date_create('now')->format('m-d-Y') }}</p>
                                    @endif
                                    <a href="#" class="btn-flat grey-text text-lighten-1 report-modal-btn right margin-top" data-column="discussion" data-id="{{ $chapter->id }}">
                                        <i class="material-icons left">report_problem</i>
                                        <span class="hide-on-small-only">Report</span> Error
                                    </a>
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

                            <div class="col s12 card-action">
                                <div class="row no-margin-bottom">
                                    @if($chapter->updated_at)
                                        <p class="grey-text col s5 m6">Last Update: {{$chapter->updated_at->format('m-d-Y') }}</p>
                                    @else
                                        <p class="grey-text col s5 m6">Last Update: {{ date_create('now')->format('m-d-Y') }}</p>
                                    @endif
                                    <a href="#" class="btn-flat grey-text text-lighten-1 report-modal-btn right margin-top" data-column="example" data-id="{{ $chapter->id }}">
                                        <i class="material-icons left">report_problem</i>
                                        <span class="hide-on-small-only">Report</span> Error
                                    </a>
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

                            <div class="col s12 card-action">
                                <div class="row no-margin-bottom">
                                    @if($chapter->updated_at)
                                        <p class="grey-text col s5 m6">Last Update: {{$chapter->updated_at->format('m-d-Y') }}</p>
                                    @else
                                        <p class="grey-text col s5 m6">Last Update: {{ date_create('now')->format('m-d-Y') }}</p>
                                    @endif
                                    <a href="#" class="btn-flat grey-text text-lighten-1 report-modal-btn right margin-top" data-column="practice" data-id="{{ $chapter->id }}">
                                        <i class="material-icons left">report_problem</i>
                                        <span class="hide-on-small-only">Report</span> Error
                                    </a>
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

                            <div class="col s12 card-action">
                                <div class="row no-margin-bottom">
                                    @if($chapter->updated_at)
                                        <p class="grey-text col s5 m6">Last Update: {{$chapter->updated_at->format('m-d-Y') }}</p>
                                    @else
                                        <p class="grey-text col s5 m6">Last Update: {{ date_create('now')->format('m-d-Y') }}</p>
                                    @endif
                                    <a href="#" class="btn-flat grey-text text-lighten-1 report-modal-btn right margin-top" data-column="tips" data-id="{{ $chapter->id }}">
                                        <i class="material-icons left">report_problem</i>
                                        <span class="hide-on-small-only">Report</span> Error
                                    </a>
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

                            <div class="col s12 card-action">
                                <div class="row no-margin-bottom">
                                    @if($chapter->updated_at)
                                        <p class="grey-text col s5 m6">Last Update: {{$chapter->updated_at->format('m-d-Y') }}</p>
                                    @else
                                        <p class="grey-text col s5 m6">Last Update: {{ date_create('now')->format('m-d-Y') }}</p>
                                    @endif
                                    <a href="#" class="btn-flat grey-text text-lighten-1 report-modal-btn right margin-top" data-column="keypoints" data-id="{{ $chapter->id }}">
                                        <i class="material-icons left">report_problem</i>
                                        <span class="hide-on-small-only">Report</span> Error
                                    </a>
                                </div>
                            </div>
                        </div>




                        {{--action="/check-answers/{{$activity->id}}"--}}
                        <form method="POST" action="" id="answered-activity-form">
                            @csrf
                            <input type="hidden" name="numberOfItems" value="{{$numberOfItems}}">
                            <div class="col s12" id="chapter-questions">
                                <div class="row">
                                    @if($questions->count() > 0)
                                        @for($i=0; $i<$questions->count();$i++)
                                            <div class="col s12 card">

                                                <div class="row card-content no-margin-bottom">
                                                    <div class="col s12">
                                                        <div class="row no-margin-bottom">
                                                            <div class="col m6 s12">
                                                                <br>
                                                                {{--QUESTIONS--}}
                                                                <input type="hidden" value="{{ $questions[$i]->id }}">
                                                                <div class="row">
                                                                    <button class="btn-small orange col l1 m2 s2">Q{{$i+1}}</button>
                                                                    <div class="col l11 m10 s10" style="padding-left:10px;"> {!! html_entity_decode($questions[$i]->question, ENT_QUOTES, 'UTF-8') !!} </div>
                                                                </div>
                                                                <br class="hide-on-med-and-down">
                                                                {{--HINTS--}}
                                                                <div class="row">
                                                                    <br>
                                                                    <ul class="collapsible">
                                                                        <li>
                                                                            <div class="collapsible-header border-bottom-none" style="padding:0!important;"><h6 class="orange-text"><i class="material-icons smaller">live_help</i>&nbsp;Hint</h6></div>
                                                                            <div class="collapsible-body border-bottom-none"><span>{!! html_entity_decode($questions[$i]->hint, ENT_QUOTES, 'UTF-8') !!}</span></div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <div class="col m4 s12 offset-m2 right padding-0;">

                                                                {{--CHOICES--}}
                                                                <div class="row no-margin-bottom">

                                                                    <ul class="collection padding-0">

                                                                        @foreach($questions[$i]->choices->shuffle() as $choice)

                                                                            <li class="collection-item">
                                                                                <p class="grey-text">
                                                                                    <label>
                                                                                        <input type="radio"
                                                                                               class="filled-in"
                                                                                               value="{{ $choice->id }}"
                                                                                               name="answer{{$i}}" />
                                                                                        <span>
                                                                                            {{ $choice->choice }}
                                                                                        </span>
                                                                                    </label>
                                                                                </p>
                                                                            </li>
                                                                            <input type="radio"
                                                                                   class="filled-in"
                                                                                   value="DONT_KNOW_{{$questions[$i]->id}}"
                                                                                   name="answer{{$i}}"
                                                                                   style="display: none;"
                                                                                   checked
                                                                            />
                                                                        @endforeach
                                                                    </ul>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col s12 card-action">
                                                    <div class="row no-margin-bottom">
                                                        @if($questions[$i]->updated_at)
                                                            <p class="grey-text col s5 m6">Last Update: {!! html_entity_decode($questions[$i]->updated_at->format('m-d-Y'), ENT_QUOTES, 'UTF-8') !!}</p>
                                                        @else
                                                            <p class="grey-text col s5 m6">Last Update: {{ date_create('now')->format('m-d-Y') }}</p>
                                                        @endif

                                                            <a href="#" class="btn-flat grey-text text-lighten-1 report-modal-btn right margin-top" data-column="questions" data-id="{{ $questions[$i]->id }}">
                                                                <i class="material-icons left">report_problem</i>
                                                                <span class="hide-on-small-only">Report</span> Error
                                                            </a>

                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                        @else
                                        <div class="col s12 card">
                                            <div class="row card-content no-margin-bottom fixed-height-20em">
                                                <div class="col s12">

                                                    <div class="row no-margin-bottom margin-top-7em-large-med">
                                                        <div class="col s12">
                                                            <p class="center-align">Sorry. This doesn't have <span class="bold">approved</span> questions at the moment.</p>
                                                            <br class="show-on-small-only hide-on-med-and-up">
                                                            <p class="center-align">Please inform your teacher about this.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col s12 card-action">
                                                <div class="row no-margin-bottom">
                                                    <p class="grey-text col s12">Last Update: {{ date_create('now')->format('m-d-Y') }}</p>
                                                </div>

                                            </div>

                                        </div>

                                    @endif
                                </div>
                                @if($questions->count() > 0)
                                <div class="row">
                                    <div class="col s12">
                                        <input name="activityId" id="activityId" type="hidden" value="{{ $activity->id}}">
                                        <button id="check-answers-btn" class="btn-large orange margin-top-18px-mobile margin-left-10px-large-medium" type="submit" >
                                            <i class="material-icons right">send</i>
                                            SUBMIT
                                        </button>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </form>


                    </div>
                </div>

            </div>
        </div>
    </main>

    {{--MODAL TEMPLATE FOR REPORTING ERRORS--}}
    <div id="modal-report-error" class="modal">

        <div class='right row'>
            <a href="#!" class="modal-close waves-effect waves-light-blue btn-flat">&#9587</a>
        </div>

        <div class="modal-content">
            <form method="POST" action="/report-error/{{$chapter->id}}" id="report-error-form">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col s12">
                        <h5 class="red-text bold"><i class="material-icons left red-text">report_problem</i>Report Error</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col m2 s12"><span class='bold'>Level:</span></div>
                    <div class="col m10 s12">{{$topic->level->name}}</div>
                </div>
                <div class="row">
                    <div class="col m2 s12"><span class='bold'>Subject:</span></div>
                    <div class="col m10 s12">{{ $topic->module->subject->name }} </div>
                </div>
                <div class="row">
                    <div class="col m2 s12"><span class='bold'>Module:</span></div>
                    <div class="col m10 s12">{{ $topic->module->name }} </div>
                </div>
                <div class="row">
                    <div class="col m2 s12"><span class='bold'>Topic:</span></div>
                    <div class="col m10 s12">{{ $topic->name }}</div>
                </div>

                <div class="row no-margin-bottom">
                    <div class="col s12">
                        <p class="grey-text">Please briefly indicate the error below.</p>
                    </div>
                </div>

                <div class="row no-margin-bottom">
                    <input type="hidden" name="chapter" value="{{ $chapter->id }}">
                    <input type="hidden" id="column_with_error" name="column">
                    <div class="input-field col s12">
                        <textarea  id="error_details" class="materialize-textarea validate" name="details" data-length="250" required></textarea>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        $('textarea#error_details').characterCounter();
                    });
                </script>

                <div class="row no-margin-bottom">
                    <div class="input-field col s12">
                        <button type='submit' class="waves-effect waves-light btn grey">
                            <i class="material-icons right">send</i>
                            {{ __('SUBMIT') }}
                        </button>

                    </div>
                </div>

            </form>
        </div>
    </div>




    <!--MODAL TEMPLATE SHOWING ACTIVITY RESULTS-->
    <div id="modal-show-activity-result" class="modal modal-small">

        <div class='right row'>
            <a href="#!" class="modal-close waves-effect waves-light-blue btn-flat">&#9587</a>
        </div>


        <div class="modal-content">
            <h4>Results</h4>
            <div class="row">
                <div class="col s12">
                    <h6 id='add-activity-modal-question'></h6>
                </div>
            </div>


            <div class="row">
                <div class="input-field col s12">
                    <button type='submit' class="waves-effect waves-light btn orange">
                        <i class="material-icons right"></i>
                        {{ __('Retake') }}
                    </button>

                </div>
            </div>
        </div>
    </div>



@endsection

