<?php

namespace App\Http\Controllers\Api\Admin;


use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\TagForm;
use App\Http\Requests\UpdateTagForm;
use App\Repositories\TagRepository;
use App\Transformers\Admin\tagTransformer;
use Illuminate\Support\Facades\Auth;

class TagController extends ApiController
{
    /**
     * @var TagRepository
     */
    protected $tag;

    /**
     * TagController constructor.
     *
     * @param TagRepository $tag
     */
    public function __construct(TagRepository $tag)
    {
        parent::__construct();
        $this->tag = $tag;
    }

    /**
     * Display a listing of the resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->can('list-tag'))
            abort(403);
        $tags = $this->tag->page(20);
        return $this->respondWithPaginator($tags, new tagTransformer());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  tagForm  $request
     * @return \Illuminate\Http\Response
     */
    public function store(tagForm $request)
    {
        if(!Auth::user()->can('create-tag'))
            abort(403);
        $cateData = $request->except('create_at','update_at','delete_at');
        $this->tag->create($cateData);

        return $this->created();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tags = $this->tag->getById($id);
        return $this->respondWithItem($tags, new tagTransformer());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateTagForm $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagForm $request, $id)
    {
        if(!Auth::user()->can('edit-tag'))
            abort(403);
        $cateData = $request->except('create_at','update_at','delete_at');
        $this->tag->update($id,$cateData);

        return $this->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->can('delete-tag'))
            abort(403);
        $this->tag->destroy($id);
        return $this->noContent();
    }

}
