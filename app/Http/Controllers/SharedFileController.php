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
        $short_link = Link::create([
            'shared_file_id' => $sharde_file->id,
            'link' => URL::to('/').'/'.'download-page'.$sharde_file->id,
            'short_link' => URL::to('/').'/'.$code,
            'code' =>$code,
        ]);
        $link = URL::signedRoute('success',[ $sharde_file->id]);

        return Redirect::to($link);

    }


        public function success($id){
        $link_short = Link::where('shared_file_id',$id)->first();
        $link = URL::signedRoute('short-link',['code'=>$link_short->code]);
        return view('success',compact('id','link'));
    }

    public function short_link($code)
    {
        $link_short = Link::where('code',$code)->first();
        $link = URL::signedRoute('download_page',[$link_short->shared_file_id,'code'=>$link_short->code]);
        return Redirect::to($link);

      

    }

    public function download_page($id){
        $link = URL::signedRoute('download',[$id]);
        return view('download_page',compact('link'));
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
