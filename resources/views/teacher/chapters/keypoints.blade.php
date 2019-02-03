<form id="edit-keypoints-form" method="POST">
    {{--<input type="hidden" name="title">--}}
    @csrf
    @method('patch')
    <input type="hidden" data-id="{{$chapter->id}}">
    <header>
        <h5 class="orange-text bold"><i class="material-icons small left">vpn_key</i>&nbsp;Key Points</h5>
    </header>
    <br>
    <textarea name="edit_keypoints" class="wysiywg" id="" cols="30" rows="10">{{ $chapter->key_point }}</textarea>
    <br>
    <button class="btn orange edit-chapter-modal-btn" data-id="{{$chapter->id}}">Save Changes</button>
</form>