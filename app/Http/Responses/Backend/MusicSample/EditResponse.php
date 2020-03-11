<?php

namespace App\Http\Responses\Backend\MusicSample;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\MusicSample\MusicSample
     */
    protected $musicsample;

    /**
     * @param App\Models\MusicSample\MusicSample $musicsamples
     */
    public function __construct($musicsample)
    {
        $this->musicsample = $musicsample;
    }

    /**
     * To Response
     *
     * @param \App\Http\Requests\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        return view('backend.musicsamples.edit')->with([
            'musicsample' => $this->musicsample
        ]);
    }
}