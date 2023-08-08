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
                            </div>
                        @endforeach
                    </div>

                    <!-- Add more input fields for additional options -->
                </div>

            </div>
        </div>
    </div>
@endsection
