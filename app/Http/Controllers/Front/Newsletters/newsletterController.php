<?php

namespace App\Http\Controllers\Front\Newsletters;

use Midnite81\GeoLocation\Contracts\Services\GeoLocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\NewsLetters\NewsLetter;

class newsletterController extends Controller
{

    public function index(GeoLocation $geo, Request $request)
    {
        $ipLocation = $geo->getCity($request->ip());
    }

    public function store(Request $request)
    {
        NewsLetter::updateOrCreate(
            ['email' => $request->get('email')],
            ['termsAndConditions' => $request->get('termsAndConditions')]
        );

        return redirect()->route('thankYouPageNewsletter');
    }
}
