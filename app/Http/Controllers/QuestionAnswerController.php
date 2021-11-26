<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use Exception;
use Illuminate\Http\Request;

class QuestionAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('question.index', [
            'questions' => Question::with('answers')->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('question.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "category_id" => "required",
            "question" => "required",
            "option" => "required|array",
            "isCorrectAnswer" => "required"
        ]);
        try {
            $question =  Question::create([
                'category_id' => $request->category_id,
                'question' => $request->question
            ]);

            foreach ($request->option as $k => $v) {
                Answer::create([
                    'question_id' => $question->id,
                    'answer' => $v,
                    'is_correct' => $request->isCorrectAnswer == $k + 1 ? true : false
                ]);
            }
            return response()->json(['status' => true, 'message' => 'question create successfully']);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $answer = $question->answers;
        $categories = Category::all();
        return view('question.edit', compact('question', 'answer', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {

        $request->validate([
            "category_id" => "required",
            "question" => "required",
            "option" => "required|array",
            "isCorrectAnswer" => "required"
        ]);

        try {
            $question->update([
                'category_id' => $request->category_id,
                'question' => $request->question
            ]);

            foreach ($question->answers as $k => $v) {
                $option = $request->option[$k];
                $v->update([
                    'question_id' => $question->id,
                    'answer' => $option,
                    'is_correct' => $request->isCorrectAnswer == $k + 1 ? true : false
                ]);
            }
            return response()->json(['status' => true, 'message' => 'question updated successfully']);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->answers()->delete();
        $question->delete();
        return redirect(route('question.index'))->with('success', 'question deleted successfully');
    }
}
