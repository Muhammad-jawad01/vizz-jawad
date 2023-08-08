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
                @else
                    <li>nothing</li>
                @endif

            </ul>

        </div>

        <div class="col-md-10">
            <div class="container">
                <h1>Edit Question</h1>

                <form action="{{ route('question.update', $question->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Question Title</label>
                        <input type="text" name="title" id="title" class="form-control"
                            value="{{ $question->title }}">
                    </div>
                    <div class="form-group">
                        <label for="options">Options</label>


                        @foreach ($question->options as $index => $option)
                            <input type="text" name="options[]" class="form-control" value="{{ $option->option }}">
                            @if ($option->is_correct)
                                <span class="badge badge-success">Correct</span>
                            @else
                                <span class="badge badge-danger">Incorrect</span>
                            @endif
                        @endforeach
                        <!-- Add more input fields for additional options -->
                    </div>
                    <div class="form-group">
                        <label for="correct_option">Correct Option Index</label>
                        <input type="number" name="correct_option" class="form-control" min="0" value="">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Question</button>
                </form>
            </div>
        </div>
    </div>
@endsection
