<div class="row">
    <div class="col s12 center-align">
        <h5 class="bold grey-text darken-2">Recently Approved Questions</h5>
    </div>
</div>

<div class="row">
    <div class="col s12 center-align">
        <table class="striped responsive-table" style="font-size:.9rem">
            <thead>
            <tr>
                <th class="grey-text text-darken-2 center-align" style="width:5%;">#</th>
                <th class="grey-text text-darken-2">Overview</th>
                <th class="grey-text text-darken-2">Contributor</th>
                <th class="grey-text text-darken-2"></th>
                <th class="grey-text text-darken-2"></th>

            </tr>
            </thead>
            <tbody>
            @foreach($questions as $question)
                <tr>
                    <td class="grey-text center-align">{{ $loop->iteration }}</td>
                    <td>
                        <div>{{ $question->chapter->topic->level->name }} - {{ $question->chapter->topic->module->subject->name }}</div>
                        <div>{{ $question->chapter->topic->module->name }}</div>
                        <a href="admin_lesson/{{ $question->chapter->id }}" target="_blank">
                            {{ $question->chapter->topic->name }}
                        </a>
                    </td>
                    <td class="grey-text text-darken-2"> {{ $question->user->name }}</td>
                    <td>
                        <form action="" method="GET" class="open-question-form_{{ $question->id }}">
                            @csrf
                            <button class="btn orange btn-open-question-modal" data-id="{{ $question->id }}">VIEW</button>
                        </form>
                    </td>
                    <td>
                        <form action="undo_approval/{{ $question->id }}" method="POST">
                            @csrf
                            <button class="btn red btn-approve-question" data-id="{{ $question->id }}">
                                UNDO
                            </button>
                        </form>
                    </td>
                    <td></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>