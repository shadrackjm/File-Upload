<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function loadHomePage(){
        $users = User::all();
        return view('welcome',compact('users'));
    }

    public function FileUpload(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'image' => 'required|image|mimes:jpg,png',
        ]);

            try {
                if ($request->file('image')) {
                    $path = $request->file('image')->store('public/images');

                    $url =  Storage::url($path);

                    $newUser = new User();
                    $newUser->name = $request->name;
                    $newUser->email = $request->email;
                    $newUser->password = 'password';
                    $newUser->image = $path;
                    $newUser->save();

                    return redirect('/')->with('success',$url);
                }
                
            } catch (\Exception $e) {
                return redirect('/')->with('fail',$e->getMessage());
            }

    }

    public function deleteUser($id){
        try {
            $user = User::find($id);

            $path = $user->image;

            $user->delete();

            Storage::delete($path);
            return redirect('/')->with('success','User deleted successfully');

        } catch (\Exception $e) {
                return redirect('/')->with('fail',$e->getMessage());

        }
        

    }

    public function loadEditForm($id){
        $user = User::find($id);
        return view('edit-form',compact('user'));
        }

    public function EditUser(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $user = User::find($request->user_id);

        if($request->file('image')){
            $path = $user->image;
            Storage::delete($path);
            $path = $request->file('image')->store('public/images');

            $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $path,
            'password' => 'password',
        ]);

        return redirect('/')->with('success','user updated successfully');

        }
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => 'password',
        ]);

        return redirect('/')->with('success','user updated successfully');

    }
}
