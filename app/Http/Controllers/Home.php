<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\LastSync;
use App\Models\Photo;
use App\Models\Photographer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class Home extends Controller
{
    public function index()
    {
        $last_sync = LastSync::first();
        $today_date = Carbon::now()->toDate()->format('Y-m-d');

        if ( !$last_sync || $last_sync->last_sync_date !== $today_date ) {
            self::sync_photos();
        }

        $photographers = Photographer::all();
        return view('index', ['photographers' => $photographers]);
    }

    public function photographer(Photographer $photographer)
    {
        $photos = Photo::where('photographer_id', $photographer->id)->get();
        return view('detail', ['photos' => $photos, 'photographer' => $photographer]);
    }

    private static function sync_photos()
    {
        try {
            $api_key = "563492ad6f9170000100000105ca3b74cb85411ea9e6d007dac401e3";

            $response = Http::withHeaders(["Authorization" => $api_key])
                ->get("https://api.pexels.com/v1/curated?per_page=80");
            $data = json_decode($response->body());

            foreach ($data->photos as $photo) {
                $photographer = Photographer::where('pexel_photographer_id', $photo->photographer_id)->first();

                if (!$photographer) {
                    $photographers_data = Photographer::create([
                        'pexel_photographer_id' => $photo->photographer_id,
                        'pexel_photographer_url' => $photo->photographer_url,
                        'pexel_photographer_name' => $photo->photographer,
                        'pexel_alt' => $photo->alt
                    ]);
                    $photographer_id = $photographers_data->id;
                } else {
                    $photographer_id = $photographer->id;
                }

                $photo_data = Photo::create([
                    'pexel_photo_id' => $photo->id,
                    'photographer_id' => $photographer_id,
                    'pexel_url' => $photo->url,
                    'pexel_width' => $photo->width,
                    'pexel_height' => $photo->height,
                    'pexel_liked' => $photo->liked
                ]);

                Image::create([
                    'photo_id' => $photo_data->id,
                    'pexel_original' => $photo->src->original,
                    'pexel_large2x' => $photo->src->large2x,
                    'pexel_large' => $photo->src->large,
                    'pexel_medium' => $photo->src->medium,
                    'pexel_small' => $photo->src->small,
                    'pexel_portrait' => $photo->src->portrait,
                    'pexel_landscape' => $photo->src->landscape,
                    'pexel_tiny' => $photo->src->tiny
                ]);
            }

            $last_sync = LastSync::first();

            if ( !$last_sync ) {
                LastSync::create(['last_sync_date' => Carbon::now()->toDate()->format('Y-m-d')]);
            } else {
                LastSync::first()->update(['last_sync_date' => Carbon::now()->toDate()->format('Y-m-d')]);
            }
        } catch (\Exception $exp) {
            $last_sync = LastSync::first();
            if ( !$last_sync ) {
                LastSync::create(['last_sync_date' => Carbon::now()->toDate()->format('Y-m-d')]);
            } else {
                LastSync::first()->update(['last_sync_date' => Carbon::now()->toDate()->format('Y-m-d')]);
            }
        }
    }
}
