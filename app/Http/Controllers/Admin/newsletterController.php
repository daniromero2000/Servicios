<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\NewsLetter;

class newsletterController extends Controller
{
    public function index()
    { }


    public function create()
    { }

    public function store(Request $request)
    {
        $newsLetter = NewsLetter::updateOrCreate(['email' => $request->get('email')], ['termsAndConditions' => $request->get('termsAndConditions')]);

        return redirect()->route('thankYouPageNewsletter');
    }

    public function show($id)
    { }

    public function edit($id)
    { }

    public function update(Request $request, $id)
    { }

    public function destroy($id)
    { }
}
