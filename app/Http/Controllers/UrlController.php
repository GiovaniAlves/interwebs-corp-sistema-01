<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUrlRequest;
use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $urls = Url::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->select('id', 'name')->get();

        return Inertia::render('Urls/Index', ['urls' => $urls]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Urls/Create');
    }


    /**
     * @param StoreUpdateUrlRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUpdateUrlRequest $request)
    {
        $url = Url::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name
        ]);

        // Sending the url data for system 02
        Http::post(env('URL_SYSTEM_02') . '/setUrl', [
           'url_id' => $url->id,
           'url_name' => $url->name
        ]);

        return Redirect::route('url.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Inertia\Response
     */
    public function show($id)
    {
        $url = Url::find($id);

        return Inertia::render('Urls/Details', ['url' => $url]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Inertia\Response
     */
    public function edit($id)
    {
        $url = Url::find($id);

        return Inertia::render('Urls/Edit', ['url' => $url]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateUrlRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreUpdateUrlRequest $request, $id)
    {
        $url = Url::find($id);
        $url->update($request->validated());

        // Sending the url data for system 02
        Http::post(env('URL_SYSTEM_02') . '/setUrl', [
            'url_id' => $url->id,
            'url_name' => $url->name
        ]);

        return Redirect::route('url.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $url = Url::find($id);
        $url->delete();

        $urlComplete = env('URL_SYSTEM_02') . '/delete-answer/' . $id;

        // deleting urlAnswer
        Http::post($urlComplete);

        return Redirect::back();
    }
}
