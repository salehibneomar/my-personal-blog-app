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
        $posts = DB::table('posts')->whereNull('deleted_at')->get();
        if($request->ajax()){
            $data = DataTables::of($posts)
                                ->editColumn('id', '#{{ $id }}')
                                ->editColumn('title', function($row){
                                    $title = is_null($row->title) ? '<span class="badge badge-pill badge-orange">N/A</span>' : $row->title;
                                    return $title;
                                })
                                ->editColumn('image', function($row){
                                    $image = is_null($row->image) ? '<span class="badge badge-pill badge-orange">N/A</span>' : '<img src="'.asset($row->image).'" width="70" height="60" >';
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
                                    $view = '<a href="'.route('author.post.show', ['id'=>$row->id]).'" class="btn btn-sm  btn-icon  btn-primary btn-rounded"><i class="anticon anticon-eye"></i></a>';

                                    $edit = '<a href="'.route('author.post.edit', ['id'=>$row->id]).'" class="btn btn-sm  btn-icon  btn-success btn-rounded"><i class="anticon anticon-form"></i></a>';

                                    $delete = '<a href="'.route('author.post.delete', ['id'=>$row->id]).'" class="btn btn-sm btn-icon   btn-danger btn-rounded delete-button"><i class="anticon anticon-delete"></i></a>';

                                    $data = $row->type==1 ? $edit.' '.$delete : $view.' '.$edit.' '.$delete;
                                    return $data;
                                })
                                ->rawColumns(['image', 'title', 'type', 'action'])
                                ->make(true);
            return $data;                    
        }
        return view('backend.pages.post.all');
    }

    public function deletedMessages(Request $request)
    {
        $posts = DB::table('posts')->whereNotNull('deleted_at')->get();
        if($request->ajax()){
            $data = DataTables::of($posts)
                                ->editColumn('id', '#{{ $id }}')
                                ->editColumn('title', function($row){
                                    $title = is_null($row->title) ? '<span class="badge badge-pill badge-orange">N/A</span>' : $row->title;
                                    return $title;
                                })
                                ->editColumn('image', function($row){
                                    $image = is_null($row->image) ? '<span class="badge badge-pill badge-orange">N/A</span>' : '<img src="'.asset($row->image).'" width="70" height="60" >';
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
                                    $view = '<a href="'.route('author.post.show', ['id'=>$row->id]).'" class="btn btn-sm  btn-icon  btn-primary btn-rounded"><i class="anticon anticon-eye"></i></a>';

                                    $undo = '<a href="'.route('author.post.restore', ['id'=>$row->id]).'" class="btn btn-sm btn-icon   btn-success btn-rounded restore-button"><i class="anticon anticon-undo"></i></a>';
 
                                    return $view.' '.$undo;
                                })
                                ->rawColumns(['image', 'title', 'type', 'action'])
                                ->make(true);
            return $data;                    
        }
        return view('backend.pages.post.deleted');
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
            $this->blog($request, 'store');
        }
        else{
            abort(404);
        }

        return redirect()->route('author.post.all')
                         ->with($this->successful(Str::ucfirst($type).' posted!'));
    }

    private function status($request, $operation, $id=null, $entity=null)
    {
        $request->validate([
            'title' => 'required|min:2|max:250'
        ]);

        $post = new Post();
        if($operation=='update'){
            $post = $entity;
        }

        $post->title = $request->title;
        if($operation=='store'){
            $post->type    = 1;
            $post->user_id = Auth::user()->id;
        }
        $post->save();
    }

    private function picture($request, $operation, $id=null, $entity=null)
    {
        $required = $operation=='update' ? 'nullable' : 'required';
        $request->validate([
            'image' => $required.'|file|mimes:png,jpg,jpeg|min:1|max:5150',
            'title' => 'nullable|max:100',
        ],
        [
            'image.max' => 'Image size should not be more than 5MB',
        ]);

        $post = new Post();
        if($operation=='update'){
            $post = $entity;
            if($request->hasFile('image') && file_exists($post->image)){
                unlink($post->image);
            }
        }

        if($operation=='store'){
            $post->type    = 2;
            $post->user_id = Auth::user()->id;
        }

        if($request->hasFile('image')){
            $location  = 'images/post/picture/';
            $imageFile = $request->file('image');
            $imageName = hexdec(uniqid()).'_'.date('dmyHis').'.'.$imageFile->getClientOriginalExtension();

            Image::make($imageFile)->resize(622,622)->save($location.$imageName);

            $post->image = $location.$imageName;
        }
        $post->title = $request->title;
        $post->save();

    }

    private function blog($request, $operation, $id=null, $entity=null){
        $request->validate([
            'image' => 'nullable|file|min:1|max:5150',
            'title' => 'required|min:3|max:250',
            'details' => 'required|min:10',
        ],
        [
            'image.max' => 'Image size should not be more than 5MB',
            'details.min' => 'Details should have at least 3 characters!',
        ]);

        $post = new Post();
        if($operation=='update'){
            $post = $entity;
            if($request->hasFile('image') && !is_null($post->image)){
                if(file_exists($post->image)){
                    unlink($post->image);
                }
            }
        }

        if($operation=='store'){
            $post->type      = 3;
            $post->uniq_code = Str::upper(Str::uuid());
            $post->user_id   = Auth::user()->id;
        }

        if($request->hasFile('image')){
            $location  = 'images/post/blog/';
            $imageFile = $request->file('image');
            $imageName = hexdec(uniqid()).'_'.date('dmyHis').'.'.$imageFile->getClientOriginalExtension();
    
            Image::make($imageFile)->resize(622,342)->save($location.$imageName);
    
            $post->image = $location.$imageName;
        }

        $post->title   = $request->title;
        $post->details = $request->details;
        $post->slug    = Str::slug($request->title);
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
        $post = Post::withTrashed()
                    ->where('type', '!=', 1)
                    ->findOrFail($id);

        return view('backend.pages.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::withoutTrashed()->findOrFail($id);
        $type = ['status', 'picture', 'blog'];
        $type = $type[($post->type)-1];
        return view('backend.pages.post.edit', compact('post', 'type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $type, $id)
    {
        $post = Post::withoutTrashed()->findOrFail($id);

        if($type=='status'){
            $this->status($request, 'update', $id, $post);
        }
        elseif($type=='picture'){
            $this->picture($request, 'update', $id, $post);
        }
        else if($type=='blog'){
            $this->blog($request, 'update', $id, $post);
        }
        else{
            abort(404);
        }

        return redirect()->route('author.post.all')
                         ->with($this->successful(Str::ucfirst($type).' updated!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withoutTrashed()->findOrFail($id);
        $post->delete();

        return redirect()->route('author.post.deleted')->with($this->successful('Post deleted!'));
    }

    public function undoDelete($id){
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->route('author.post.all')->with($this->successful('Post restored!'));
    }
}
