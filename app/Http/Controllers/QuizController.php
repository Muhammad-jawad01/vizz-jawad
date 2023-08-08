<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = Quiz::all();
        return view('quiz.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $questions = Question::all();

        return view('quiz.create', compact('questions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validatedData = $request->validate([
            'title' => 'required|string',
            'marks' => 'required|integer',
            'duration' => 'required|integer',

            'selectedRows.*' => 'required',
        ]);
        $data = $request->all();
        // dd($validatedData);
        $quiz = new Quiz();
        $quiz->fill($data);
        $quiz->save();
        $quiz_id = $quiz->id;


        foreach ($validatedData['selectedRows'] as $index => $value) {
            // dd('test');
            $model = new QuizQuestion();
            $model->question_id = $value;
            $model->quiz_id = $quiz_id;
            $model->save();
            // dd($model);
        }
        return redirect()->route('quiz.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('quiz.show', compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('quiz.edit', compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validation and updating logic
        $quiz = Quiz::findOrFail($id);
        $quiz->update($request->all());
        return redirect()->route('quiz.index');
    }

    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();
        return redirect()->route('quiz.index');
    }
}
