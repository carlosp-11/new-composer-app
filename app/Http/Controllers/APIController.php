<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Images;
use App\Models\Productos;

class APIController extends Controller
{
    public function getQRCode(Request $request)
    {
        $url = 'https://getqrcode.p.rapidapi.com/api/getQR';
        $queryParams = [
            'forQR' => $request->input('http://new-composer-app.test/productos/3/editar'),
        ];
        $headers = [
            'X-RapidAPI-Key' =>  env('X_RAPID_API_KEY'),
            'X-RapidAPI-Host' => 'getqrcode.p.rapidapi.com',
        ];

        try {
            $client = new Client();
            $response = $client->request('GET', $url, [
                'query' => $queryParams,
                'headers' => $headers,
            ]);

            $result = $response->getBody()->getContents();
            return $result;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function showImage($id)
    {
        $image = Images::findOrFail($id);
        $producto = Productos::findOrFail($image->id_producto);
        abort_if($producto->id_user !== auth()->id(), 403);

        return redirect($image->url);
    }

}
