<?php

namespace App\Http\Controllers;

use App\Models\Photobooth;
use App\Models\Socialwall;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class SocialwallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $social_walls = Socialwall::where('is_approve', 1)->get();

        return view('front.social-wall.index',compact('social_walls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return View|RedirectResponse
     */
    public function store(Request $request)
    {
        request()->validate([
            'image' => 'required'
        ]);

        if ($request->hasFile('image')) {

            $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg,gif|max:10240',
            ]);

            $file = $request->file('image');
            $extension       = $request->file('image')->extension();
            $fileNameToStore = 'social-wall-' . uniqid().'-'.time().'.'.$extension;

            $upload_path = '/images/social-wall';
            $upload_path_public = 'public'.$upload_path;

            if (!Storage::exists($upload_path_public)) {
                Storage::makeDirectory($upload_path_public);
            }

            Storage::disk('local')->put($upload_path_public . '/' . $fileNameToStore, \File::get($file));
        }

        if (!empty($request->image)) {
            $Socialwall = new Socialwall();

            $Socialwall->user_id = auth()->check() ? auth()->user()->id : 0;
            $Socialwall->image   = $fileNameToStore;
            if (!empty($request->description))
                $Socialwall->description = strip_tags($request->description);

            $Socialwall->save();

            return response()->redirectTo('social-wall-final');
        }
        return response()->redirectTo('social-wall-upload');
    }

    public function show(Socialwall $socialwall)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Socialwall $socialwall
     * @return void
     */
    public function edit(Socialwall $socialwall)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Socialwall $socialwall
     * @return void
     */
    public function update(Request $request, Socialwall $socialwall)
    {
        //
    }

    public function sharePhotoboothOnWall(Request $request, $id)
    {
        $photobooth = Photobooth::findOrFail(base64_decode($id));

        $photoboothImage = $photobooth->image_path;
        $photoboothImageParts = explode('/', $photoboothImage);
        $photoboothImageName = end($photoboothImageParts);

        $upload_path = '/images/social-wall';
        $upload_path_public = 'public'.$upload_path;

        if (!Storage::exists($upload_path_public)) {
            Storage::makeDirectory($upload_path_public);
        }

        $file = $upload_path_public .'/'. $photoboothImageName;

        if (Storage::exists($file)) {
            Storage::delete($file);
        }

        Storage::copy('public' . $photoboothImage, $file);

        $socialWall = new Socialwall();

        $socialWall->image   = $photoboothImageName;
        if (!empty($request->description))
            $socialWall->description = strip_tags($request->description);
        $socialWall->user_id = auth()->check() ? auth()->user()->id : 0;

        $socialWall->save();

        return response()->redirectTo('social-wall-final');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Socialwall $socialwall
     * @return void
     */
    public function destroy(Socialwall $socialwall)
    {
        //
    }
}
