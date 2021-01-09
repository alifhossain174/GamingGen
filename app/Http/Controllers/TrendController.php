<?php

namespace App\Http\Controllers;
use App\Trend;
use Image;
use App\Game;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TrendController extends Controller
{
    public function trendPage(){
        // $trends = Trend::paginate(15);
        $trends = DB::table('trends')
                    ->join('games','games.id','=','trends.game_id')
                    ->select('trends.*','games.game_name')
                    ->orderBy('id','desc')
                    ->paginate(15);

        $games = Game::all();
        return view('backend.trend',compact('trends','games'));
    }

    public function addNewTrend(Request $request){
        $image = null;

        if ($request->hasFile('image')){
            $get_image = $request->file('image');
            $image_name = str::random(5) . time() . '.' . $get_image->getClientOriginalExtension();
            Image::make($get_image)->save('trend_images/' . $image_name, 50);
            $image = "trend_images/" . $image_name;
        }

        Trend::insert([
            'image' => $image,
            'game_id' => $request->game_id,
            'title' => $request->title,
            'description' => $request->description,
            'created_at' => Carbon::now()
        ]);

        Toastr::success('Trend has been Added', 'Success');
        return back();
    }

    public function deleteTrend($id){
        $data = Trend::where('id',$id)->first();
        if($data->image != null){
            if(file_exists(public_path($data->image))){
                unlink($data->image);
            }
        }
        Trend::where('id',$id)->delete();
        Toastr::error('Trend has been Deleted', 'Deleted');
        return back();
    }
}
