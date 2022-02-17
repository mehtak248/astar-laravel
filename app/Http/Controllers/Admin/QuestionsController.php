<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Questions;
use App\Http\Requests\QuestionRequest;
use DataTables;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $projects = Questions::all();
            return DataTables::of($projects)
                    ->addIndexColumn()
                    ->editColumn('question',function($row) {
                        return $row->question;
                    })
                    ->addColumn('action',function($row) {
                        $show = ''; $edit = ''; $delete = '';

                        //$show = "<a href='".route('questions.show',[$row->id])."' title='View'><i class='fa fa-eye text-secondary' aria-hidden='true'></i></a>&nbsp;&nbsp;&nbsp;";

                        $edit = "<a href='".route('admin.questions.edit',[$row->id])."' title='Edit'><i class='fas fa-edit'></i></a>&nbsp;&nbsp;&nbsp;";

                        $delete = "<a href='javascript:void(0);' title='Delete' onclick='deleteQuestion(".$row->id.")'><i class='fas fa-trash-alt text-danger'></i></a>";

                       return $show.$edit.$delete;
                    })
                    ->rawColumns(['start_date','end_date','action'])
                    ->make(true);
        } else {
            return view('admin.question.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.question.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        $postData = $request->all();

        //creat the object of question.
        $question  = new Questions();

        $question->question = $postData['question'];
        $question->type     = 'Multiple Choice';
        $question->options  = (!empty($postData['option_details']) ? serialize($postData['option_details']) : '');

        if(!empty($postData['option_details'])) {
            $count = 0;
            foreach ($postData['option_details'] as $key => $val) {
                if(isset($val['is_correct']) && $val['is_correct'] == 1) {
                    $question->score          = $val['score'];
                    $question->is_true_option_num = $count;
                }
                
                $count++;
            }
        }

        //trigger object on save
        if( $question->save() ) {
            return redirect()->route('admin.questions.index')->with(['type'=>'success','icon' => 'success', 'message' => 'Question added successfully.']);
        } else {
            return redirect()->route('admin.questions.index')->with(['type'=>'error', 'icon' => 'error', 'message' => 'Error in adding question.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get the object of question
        $question = Questions::findOrfail($id);

        if(!empty($question)) {
            $optionsData = (!empty($question->options) ? unserialize($question->options) : '');
        }

        return view('admin.question.edit', [
            'question' => $question,
            'optionsData'  => $optionsData
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, $id)
    {
        $postData = $request->all();

        $question = Questions::findOrfail($id);

        $question->question = $postData['question'];
        $question->type     = 'Multiple Choice';
        $question->options  = (!empty($postData['option_details']) ? serialize($postData['option_details']) : '');

        if(!empty($postData['option_details'])) {
            $count = 0;
            foreach ($postData['option_details'] as $key => $val) {
                if(isset($val['is_correct']) && $val['is_correct'] == 1) {
                    $question->score          = $val['score'];
                    $question->is_true_option_num = $count;
                }
                
                $count++;
            }
        }

        //trigger object on save
        if( $question->save() ) {
            return redirect()->route('admin.questions.index')->with(['type'=>'success','icon' => 'success', 'message' => 'Question updated successfully.']);
        } else {
            return redirect()->route('admin.questions.index')->with(['type'=>'error', 'icon' => 'error', 'message' => 'Error in updating question.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*Find the question object*/
        $question = Questions::findOrfail($id);

        //Delete the Question
        $question->delete();

        return [
            'success' => true,
            'type' => 'success', 
            'title' => 'Delete', 
            'message'=>'Question Deleted Successfully.'
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteQuestion($id)
    {
        /*Find the question object*/
        $question = Questions::findOrfail($id);

        //Delete the Question
        $question->delete();

        return [
            'success' => true,
            'type' => 'success', 
            'title' => 'Delete', 
            'message'=>'Question Deleted Successfully.'
        ];
    }
}
