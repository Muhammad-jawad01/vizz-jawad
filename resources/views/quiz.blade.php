@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>show Quizz</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($quizzes as $quiz)
                    <tr>
                        <td>{{ $quiz->title }}</td>
                        <td>
                            <a href="{{ route('quiz.start.new', $quiz->id) }}" class="btn btn-sm btn-primary">start</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
