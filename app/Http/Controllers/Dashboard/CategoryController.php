<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\Dashboard\StoreCategoryRequest;
use App\Http\Requests\Dashboard\UpdateCategoryRequest;
use App\Traits\HasTrash;

class CategoryController extends Controller
{

    use HasTrash;

    protected $model = Category::class;
    protected $viewPath = 'dashboard.categories.';
    protected $routePath = 'dashboard.categories.';


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::query();

        $query->when($request->search, function ($q, $term) {
            return $q->search($term);
        });

        $this->applyTrash($request, $query);

        $categories = $query->paginate(config('custom.pagination'))
            ->withQueryString();

        return view($this->viewPath . 'index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view($this->viewPath . 'create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->validated());

        return redirect()->route($this->routePath . 'index')
            ->with('success', 'Category Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view($this->viewPath . 'edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect()->route($this->routePath . 'index')
            ->with('success', 'Category Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route($this->routePath . 'index')
            ->with('success', 'Category Deleted Successfully!');
    }
}
