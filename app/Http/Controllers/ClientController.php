<?php

namespace yuridik\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use yuridik\City;
use yuridik\Client;
use yuridik\File;
use Session;
use Illuminate\Support\Facades\File as LaraFile;
class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:client');
    }

     public function index()
    {
        return view('client.dashboard');
    }
    
    public function info(){
    	$client = Auth::user();
    	$city = City::all();
    	$cities= array();
    	foreach ($city as $key) {
    		$cities[$key->id]= $key->name;
    	}

    	return view('client.info')->withClient($client)->withCities($cities);
    }
    public function update(Request $request, $id){
    	
        $this->validate($request, ['image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
       
            
        $client = Client::findOrFail($id);
        $client->gender = $request->gender;
    	$client->user->dateOfBirth= $request->dateOfBirth;
        $client->user->city_id = $request->city;
        if($request->file('image') != null) {
            $file = $request->file('image');
            $file_name = $file->getClientOriginalName();
            $upload_folder = '/clients/photo'.$client->id.'/';
            if($client->user->file_id != null){
            LaraFile::delete(public_path().$upload_folder.$client->user->file->file);
                $client->user->file->file = $file_name;
                $client->user->file->path = $upload_folder;
            }
            else{
                $fil = new File;
                $fil->file = $file_name;
                $fil->path = $upload_folder;
                $fil->save();
                $client->user->file_id = $fil->id;
            }
            $file->move(public_path() . $upload_folder, $file_name);
        }            
        $client->push();
    	Session::flash('message', 'Your account updated successfully');
    	
    	return redirect()->route('client.dashboard');

    }

}
