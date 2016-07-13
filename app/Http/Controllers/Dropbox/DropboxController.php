<?php


namespace App\Http\Controllers\Dropbox;


use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use GrahamCampbell\Dropbox\Facades\Dropbox;
use League\Flysystem\Filesystem;
use App\Repositories\DropboxStorageRepository; // my dropbox connection class
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Model\DB\Files;





class DropboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DropboxStorageRepository $connection) //display all dropbox file
    {
        $image = Files::all();
        
        return view('dropbox.index',['image' => $image]);
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
    public function store(DropboxStorageRepository $connection,Request $request ) //save file to dropbox
    {

        $v = Validator::make($request->all(), [
            'image' => 'mimes:jpeg,bmp,png',
        ]);
        if ($v->fails()) {
            return redirect('dropbox')
                ->withInput()
                ->withErrors($v);
        } else {
            $file = \Request::file('image');

            $dropbox_file_name = time(). $file->getClientOriginalName();
            $cut_file_name = explode(".",$dropbox_file_name);



            $store_file = Files::create(['file_name' => $cut_file_name[0],'file_type' => $cut_file_name[1]]);

            if(!$store_file){
                return Redirect::to('dropbox')->with('user-info', 'Error please try again');
            }

            $filesystem = $connection->getConnection();
            //$file = Input::file('image');
            $filesystem->put( $dropbox_file_name, File::get($file)); //save image to dropbox

            // Calling to controller file method and redirect to form view page
            // After redirection user getting acknowledgment of success message
            return Redirect::to('dropbox')->with('user-info', 'Upload successfully');
        }

        
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //display edit data
    {
        $file_name = Files::where('id', $id)->first();
        return view('dropbox.show',['file_name' => $file_name]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DropboxStorageRepository $connection, Request $request) //update dropbox file name
    {
        $v = Validator::make($request->all(), [
            'f_name' => 'required|max:100',
        ]);
        if ($v->fails()) {
            return redirect('dropbox/'.$request->input('f_id').'')
                ->withInput()
                ->withErrors($v);
        } else {
            $file_old_name = Files::where('id', $request->input('f_id'))->first();
            $filesystem = $connection->getConnection(); //connect to dropbox
            $filesystem->rename($file_old_name->file_name.'.'.$file_old_name->file_type,$request->input('f_name').'.'.$file_old_name->file_type); //rename file
            $update_f_name = Files::where('id',$request->input('f_id'))
                ->update(['file_name' => $request->input('f_name')]);
            if(!$filesystem) {
                return redirect('dropbox')->with('user-info', 'Error please try again');
            }
            if(!$update_f_name){
                return redirect('dropbox')->with('user-info', 'Error please try again');
            }
            return redirect('dropbox')->with('user-info', 'Update successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DropboxStorageRepository $connection, $id) //delete file from dropbox
    {
        $delete_file =  Files::where('id', $id)->first();
        $filesystem = $connection->getConnection();
        $filesystem->delete($delete_file->file_name.'.'.$delete_file->file_type); //save image to dropbox
        Files::findOrFail($id)->delete(); //remove file name from database
        return redirect('dropbox')->with('user-info', 'Delete "'.$delete_file->file_name.'" successfully');
    }
}
