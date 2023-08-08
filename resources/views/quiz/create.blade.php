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
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h1>Create New Question</h1>

                <form action="{{ route('quiz.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Quizz Title</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="marks">marks</label>
                        <input type="text" name="marks" id="marks" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="duration">duration</label>
                        <input type="text" name="duration" id="duration" class="form-control">
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
                                    <td><input type="checkbox" name="selectedRows[]" value="{{ $question->id }}"></td>
                                    <td>{{ $question->id }}</td>
                                    <td>{!! $question->title !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                    <div class="form-group">
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Create Quizz</button>
                </form>
            </div>
        </div>
    </div>


@endsection
