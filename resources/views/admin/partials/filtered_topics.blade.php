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
    @foreach($topics as $topic)
        <ul class="collapsible" data-collapsible="accordion">
            <li>
                <div class="collapsible-header border-bottom-none">
                    <span class='col s2 m1'>{{$topic->id}}</span>
                    <span class="card-title activator grey-text text-darken-4 col s9">{{ $topic->name }}</span>
                    @if($topic->updated_at)
                    <span class='col s2 m2'>{{ $topic->updated_at->format('m-d-Y') }}</span>
                    @else
                    <span class='col s2 m2'>{{ date_create('now')->format('m-d-Y') }}</span>
                    @endif
                    <i class="material-icons right grey-text">more_vert</i>
                </div>
                <div class="collapsible-body custom-padding border-bottom-none">
                    <button class="btn red lighten-2 btn-delete-curriculum"
                            data-component="topic"
                            data-id="{{ $topic->id }}"
                            data-name="{{ $topic->name }}"
                            data-color="red"
                    >
                        <i class="material-icons">delete</i>
                    </button>
                    <button class="btn orange lighten-1 btn-edit-curriculum"
                            data-component="topic"
                            data-id="{{ $topic->id }}"
                            data-name="{{ $topic->name }}"
                            data-color="orange"
                    >
                        <i class="material-icons">edit</i>
                    </button>
                        <a href="admin_lesson/{{ $topic->id }}" target='_blank' class='btn green'><i class="material-icons left white-text">open_in_new</i>LESSON</a>
                </div>
            </li>

        </ul>
    @endforeach
</div>