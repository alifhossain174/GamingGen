<?php

namespace App\Http\Controllers;
use App\Game;
use Image;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function gamePage(){
        $games = Game::orderBy('id','desc')->paginate(15);
        return view('backend.game',compact('games'));
    }

    public function addNewGame(Request $request){
        $logo = null;

        if ($request->hasFile('logo')){
            $get_image = $request->file('logo');
            $image_name = str::random(5) . time() . '.' . $get_image->getClientOriginalExtension();
            Image::make($get_image)->save('game_images/' . $image_name, 50);
            $logo = "game_images/" . $image_name;
        }

        Game::insert([
            'logo' => $logo,
            'game_name' => $request->game_name,
            'package_name' => $request->package_name,
            'created_at' => Carbon::now()
        ]);

        Toastr::success('Games has been Added', 'Success');
        return back();
    }

    public function deleteGame($id){
        $data = Game::where('id',$id)->first();
        if($data->logo != null){
            if(file_exists(public_path($data->logo))){
                unlink($data->logo);
            }
        }
        Game::where('id',$id)->delete();
        Toastr::error('Game has been Deleted', 'Deleted');
        return back();
    }
}
