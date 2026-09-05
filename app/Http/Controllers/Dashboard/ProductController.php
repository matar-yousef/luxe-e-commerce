<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\StoreProductRequest;
use App\Http\Requests\Dashboard\UpdateProductRequest;
use App\Services\ImageService;
use Illuminate\Support\Facades\Gate;
use App\Traits\HasTrash;
use App\Models\Category;

class ProductController extends Controller
{
    use HasTrash;
    protected $imageService;
    protected $model = Product::class;
    protected $viewPath = 'dashboard.products.';
    protected $routePath = 'dashboard.products.';

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::with(['images', 'category']);

        $products->when($request->search, function ($q, $term) {
            return $q->search($term);
        });

        $this->applyTrash($request, $products);
        $products = $products->paginate(config('custom.pagination'))->withQueryString();

        return view($this->viewPath . 'index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view($this->viewPath . 'create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());

        if ($request->hasFile('image')) {

            $filename = $this->imageService->handleImage($request->file('image'), 'products');
            $product->images()->create([
                'url' => $filename,
            ]);
        }

        return redirect()->route($this->routePath . 'index')
            ->with('success', 'Product created successfully!');
    }
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view($this->viewPath . 'edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        if ($request->hasFile('image')) {
            $oldImage = $product->images->first();

            if ($oldImage) {
                $this->imageService->deleteImage($oldImage->url, 'products');
                $oldImage->delete();
            }

            $filename = $this->imageService->handleImage($request->file('image'), 'products');

            $product->images()->create(['url' => $filename]);
        }

        return redirect()->route($this->routePath . 'index')->with('success', 'Product updated successfully!');
    }


    public function destroy(Product $product)
    {

        Gate::authorize('destroy-access');

        $product->delete();

        return redirect()->route($this->routePath . 'index')
            ->with('success', 'Product deleted successfully!');
    }
}
