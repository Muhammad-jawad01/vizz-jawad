@extends('layouts.app')
@section('content')
    <div class="row m-0">
        <div class="col-md-2">
            <h3>side bar </h3>
            <ul class="menu-content">
                @if (auth()->check() && auth()->user()->is_admin)
                    <li><a href="" style="text-decoration: none ;color:black">User</a>
                    </li>

                    <li><a href="{{ route('question.index') }}" style="text-decoration: none ;color:black">Question</a>
                    </li>
                    <li><a href="{{ route('quiz.index') }}" style="text-decoration: none ;color:black">Quizz</a>
                    </li>
                    <li><a href="{{ route('quiz.start') }}" style="text-decoration: none ;color:black"> Start Quizz</a>
                    </li>
                @else
                    <li>nothing</li>
                    <li><a href="{{ route('quiz.start') }}" style="text-decoration: none ;color:black"> Start Quizz</a>
                    </li>
                @endif

            </ul>

        </div>

        <div class="col-md-10">
            <div class="container">
                <h1>show Question</h1>

                <div class="form-group">
                    <label for="title">Question Title</label>
                    <p>{{ $question->title }}</p>
                </div>
                <div class="form-group">
                    <label for="options">Options</label>


                    @foreach ($question->options as $index => $option)
                        @if ($option->is_correct)
                            <p> <span class="badge badge-success">Correct</span>
                                {{ $option->option }}</p>
                        @else
                            <p> <span class="badge badge-danger">Incorrect</span>
                                {{ $option->option }}</p>
                        @endif
                    @endforeach
                    <!-- Add more input fields for additional options -->
                </div>

            </div>
        </div>
    </div>
@endsection
