<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Traits\AlertTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PostController extends Controller
{

    use AlertTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $posts = DB::table('posts')->whereNull('deleted_at')->get();
            $data = DataTables::of($posts)
                                ->editColumn('id', '#{{ $id }}')
                                ->editColumn('title', function($row){
                                    $title = is_null($row->title) ? '<span class="badge badge-pill badge-orange">N/A</span>' : $row->title;
                                    return $title;
                                })
                                ->editColumn('image', function($row){
                                    $image = is_null($row->image) ? '<span class="badge badge-pill badge-orange">N/A</span>' : '<img src="'.asset($row->image).'" width="60" height="60" >';
                                    return $image;
                                })
                                ->editColumn('type', function($row){
                                    $type = null;
                                    switch($row->type){
                                        case 2:
                                            $type = 'Picture';
                                        break;
                                        case 3:
                                            $type = 'Blog';
                                        break;
                                        default:
                                            $type = 'Status';  
                                    }
                                    return '<span class="badge badge-pill badge-geekblue">'.$type.'</span>';
                                })
                                ->editColumn('created_at',
                                '{{ date("d M Y", strtotime($created_at)) }}')
                                ->addColumn('action', function($row){
                                    $view = '<a href="" class="btn btn-sm  btn-icon  btn-primary btn-rounded"><i class="anticon anticon-eye"></i></a>';

                                    $edit = '<a href="" class="btn btn-sm  btn-icon  btn-success btn-rounded"><i class="anticon anticon-form"></i></a>';

                                    $delete = '<a href="" class="btn btn-sm btn-icon   btn-danger btn-rounded delete-button"><i class="anticon anticon-delete"></i></a>';

                                    $data = $row->type==1 ? $edit.' '.$delete : $view.' '.$edit.' '.$delete;
                                    return $data;
                                })
                                ->rawColumns(['image', 'title', 'type', 'action'])
                                ->make(true);
            return $data;                    
        }
        return view('backend.pages.post.all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
        if($type=='status'){
            return view('backend.pages.post.add-status');
        }
        elseif($type=='picture'){
            return view('backend.pages.post.add-picture');
        }
        else if($type=='blog'){
            return view('backend.pages.post.add-blog');
        }
        else{
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $type)
    {
        if($type=='status'){
            $this->status($request, 'store');
        }
        elseif($type=='picture'){
            $this->picture($request, 'store');
        }
        else if($type=='blog'){
            
        }
        else{
            abort(404);
        }

        return redirect()->route('author.post.all')
                         ->with($this->successful(Str::ucfirst($type).' posted!'));
    }

    private function status($request, $operation, $id=null){
        $request->validate([
            'title' => 'required|min:2|max:250'
        ]);

        $post = new Post();
        if($operation=='update'){
            $post = Post::withTrashed($id);
        }

        $post->title = $request->title;
        if($operation=='store'){
            $post->type    = 1;
            $post->user_id = Auth::user()->id;
        }
        $post->save();
    }

    private function picture($request, $operation, $id=null){
        $request->validate([
            'image' => 'required|file|mimes:png,jpg,jpeg|min:1|max:5150',
            'title' => 'nullable|max:100',
        ],
        [
            'image.max' => 'Image size should not be more than 5MB',
        ]);

        $post = new Post();
        if($operation=='update'){
            $post = Post::withTrashed($id);
            if(file_exists($post->image)){
                unlink($post->image);
            }
        }

        if($operation=='store'){
            $post->type    = 2;
            $post->user_id = Auth::user()->id;
        }

        $location  = 'images/post/picture/';
        $imageFile = $request->file('image');
        $imageName = hexdec(uniqid()).'_'.date('dmyHis').'.'.$imageFile->getClientOriginalExtension();

        Image::make($imageFile)->resize(622,622)->save($location.$imageName);

        $post->image = $location.$imageName;
        $post->title = $request->title;
        $post->save();

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
        //
    }
}
