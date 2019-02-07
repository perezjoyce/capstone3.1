<div class="col s12">
    <ul class="collapsible" data-collapsible="accordion">
        <li>
            <div class="collapsible-header border-bottom-none">
                <span class='col s2 m1 bold'>ID</span>
                <span class="card-title activator grey-text text-darken-4 bold col s9">Title</span>
                <span class='col s2 m bold'>Last Update</span>
                <i class="material-icons right white-text">more_vert</i>
            </div>
        </li>
    </ul>
</div>

<div class="col s12" style='min-height:10em;'>
    {{--TEACHER CAN VIEW TOPICS WITH LESSON/CHAPTER ONLY --}}
    @foreach($topics as $topic)
    @if($topic->chapters->count() == 1)
    <ul class="collapsible" data-collapsible="accordion">
        <li>
            <div class="collapsible-header border-bottom-none">
                    <span class='col s2 m1'>{{$topic->id}}</span>
                    <span class="card-title activator grey-text text-darken-4 col s9">{{ $topic->name }} </span>
                @if($topic->updated_at)
                    <span class='col s2 m2'>{{ $topic->updated_at->format('m-d-Y') }}</span>
                @else
                    <span class='col s2 m2'>{{ date_create('now')->format('m-d-Y') }}</span>
                @endif
                    <i class="material-icons right grey-text">more_vert</i>
            </div>
            <div class="collapsible-body custom-padding border-bottom-none">
                {{--IF THE CHAPTER DOESN'T HAVE QUESTIONS YET, THE TEACHER CANNOT ADD IT AS TASK--}}
                @if($topic->questions->count() == 0)
                    <button class='btn grey add-activity-modal disabled'><i class="material-icons left white-text">add</i>Add As Task</button>
                @else
                    <button class='btn orange lighten-3 add-activity-modal' data-id="{{ $topic->id }}"><i class="material-icons left white-text">add</i>Add As Task</button>
                @endif
            <a href="teacher_lesson/{{ $topic->id }}" target='_blank' class='btn orange'><i class="material-icons left white-text">open_in_new</i>View</a>
        </div>
        </li>
    </ul>
    @endif
    @endforeach
</div>
