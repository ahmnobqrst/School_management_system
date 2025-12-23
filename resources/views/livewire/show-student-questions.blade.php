<div>
    <div>
        <label>{{ $data[$counter]->title }}</label><br>

        @foreach(explode("-", $data[$counter]->answer) as $index => $answer)
        <input
            type="radio"
            id="customradio{{$index}}"
            name="customradio"
            value="{{$answer}}"
            wire:click="nextQuestion(
                {{ $data[$counter]->id }},
                {{ $data[$counter]->degree }},
                '{{ $answer }}',
                '{{ $data[$counter]->right_answer }}'
            )" />
        <label for="customradio{{$index}}">
            {{ $answer }}
        </label>
        <br>
        @endforeach
    </div>

</div>

