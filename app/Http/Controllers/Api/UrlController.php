<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Url;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function index()
    {
        $urls = Url::all();
        return response(['urls' => $urls], 200);
    }
}
