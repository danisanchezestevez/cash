<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryQuestion;
use App\Models\Question;
use App\Models\Brand;
use App\Models\BrandModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','show']]);
        $this->middleware('permission:category-create', ['only' => ['create','store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $categories = Category::latest()->paginate(5);
        return view('categories.index',compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function list()
    {
        $categories = Category::all();
        $view = ['categories' => $categories];
        return view('categories.list', $view);
    }

    public function detail($category_id)
    {
        $category = Category::where('id', $category_id)->first();

        $questionscategories = CategoryQuestion::where('category_id', $category_id)->get();
        $arrayPreguntas=array();
        foreach ($questionscategories as $key => $questioncategory) {
            $arrayPreguntas[$key] = [
                'required' => $questioncategory->required ? 'required' : null,
                'name' => $questioncategory->question->name,
                'type' => $questioncategory->question->type,
                'values' => array()
            ];

            if($questioncategory->question->type == Category::TYPE_SELECT){
                $classRelated = 'App\\Models\\'.$questioncategory->class_related;
                if ($questioncategory->class_related) {
                    $values = $classRelated::getByCategory($category_id);
                    foreach ($values as $value){
                        $arrayPreguntas[$key]['values'][$value->id]=$value->name;
                    }
                }
            }
        }

        $view = [
            'category' => $category,
            'questionscategories' => $arrayPreguntas,
            'TYPE_SELECT' => Category::TYPE_SELECT
        ];
        return view('categories.detail', $view);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')
            ->with('success','Category created successfully.');
    }

    /**
     * @param Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Category $category)
    {
        return view('categories.show',compact('category'));
    }

    /**
     * @param Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Category $category)
    {
        return view('categories.edit',compact('category'));
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Category $category)
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')
            ->with('success','Category updated successfully');
    }

    /**
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success','Category deleted successfully');
    }
}
