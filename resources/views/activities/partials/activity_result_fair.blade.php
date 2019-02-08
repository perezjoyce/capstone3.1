<div style="background-image:url('{{ asset("images/confetti.gif") }}');background-size:cover;position:relative;background-position:center;" class="center-align">
    <div class='right row'>
        <a href="#!" class="modal-close waves-effect waves-light-blue btn-flat">&#9587</a>
    </div>

    <div class="modal-content">
        <div class="row">
            <div class="col s12">
                <br>
                <br>
                <div class="grey-text">You got <span class="bold">{{ $score }} out of {{ $numberOfItems }}</span> correct.</div>
                <div class="grey-text">Your average score is</div>

                <br>
                <br>
                <h1 class="deep-purple-text text-darken-3 bold">{{ $average }}%</h1>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">

                <button type='submit' class="waves-effect waves-light btn-large red lighten-1">
                    {{ __('VIEW ANSWERS') }}
                </button>

            </div>
        </div>
    </div>
</div>
