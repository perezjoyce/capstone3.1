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
                    <form action="">
                        <button class='btn orange lighten-3'><i class="material-icons left white-text">delete</i>Delete</button>
                        <a href="admin_lesson/{{ $topic->id }}" target='_blank' class='btn orange'><i class="material-icons left white-text">edit</i>Update</a>
                    </form>
                </div>
            </li>

        </ul>
    @endforeach
</div>