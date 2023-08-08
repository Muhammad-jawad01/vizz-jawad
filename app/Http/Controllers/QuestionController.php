<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\QuestionOption;



class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::all();
        return view('question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('question.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string',
            'options.*' => 'required|string',
            'correct_option' => 'required|integer',
        ]);

        $optionsCount = count($validatedData['options']);
        // $maxCorrectOption = $optionsCount - 1;
        //|| $validatedData['correct_option'] > $maxCorrectOption
        // Perform additional validation for correct_option
        if ($validatedData['correct_option'] < 0) {
            return redirect()->back()->withErrors(['correct_option' => 'Invalid correct option selection.']);
        }

        // Create a new question
        $question = Question::create([
            'title' => $validatedData['title'],
        ]);

        // Create options for the question
        foreach ($validatedData['options'] as $index => $optionText) {
            // dd($index . " " . $validatedData['correct_option'] - 1);
            $isCorrect = ($index === $validatedData['correct_option'] - 1);
            QuestionOption::create([
                'question_id' => $question->id,
                'option' => $optionText,
                'is_correct' => $isCorrect,
            ]);
        }

        return redirect()->route('question.index')->with('success', 'Question created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $question = Question::with('options')->findOrFail($id);
        // dd('test');
        return view('question.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $question = Question::with('options')->findOrFail($id);


        return view('question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        // dd($request->all());
        $validatedData = $request->validate([
            'title' => 'required|string',
            'options.*' => 'required|string',
            'correct_option' => 'required|integer',
        ]);

        // dd($validatedData);
        if ($validatedData['correct_option'] < 0) {
            return redirect()->back()->withErrors(['correct_option' => 'Invalid correct option selection.']);
        }

        // Update the question
        $question = Question::findOrFail($id);

        $question->update([
            'title' => $validatedData['title'],
        ]);

        // Update options for the question
        foreach ($validatedData['options'] as $index => $optionText) {
            $isCorrect = ($index === $validatedData['correct_option'] - 1);

            // Check if option with this index already exists, if not create
            if ($question->options->count() > $index) {
                $question->options[$index]->update([
                    'option' => $optionText,
                    'is_correct' => $isCorrect,
                ]);
            } else {
                QuestionOption::create([
                    'question_id' => $question->id,
                    'option' => $optionText,
                    'is_correct' => $isCorrect,
                ]);
            }
        }

        return redirect()->route('question.index')->with('success', 'Question updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        // Delete the question along with its options
        $question->options()->delete(); // Delete associated options
        $question->delete(); // Delete the question

        return redirect()->route('question.index')->with('success', 'Question and options deleted successfully.');
    }
}
