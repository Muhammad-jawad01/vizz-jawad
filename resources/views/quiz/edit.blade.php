@extends('layouts.app')

@section('content')
    <div class="row m-0">
        <div class="col-md-2">
            <h3>Side Bar</h3>
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
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h1>Edit Quiz</h1>

                <form action="{{ route('quiz.update', $quiz->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Use the PUT method for updates -->

                    <div class="form-group">
                        <label for="title">Quiz Title</label>
                        <input type="text" name="title" id="title" class="form-control"
                            value="{{ $quiz->title }}">
                    </div>

                    <div class="form-group">
                        <label for="marks">Marks</label>
                        <input type="text" name="marks" id="marks" class="form-control"
                            value="{{ $quiz->marks }}">
                    </div>

                    <div class="form-group">
                        <label for="duration">Duration</label>
                        <input type="text" name="duration" id="duration" class="form-control"
                            value="{{ $quiz->duration }}">
                    </div>

                    <table id="quiz" class="table table-hover" style="width: 100%; overflow: hidden;">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>ID</th>
                                <th>Question</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $question)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="selectedRows[]" value="{{ $question->id }}"
                                            @if ($quiz->quizquestion->pluck('question_id')->contains($question->id)) checked @endif>
                                    <td>{{ $question->id }}</td>
                                    <td>{!! $question->title !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="form-group">
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Update Quiz</button>
                </form>
            </div>
        </div>
    </div>
@endsection
