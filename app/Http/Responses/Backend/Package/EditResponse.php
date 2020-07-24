<?php

namespace App\Http\Responses\Backend\Package;
use Illuminate\Contracts\Support\Responsable;
use App\Models\Product\Product;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\Package\Package
     */
    protected $package;

    /**
     * @param App\Models\Package\Package $packages
     */
    public function __construct($package)
    {
        $this->package = $package;
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
        $products = Product::all();
        return view('backend.packages.edit')->with([
            'package' => $this->package,
            'products' => $products
        ]);
    }
}