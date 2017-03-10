<?php

namespace App\Http\Controllers\Api\Admin;


use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\CategoryForm;
use App\Http\Requests\UpdateCateForm;
use App\Repositories\CategoryRepository;
use App\Transformers\Admin\CategoryTransformer;
use Illuminate\Support\Facades\Auth;

class CategoryController extends ApiController
{
    /**
     * @var CategoryRepository
     */
    protected $category;

    /**
     * CategoryController constructor.
     *
     * @param CategoryRepository $category
     */
    public function __construct(CategoryRepository $category)
    {
        parent::__construct();
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->can('list-cate'))
            abort(403);
        $categorys = $this->category->page(10);
        //$categorys = Category::find(1);
        return $this->respondWithPaginator($categorys, new CategoryTransformer());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryForm  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryForm $request)
    {
        if(!Auth::user()->can('create-cate'))
            abort(403);
        $cateData = $request->except('create_at','update_at','delete_at');
        $this->category->create($cateData);

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
        $categorys = $this->category->getById($id);
        return $this->respondWithItem($categorys, new categoryTransformer());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCateForm $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCateForm $request, $id)
    {
        if(!Auth::user()->can('edit-cate'))
            abort(403);
        $cateData = $request->except('create_at','update_at','delete_at');
        $this->category->update($id,$cateData);

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
        if(!Auth::user()->can('delete-cate'))
            abort(403);
        $this->category->destroy($id);
        return $this->noContent();
    }

}
