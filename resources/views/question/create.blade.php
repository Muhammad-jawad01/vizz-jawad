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

                <form action="{{ route('question.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Question Title</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>


                    <div class="form-group mt-3">
                        <div class="col-md-12">
                            <table class="table question_options ">
                                <thead>
                                    <tr>
                                        <th width="250">Options</th>
                                    </tr>
                                </thead>
                                <tbody id="question_options">


                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" name="options[]">
                                        </td>

                                        <td>
                                            <button class="btn btn-danger btn-sm remove_row1" type="button">x</button>
                                        </td>

                                    </tr>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>
                                            <button class="btn btn-success btn-sm" id="addRow2" type="button"><i
                                                    data-feather="plus"></i> Add
                                                Row</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="correct_option">Correct Option Index</label>
                        <input type="number" name="correct_option" class="form-control" min="0">
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Create Question</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        $('#addRow2').click(function() {
            let str = `
        <tr>

            <td>
                <input type="text" class="form-control" name="options[]">
            </td>

                <td>
                    <button class="btn btn-danger btn-sm remove_row3"type="button">x</button>
            </td>
            </tr>`;
            $('#question_options').append(str);
            $(".remove_row1").click(function() {
                $(this).closest('tr').remove();
            });
        });
    </script>
@endsection
