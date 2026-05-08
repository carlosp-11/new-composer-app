<?php

namespace App\Http\Controllers;

use App\Models\Images;
use App\Models\Productos;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function showImage($id)
    {
        $image = Images::findOrFail($id);
        $producto = Productos::findOrFail($image->id_producto);
        abort_if($producto->id_user !== auth()->id(), 403);

        return redirect($image->url);
    }
}
