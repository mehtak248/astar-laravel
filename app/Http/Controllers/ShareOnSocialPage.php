<?php

namespace App\Http\Controllers;

use App\Models\Photobooth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class ShareOnSocialPage extends Controller
{
    /**
     * @param $id
     * @param $route
     * @param $download
     * @return \Symfony\Component\HttpFoundation\StreamedResponse|\Illuminate\Contracts\View\View
     */
    public function share($route, $id, $download = null)
    {
        $image = "";

        if ($route === "photobooth") {
            $photobooth = Photobooth::select('image_path')->where('id', base64_decode($id))->first();

            if ($photobooth) {
                $image = 'storage' . $photobooth->image_path;
            }

            if ($download === 'download' and $photobooth) {
                $headers = array(
                    'Content-type' => 'application/octet-stream',
                );

                $filename = explode('/', $photobooth->image_path);

                return Storage::download('public' . $photobooth->image_path, end($filename), $headers);
            }
        }

        return view('front.social-page-sharing', compact('id', 'route', 'image'));
    }
}
