<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Link;
use App\Models\SharedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use ZipArchive;
use Illuminate\Support\Str;

class SharedFileController extends Controller
{
    public function store(Request $request)
    {
       $sharde_file = SharedFile::create($request->all());
      
       if($request->hasFile('shared_files')){
            foreach ($request->file('shared_files') as $file) {
                $image_path=$file->store('/files',[
                    'disk'=>'uploads'
                ]);
                $file_type = $file->extension();
                $sharde_file->files()->create([
                    'path' => $image_path,
                    'type'  =>  $file_type,
                ]);

            }
        }
        $code = Str::random();
        $link = Link::create([
            'shared_file_id' => $sharde_file->id,
            'link' => URL::to('/').'/'.'download-page'.$sharde_file->id,
            'short_link' => URL::to('/').'/'.$code,
            'code' =>$code,
        ]);

        return to_route('success', $sharde_file->id);

    }


    public function success($id){
        $link = Link::where('shared_file_id',$id)->first();
        return view('success',compact('id','link'));
    }

    public function short_link($code)
    {
        $link = Link::where('code',$code)->first();

        return Redirect::route('download_page',$link->shared_file_id);

      

    }

    public function download_page($id){
        return view('download_page',compact('id'));
    }

    
    public function download($id)
    {
             //   return FacadesFile::files(public_path('uploads/files'))[0];
        $shared_file = SharedFile::findOrFail($id);
        $files = File::where('shared_file_id', $id)->pluck('path')->toArray();
      //  return $files;
        $zip = new \ZipArchive();
        $fileName = "file".time().'.zip';
        if ($zip->open(public_path($fileName), \ZipArchive::CREATE)== TRUE)
        {
            foreach ($files as $key => $value){
                $relativeName = basename($value);
                $zip->addFile(public_path()."/uploads/".$value, $relativeName);
                
            }
            $zip->close();
           
        }
         return response()->download(public_path($fileName));
         //return to_route('successs', $shared_file->id);

    }


   
}
