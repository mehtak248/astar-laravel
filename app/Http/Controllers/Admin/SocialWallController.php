<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Socialwall;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;

class SocialWallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
        
            $social_walls = Socialwall::all();

            return DataTables::of($social_walls)
                    ->addIndexColumn()
                    ->editColumn('post_img',function($row) {
                        return  '<img src="'.asset('storage/images/social-wall/' .$row->image).'" height="100px" width="100px" >';
                    })
                    ->editColumn('description',function($row) {
                        return $row->description;
                    })
                    
                    ->addColumn('action',function($row) {
                        $show = ''; $edit = ''; $delete = '';
                        // $show = "<a href='".route('questions.show',[$row->id])."' title='View'><i class='fa fa-eye text-secondary' aria-hidden='true'></i></a>&nbsp;&nbsp;&nbsp;";
                        if ($row->is_approve == 0){
                            $show = '<a class="btn bg-gradient-success btn-xs" onclick="return confirm(\'Are you sure want to make it approve the post?\');" href="'.route('admin.poststatus',$row->id).'" title="Make it approve"><i style="color:white" class="fa fa-check"></i></a>';
                        } elseif($row->is_approve == 1){
                            $show = '<a class="btn bg-gradient-danger btn-xs" onclick="return confirm(\'Are you sure want to make it reject the post?\');" href="'.route('admin.poststatus', $row->id).'" title="Make it reject"><i style="color:white" class="fa fa-times"></i></a>';
                        }

                        $delete = "&nbsp;&nbsp;<a class='btn bg-gradient-danger' href='javascript:void(0);' title='Delete post' onclick='deletePost(".$row->id.")'><i style='color:white' class='fas fa-trash-alt'></i></a>";

                       return $show.$delete;
                    })
                    ->rawColumns(['post_img','description','action'])
                    ->make(true);
        } else {
            return view('admin.social-wall.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    public function postStatus($id)
    {
        $status = Socialwall::find($id);
        
        if ($status) {
            if ($status->is_approve == 0) {
                $status->is_approve = 1;
            } else {
                $status->is_approve = 0;
            }
            
            $status->save();
            
            return redirect()->back()->with([
                'type'   =>  'success',
                'icon'    => 'success', 
                'message' => 'Social post status change successfully.'
            ]);

        } else {
            return redirect()->back()->with('error', 'Sorry, post not exist.');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        $socialwall = Socialwall::findOrfail($id);

        //Delete the Question
        $socialwall->delete();

        return [
            'success' => true,
            'type' => 'success', 
            'title' => 'Delete', 
            'message'=>'Social post deleted successfully.'
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function PostDelete($id)
    {
        /*Find the question object*/
        $socialwall = Socialwall::findOrfail($id);

        //Delete the Question
        $socialwall->delete();

        return [
            'success' => true,
            'type' => 'success', 
            'title' => 'Delete', 
            'message'=>'Social post deleted successfully.'
        ];
    }
}
