<form>
    <input type="text" name="title">
    <input type="text" id="{{$chapter->id}}">
    <header>Discussion</header>
    <textarea name="dicussion" id="" cols="30" rows="10">{{ $chapter->discussion }}</textarea>
</form>