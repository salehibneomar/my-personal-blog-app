<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perMonthPostCounts = Post::select(
                        DB::raw(' MONTH(created_at) AS month, 
                        COUNT(*) AS post_per_month ')
                                )
                                ->whereYear('created_at', date('Y'))
                                ->groupBy(DB::raw(' MONTH(created_at) '))
                                ->orderBy('month', 'ASC')
                                ->get();

        $line_chart_data = array(
                '1' => 0,
                '2' => 0,
                '3' => 0,
                '4' => 0,
                '5' => 0,
                '6' => 0,
                '7' => 0,
                '8' => 0,
                '9' => 0,
                '10' => 0,
                '11' => 0,
                '12' => 0,
        );
        
        foreach($perMonthPostCounts as $value){
            $line_chart_data[$value->month] = $value->post_per_month;
        }

        $line_chart_data = json_encode(array_values($line_chart_data));


        $postRatio = Post::select(DB::raw('type, COUNT(*) AS post_type_count'))
                          ->groupBy(DB::raw('type'))
                          ->orderBy('type', 'ASC')
                          ->get();
        
        $doughnut_chart_data = array('1' => 0, '2' => 0, '3' => 0);

        foreach($postRatio as $value){
            $doughnut_chart_data[$value->type] = $value->post_type_count;
        }

        $doughnut_chart_data = json_encode(array_values($doughnut_chart_data));
        
        return view('backend.dashboard', 
               compact('line_chart_data', 
                       'doughnut_chart_data'));
    }

}
