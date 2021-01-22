<?php

namespace App\Http\Controllers;
use App\Game;
use App\User;
use App\Package;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\PackageRequest;
use Image;
use Illuminate\Support\Str;

class PackageController extends Controller
{
    public function packagePage(){
        $games = Game::all();

        $packages = DB::table('packages')
                        ->join('games','games.id','=','packages.game_id')
                        ->select('packages.*','games.game_name')
                        ->orderBy('id','desc')
                        ->paginate(15);

        return view('backend.package',compact('games','packages'));
    }

    public function addNewPackage(Request $request){
        $image = null;

        if ($request->hasFile('image')){
            $get_image = $request->file('image');
            $image_name = str::random(5) . time() . '.' . $get_image->getClientOriginalExtension();
            Image::make($get_image)->save('package_images/' . $image_name, 50);
            $image = "package_images/" . $image_name;
        }

        Package::insert([
            'image' => $image,
            'title' => $request->title,
            'amount' => $request->amount,
            'amount' => $request->amount,
            'diamond' => $request->diamond,
            'game_id' => $request->game_id,
            'created_at' => Carbon::now()
        ]);
        Toastr::success('Package has been Added', 'Success');
        return back();
    }

    public function deletePackage($id){
        $data = Package::where('id',$id)->first();
        if($data->image != null){
            if(file_exists(public_path($data->image))){
                unlink($data->image);
            }
        }
        Package::where('id',$id)->delete();
        Toastr::error('Package has been deleted', 'Deleted');
        return back();
    }

    public function managePakcage(){
        $package_requests = DB::table('package_requests')
                                ->join('packages','packages.id','=','package_requests.pakage_id')
                                ->join('games','games.id','=','packages.game_id')
                                ->join('users','users.id','=','package_requests.user_id')
                                ->select('package_requests.*','packages.title as package_title','users.name as user_name','users.email','games.game_name')
                                ->orderBy('id','desc')
                                ->paginate(15);

        return view('backend.package_requests',compact('package_requests'));
    }

    public function deletePackageRequest($id){
        PackageRequest::where('id',$id)->delete();
        Toastr::error('Package Request has been deleted', 'Deleted');
        return back();
    }

    public function denyPackageRequest($id){

        $package_request_info = PackageRequest::where('id',$id)->first();

        PackageRequest::where('id',$id)->update([
            'status' => 2,
            'updated_at' => Carbon::now()
        ]);

        User::where('id',$package_request_info->user_id)->increment('amount',$package_request_info->amount);

        Toastr::warning('Package Request has been Denied', 'Denied');
        return back();
    }
}
