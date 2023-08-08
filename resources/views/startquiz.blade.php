@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>show Quizz</h1>

        <div class="form-group">
            <label for="title">Quizz Title</label>
            <p>{{ $quiz->title }}</p>
        </div>
        <div class="form-group">
            <label for="options">Question</label>
            <div class="row">

                @foreach ($quizquestion as $question)
                    <div class="col-auto">{{ $question->question->title }}</div>

                    <div class="row">
                        @foreach ($question->question->options as $option)
                            <div class="col-auto">{{ $option->option }}</div>
                        @endforeach
                        <input type="number" name="ans" class="form-control">
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary mt-4"> Submit</button>

            </div>

            <!-- Add more input fields for additional options -->
        </div>

    </div>
@endsection
