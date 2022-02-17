<?php

namespace App\Http\Controllers;

use App\Models\Photobooth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class PhotoboothController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:gif|max:10240',
            ]);
        }

        $data = $request->all();

        $photobooth = new Photobooth();

        $photobooth->user_id = auth()->check() ? auth()->user()->id : 1;

        $photobooth->image_type = $data['image_type'];

        $upload_path = '/images/photobooth';
        $upload_path_public = 'public' . $upload_path;

        if (!Storage::exists($upload_path_public)) Storage::makeDirectory($upload_path_public);

        if (!$request->hasFile('image')) {
            $fileType = $data['image_type'];
            $thumbnailParts = explode(';', $data['thumbnail']);
            $fileData = base64_decode(str_replace('base64,', '', end($thumbnailParts)));

            if ($fileType === 'classic') {
                $thumbnailType = explode('/', $thumbnailParts[0]);
                $fileType = end($thumbnailType);
            }

            $file_name = 'photobooth-' . uniqid() . '-' . time() . '.' . $fileType;

            $file_path = $upload_path . '/' . $file_name;

            Storage::disk('local')->put($upload_path_public . '/' . $file_name, $fileData);
        } else {
            $file = $request->file('image');
            $file_name = 'photobooth-' . uniqid() . '-' . time() .'.'. $request->file('image')->extension();
            $file_path = $upload_path . '/' . $file_name;
            //$request->file('image')->storeAs($upload_path_public, $file_name);
            Storage::disk('local')->put($upload_path_public . '/' . $file_name, \File::get($file));
        }

        $photobooth->image_path = $file_path;
        $photobooth->thumbnail = !empty($data['thumbnail']) ? $data['thumbnail'] : null;

        $photobooth->save();

        if (!$request->hasFile('image')) {
            return response()->json([
                'id' => Crypt::encryptString($photobooth->id)
            ]);
        } else {
            return redirect()->route('photobooth.share', [
                'id' => Crypt::encryptString($photobooth->id)
            ]);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function share($id)
    {
        $photoboothId = Crypt::decryptString($id);

        $photobooth = Photobooth::findOrFail($photoboothId);

        if ($photobooth) return view('front.photobooth.7-share', [
            'photobooth' => $photobooth->toArray(),
            'id' => base64_encode($photoboothId)
        ]);
        else return response()->redirectTo('/photobooth');
    }
}
