<?php

namespace CodeFlix\Http\Controllers\Admin;

use CodeFlix\Forms\VideoRelationForm;
use CodeFlix\Models\Video;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\Form;

class VideoRelationsController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Video $video)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(VideoRelationForm::class,[
            'url' => route('admin.videos.relations.store', ['video' => $video->id]),
            'method' => 'POST',
            'model' => $video
        ]);

        return view('admin.videos.relation', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \CodeFlix\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
}
