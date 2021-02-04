<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\AnnouncementImage;
use App\Http\Requests\CreateAnnouncementRequest;
use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionRemoveFaces;
use App\Jobs\GoogleVisionSafeSearchImage;
use App\Jobs\ResizeImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $uniqueSecret = $request->old(
            'uniqueSecret',
            base_convert(sha1(uniqid(mt_rand())), 16, 36)
        );
        return view('announcements.create', compact('uniqueSecret'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAnnouncementRequest $request)
    {
        $a = new Announcement();
        $a->title = $request->input('title');
        $a->description = $request->input('description');
        $a->price = $request->input('price');
        $a->category_id = $request->input('category');
        $a->user_id = Auth::id();
        $a->save();

        $uniqueSecret = $request->input('uniqueSecret');

        $images = session()->get("images.{$uniqueSecret}", []);
        $removedImages = session()->get("removedimages.{$uniqueSecret}", []);

        $images = array_diff($images, $removedImages);
        foreach ($images as $image) {
            $i = new AnnouncementImage();
            
            $fileName = basename($image);
            $newFileName = "public/announcements/{$a->id}/{$fileName}";
            
            Storage::move($image, $newFileName);
            
            dispatch(new ResizeImage(
                $newFileName,
                300,
                150
            ));

            dispatch(new ResizeImage(
                $newFileName,
                400,
                300
            ));

            $i->file = $newFileName;
            $i->announcement_id = $a->id;

            $i->save();
            

            GoogleVisionSafeSearchImage::withChain([
                new GoogleVisionLabelImage($i->id),
                new GoogleVisionRemoveFaces($i->id),

                new ResizeImage(
                    $i->file,
                    300,
                    150
                ),
                
                new ResizeImage(
                    $i->file,
                    400,
                    300
                )
            ])->dispatch($i->id);
        }

        File::deleteDirectory(storage_path("/app/public/temp/{$uniqueSecret}"));

        return redirect()->back()->with('message', 'Il tuo annuncio è stato caricato correttamente');
    }
    
    public function uploadImage(Request $request)
    {
        $uniqueSecret = $request->input('uniqueSecret');
        $fileName = $request->file('file')->store("public/temp/{$uniqueSecret}");

        dispatch(new ResizeImage(
            $fileName,
            120,
            120,
        ));

        session()->push("images.{$uniqueSecret}", $fileName);

        return response()->json(
            [
                'id' => $fileName
            ]
        );
    }

    public function removeImage(Request $request)
    {
        $uniqueSecret = $request->input('uniqueSecret');

        $fileName = $request->input('id');

        session()->push("removedimages.{$uniqueSecret}", $fileName);

        Storage::delete($fileName);

        return response()->json('ok');
    }


    public function getImages(Request $request)
    {
        $uniqueSecret = $request->input('uniqueSecret');

        $images = session()->get("images.{$uniqueSecret}", []);
        $removedImages = session()->get("removedimages.{$uniqueSecret}", []);

        $images = array_diff($images, $removedImages);

        $data = [];

        foreach ($images as $image) {
            $data[] = [
                'id' => $image,
                // 'src' => Storage::url($image)
                'src' => AnnouncementImage::getUrlByFilePath($image, 120, 120)
            ];
        }

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcement)
    {
        return view('announcements.show', compact('announcement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcement $announcement)
    {     
        return view('announcements.edit', compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announcement $announcement)
    {
        $img = $request->file('img');

        
        if ($img != null) {
            $img = $img->store('public/img');
            $announcement->img = $img;
        }

        $announcement->title = $request->input('title');
        $announcement->description = $request->input('description');
        $announcement->price = $request->input('price');
        $announcement->save();
        return redirect()->back()->with('message', 'Il tuo annuncio è stato caricato correttamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcement $announcement)
    {
        //
    }
}
