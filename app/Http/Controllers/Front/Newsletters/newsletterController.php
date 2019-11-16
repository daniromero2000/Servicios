<?php

namespace App\Http\Controllers\Front\Newsletters;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\NewsLetters\NewsLetter;

class newsletterController extends Controller
{
    public function store(Request $request)
    {
        NewsLetter::updateOrCreate(
            ['email' => $request->get('email')],
            ['termsAndConditions' => $request->get('termsAndConditions')]
        );

        return redirect()->route('thankYouPageNewsletter');
    }
}
