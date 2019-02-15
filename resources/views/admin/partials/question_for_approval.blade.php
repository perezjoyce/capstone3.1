@if($questions)
    @foreach($questions as $question)
        <div class="col s12 card" style="box-shadow:none!important;">

            <div class="row card-content no-margin-bottom">
                <div class="col s12">

                    <div class="row no-margin-bottom">
                        <div class="col m6 s12">
                            <br>
                            <div class="row">
                                <h6 class="orange-text bold">Question</h6>
                                <div class="col s12" style="padding-left:10px;"> {!! html_entity_decode($question->question, ENT_QUOTES, 'UTF-8') !!} </div>
                            </div>
                            <br class="hide-on-med-and-down">
                            <div class="row no-margin-bottom">
                                <h6 class="orange-text col s12 padding-0"><i class="material-icons smaller">memory</i>&nbsp;Choices</h6>
                                <ul class="collection padding-0">
                                    @foreach($question -> choices as $choice)
                                        @if($choice->is_correct === 1)
                                            <li class="collection-item orange lighten-4">
                                                <i class="material-icons small left bold orange-text">check</i>
                                                <p class="grey-text text-darken-1">{!! html_entity_decode($choice->choice, ENT_QUOTES, 'UTF-8') !!}</p>
                                            </li>
                                        @else
                                            <li class="collection-item">
                                                <i class="material-icons small left grey-text">clear</i>
                                                <p class="grey-text">{!! html_entity_decode($choice->choice, ENT_QUOTES, 'UTF-8') !!}</p>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>


                        </div>
                        <div class="col m4 s12 offset-m2 right padding-0;">
                            <br>
                            <div class="row">
                                <h6 class="orange-text"><i class="material-icons smaller">live_help</i>&nbsp;Hint</h6>
                                <p class="grey-text">{!! html_entity_decode($question->hint, ENT_QUOTES, 'UTF-8') !!}</p>
                            </div>
                            <br class="hide-on-med-and-down">
                            <div class="row">
                                <h6 class="orange-text"><i class="material-icons smaller">info</i>&nbsp;Explanation</h6>
                                <p class="grey-text">{!! html_entity_decode($question->explanation, ENT_QUOTES, 'UTF-8') !!}</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12 card-action">
                <div class="row no-margin-bottom">
                    @if($question->updated_at)
                        <p class="grey-text col s12">Last Update: {!! html_entity_decode($question->updated_at->format('m-d-Y'), ENT_QUOTES, 'UTF-8') !!}</p>
                    @else
                        <p class="grey-text col s12">Last Update: {{ date_create('now')->format('m-d-Y') }}</p>
                    @endif
                    <div class="col s12 right-aligned">
                        {{--<a href="#" class="btn grey delete-modal-btn" data-column="questions" data-order="{{ $question->order }}" data-id="{{ $question->id }}">--}}
                            {{--<i class="material-icons">delete</i>--}}
                        {{--</a>--}}
                        @if($question->is_approved == 0)
                        <form action="approve_submitted_question/{{ $question->id }}" method="POST" id="approve_question_form_{{ $question->id }}">
                            @csrf
                            <button class="btn green btn-approve-question" data-id="{{ $question->id }}">
                                <i class="material-icons">check_circle</i>
                            </button>
                        </form>
                        @else
                            <form action="undo_approval/{{ $question->id }}" method="POST">
                                @csrf
                                <button class="btn red btn-approve-question" data-id="{{ $question->id }}">
                                    <i class="material-icons">undo</i>
                                    UNDO APPROVE
                                </button>
                            </form>
                        @endif
                        <a href="#" class="btn orange edit-question-modal" data-column="questions" data-order="{{ $question->order }}" data-questionid="{{ $question->id }}" data-id="{{ $question->chapter->id }}">
                            <i class="material-icons">edit</i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    @endforeach
@endif