<?php

namespace App\Http\Controllers;

use App\ProductSize;
use Illuminate\Http\Request;
use App\Http\Requests\CreateProductSize;

class ProductSizesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $productSizes = ProductSize::latest('updated_at')->get();
      return view('cms.product_sizes', compact('productSizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductSize $request)
    {
        ProductSize::create($request->all());
        return $this->productSizesTable();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductSize  $productSize
     * @return \Illuminate\Http\Response
     */
    public function show(ProductSize $productSize)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductSize  $productSize
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductSize $productSize)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductSize  $productSize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      ProductSize::where(compact('id'))->update($request->all());
      return $this->productSizesTable();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductSize  $productSize
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductSize $size)
    {
        $size->delete();
        return $this->productSizesTable();
    }

    private function productSizesTable() {
      $productSizes = ProductSize::latest('updated_at')->get();
      return view('cms.tables.product_sizes_table',
                  compact('productSizes'));
    }
}
