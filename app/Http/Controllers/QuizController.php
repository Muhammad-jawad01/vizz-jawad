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

    public function startQuiz()
    {
        $quizzes = Quiz::all();
        return view('quiz', compact('quizzes'));
    }

    public function Qstart($id)
    {
        $quiz = Quiz::find($id);
        $quizquestion = $quiz->quizquestion;

        return view('startquiz', compact('quiz', 'quizquestion'));
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
        $quizquestion = $quiz->quizquestion;


        return view('quiz.show', compact('quiz', 'quizquestion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);
        $questions = Question::all(); // Retrieve all questions

        return view('quiz.edit', compact('quiz', 'questions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'marks' => 'required|integer',
            'duration' => 'required|integer',

            'selectedRows.*' => 'required',
        ]);
        $quiz = Quiz::findOrFail($id);
        $data = $request->all();
        $quiz_id = $quiz->id;

        $quiz->update($data);
        // dd($data);

        $quizquestion = QuizQuestion::where(['quiz_id' => $quiz_id])->count();
        if ($quizquestion > 0) {
            QuizQuestion::query()->where(['quiz_id' => $quiz_id])->delete();
        }
        foreach ($validatedData['selectedRows'] as $index => $value) {
            // dd($value);

            // $model = QuizQuestion::where(['quiz_id' => $quiz_id, 'question_id' => $value])->first();
            // if ($model) {

            //     $model->question_id = $value;
            //     $model->quiz_id = $quiz_id;
            //     $model->save();
            // } else {
            //     $model = new QuizQuestion();
            //     $model->question_id = $value;
            //     $model->quiz_id = $quiz_id;
            //     $model->save();
            // }

            // in this above code is wrok perfectly but one issue is there if we un select the question so thats up remove frm the data base for that im using the other method in which i delete the data first



            $model = new QuizQuestion();
            $model->question_id = $value;
            $model->quiz_id = $quiz_id;
            $model->save();


            // dd($model);
        }

        return redirect()->route('quiz.index');
    }



    public function destroy($id)
    {


        // dd('ho');
        $quiz = Quiz::findOrFail($id);

        $quiz->quizquestion()->delete(); // Delete associated options
        $quiz->delete(); // Delete the question
        return redirect()->route('quiz.index');
    }
}
