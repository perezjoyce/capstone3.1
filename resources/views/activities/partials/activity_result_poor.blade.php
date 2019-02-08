<div style="background-image:url('{{ asset("images/rain.gif") }}');background-size:cover;position:relative;background-position:top;" class="center-align">
    <div class='right row'>
        <a href="#!" class="modal-close waves-effect waves-light-blue btn-flat">&#9587</a>
    </div>
    <div class="modal-content">
        <div class="row">
            <div class="col s12">
                <br>
                <div class="white-text">You got <span class="bold">{{ $score }} out of {{ $numberOfItems }}</span> correct.</div>
                <div class="white-text">Your average score is</div>
                <br>
                <h1 class="white-text bold">{{ $average }}%</h1>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <button class="waves-effect waves-light btn-large red lighten-1 reload-btn">
                    {{ __('TRY AGAIN') }}
                </button>

            </div>
        </div>
    </div>
</div>
