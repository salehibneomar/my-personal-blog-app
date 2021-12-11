<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Traits\AlertTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Stevebauman\Location\Facades\Location;

class MessageController extends Controller
{

    use AlertTrait;

    public function index(Request $request)
    {
        $messages = DB::table('messages')->whereNull('deleted_at')->get();
        if($request->ajax()){
            $data = DataTables::of($messages)
                      ->editColumn('created_at', 
                      '{{ date("d-m-Y", strtotime($created_at)) }}')
                      ->editColumn('seen_status', function($row){
                          $status = ($row->seen_status==1) ? '<span class="badge badge-pill badge-green">SEEN</span>' : '<span class="badge badge-pill badge-red">UNREAD</span>';
                          return $status;
                      })
                      ->addColumn('action', function($row){
                          $view = '<a href="'.route('author.message.details', ['id'=>$row->id]).'" class="btn btn-sm  btn-icon  btn-primary btn-rounded"><i class="anticon anticon-eye"></i></a>';
                          $delete = '<a href="'.route('author.message.delete', ['id'=>$row->id]).'" class="btn btn-sm btn-icon   btn-danger btn-rounded delete-button"><i class="anticon anticon-delete"></i></a>';
                          return $view.' '.$delete;
                      })
                      ->rawColumns(['seen_status', 'action'])
                      ->make(true);
            return $data;
        }
        return view('backend.pages.message.all');
    }

    public function deletedMessages(Request $request)
    {
        $messages = DB::table('messages')->whereNotNull('deleted_at')->get();
        if($request->ajax()){
            $data = DataTables::of($messages)
                      ->editColumn('created_at', 
                      '{{ date("d-m-Y", strtotime($created_at)) }}')
                      ->editColumn('seen_status', function($row){
                          $status = ($row->seen_status==1) ? '<span class="badge badge-pill badge-green">SEEN</span>' : '<span class="badge badge-pill badge-red">UNREAD</span>';
                          return $status;
                      })
                      ->addColumn('action', function($row){
                          $view = '<a href="'.route('author.message.details', ['id'=>$row->id]).'" class="btn btn-sm  btn-icon  btn-primary btn-rounded"><i class="anticon anticon-eye"></i></a>';
                          $undo= '<a href="'.route('author.message.restore', ['id'=>$row->id]).'" class="btn btn-sm btn-icon   btn-success btn-rounded restore-button"><i class="anticon anticon-undo"></i></a>';
                          return $view.' '.$undo;
                      })
                      ->rawColumns(['seen_status', 'action'])
                      ->make(true);
            return $data;
        }
        return view('backend.pages.message.deleted');
    }

    public function destroy($id)
    {
        $message = Message::withoutTrashed()->findOrFail($id);
        $message->delete();

        return redirect()->route('author.message.deleted')->with($this->successful('Message deleted!'));
    }

    public function undoDelete($id)
    {
        $message = Message::onlyTrashed()->findOrFail($id);
        $message->restore();

        return redirect()->route('author.message.all')->with($this->successful('Message restored!'));
    }

    public function details($id)
    {
        $message = Message::withTrashed()->findOrFail($id);
        if($message->seen_status==0){
            $message->seen_status = 1;
            $message->save();
        }

        $deviceInfo = json_decode($message->sender_information);
        $locationInfo = Location::get($message->sender_ip);
        if($locationInfo && !empty($locationInfo)){
            $locationInfo = [
                'Country' => $locationInfo->countryName,
                'City'    => $locationInfo->cityName,
                'Region'  => $locationInfo->regionName,
                'ZipCode' => $locationInfo->zipCode,
            ];
        }
        else{
            $locationInfo = false;
        }

        return view('backend.pages.message.details', compact('message', 'deviceInfo', 'locationInfo'));
    }
    
}
