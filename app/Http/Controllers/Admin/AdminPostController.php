<?php

namespace yuridik\Http\Controllers\Admin;
use Carbon\Carbon;
use yuridik\Answer;
use yuridik\Http\Controllers\Controller;
use yuridik\Admin;
use Illuminate\Http\Request;
use yuridik\Client;
use yuridik\Lawyer;
use yuridik\Question;

class AdminPostController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth:admin');

    }
    public function questions()
    {
        $questions = Question::where(
            'type', 1)->orWhere('type', 2)->orderBy('id', 'desc')->get();
        return view('question.admin-index')->withQuestions($questions);
    }
    public function questionDeny(Request $request, $id){
        $question = Question::findOrFail($id);
        $question->destroy();
    }
    public function answers(){
        $answers = Answer::all();
        return view('admin.answer.list')->withAnswers($answers);
    }
    public function answerDestroy($id){
        $answer = Answer::findOrFail($id);
        $answer->destroy();
    }
    public function comments(){
        return view('admin.comment.list');
    }
    public function commentDestroy(Request $request, $id){
        $comment = Comment::findOrFail($id);
        $comment->destroy();
    }
    public function users(){
        $clients =Client::all();
        return view('admin.users')->withClients($clients);
    }
    public function clientBlock(Request $request, $id){
        echo 'xaxa0';
      /*  $client = Client::findOrFail($id);
        $client->isBlocked = 1;
        $current = Carbon::now();
        $client->blockedTill = $current->addDays($request->days);
        $client->save();*/
    }
    public function lawyerBlock(Request $request, $id){
        $lawyer = Lawyer::findOrFail($id);
        $lawyer->isBlocked = 1;
        $current = Carbon::now();
        $lawyer->blockedTill = $current->addDays($request->days);
        $lawyer->save();
    }

}