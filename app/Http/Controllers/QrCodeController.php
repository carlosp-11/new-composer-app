<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use App\Services\QrCodeService;
use Illuminate\Http\Response;

class QrCodeController extends Controller
{
    public function __construct(private readonly QrCodeService $qrService)
    {
    }

    public function svg(string $id): Response
    {
        $producto = $this->resolveProducto($id);

        return response($this->qrService->svg($this->productoUrl($producto)), 200)
            ->header('Content-Type', 'image/svg+xml')
            ->header('Cache-Control', 'private, max-age=3600');
    }

    public function png(string $id): Response
    {
        $producto = $this->resolveProducto($id);

        return response($this->qrService->png($this->productoUrl($producto)), 200)
            ->header('Content-Type', 'image/png')
            ->header('Cache-Control', 'private, max-age=3600');
    }

    private function resolveProducto(string $id): Productos
    {
        $producto = Productos::findOrFail($id);
        abort_if($producto->id_user !== auth()->id(), 403);

        return $producto;
    }

    private function productoUrl(Productos $producto): string
    {
        return url('/productos/' . $producto->id);
    }
}
