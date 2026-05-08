<?php

namespace App\Http\Controllers;

use App\Models\Almacenes;
use App\Models\Categorias;
use App\Models\Estados;
use App\Models\Productos;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $user = auth()->user();

        $stats = [
            'almacenes' => Almacenes::where('id_user', $userId)->count(),
            'categorias' => Categorias::where('id_user', $userId)->count(),
            'productos' => Productos::where('id_user', $userId)->count(),
        ];

        $stats['incidencias'] = $this->countWithIncidence($userId);

        $onboarding = [
            'almacen' => $stats['almacenes'] > 0,
            'categoria' => $stats['categorias'] > 0,
            'producto' => $stats['productos'] > 0,
        ];
        $onboarding['done'] = collect($onboarding)->filter()->count();
        $onboarding['total'] = 3;

        return view('pages.home.index', compact('user', 'stats', 'onboarding'));
    }

    /**
     * Cuenta los productos del usuario cuyo último estado es "con incidencia".
     */
    private function countWithIncidence(int $userId): int
    {
        $productoIds = Productos::where('id_user', $userId)->pluck('id');

        if ($productoIds->isEmpty()) {
            return 0;
        }

        $latestStates = Estados::whereIn('id_producto', $productoIds)
            ->orderBy('id_producto')
            ->orderByDesc('id')
            ->get()
            ->groupBy('id_producto')
            ->map(fn ($group) => $group->first());

        return $latestStates->where('status', 'con incidencia')->count();
    }
}
