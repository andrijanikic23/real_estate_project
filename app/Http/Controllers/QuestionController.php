<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewQuestionRequest;
use App\Models\QuestionModel;
use Illuminate\Http\Request;

class QuestionController extends Controller
{


    public function sent(NewQuestionRequest $request)
    {

        QuestionModel::create([
            ...$request->validated()
        ]);

        return redirect()->back()->with('success', 'Uspešno ste poslali poruku!');
    }
}
