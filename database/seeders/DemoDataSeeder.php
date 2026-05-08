<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Almacenes;
use App\Models\Categorias;
use App\Models\Productos;
use App\Models\Estados;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Administrador de demostración (gestiona almacenes y categorías)
        $demoUser = User::create([
            'name' => 'Demo Admin',
            'email' => 'demo@inventario.com',
            'email_verified_at' => now(),
            'password' => Hash::make('demo123'),
            'role' => User::ROLE_ADMIN,
        ]);

        // Segundo administrador para validar multi-tenancy
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@inventario.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'role' => User::ROLE_ADMIN,
        ]);

        // Operario que sólo registra/escanea productos del Demo Admin
        $operarioUser = User::create([
            'name' => 'Operario Demo',
            'email' => 'operario@inventario.com',
            'email_verified_at' => now(),
            'password' => Hash::make('operario123'),
            'role' => User::ROLE_OPERARIO,
        ]);

        // Crear almacenes para demo user
        $almacenPrincipal = Almacenes::create([
            'nombre' => 'Almacén Principal',
            'descripcion' => 'Almacén central con mayor capacidad',
            'id_user' => $demoUser->id,
        ]);

        $almacenSecundario = Almacenes::create([
            'nombre' => 'Almacén Sucursal Norte',
            'descripcion' => 'Almacén de la sucursal ubicada en zona norte',
            'id_user' => $demoUser->id,
        ]);

        $almacenAdmin = Almacenes::create([
            'nombre' => 'Almacén Administrativo',
            'descripcion' => 'Almacén para uso exclusivo del administrador',
            'id_user' => $adminUser->id,
        ]);

        // Crear categorías para demo user
        $categorias = [
            ['nombre' => 'Electrónicos', 'descripcion' => 'Dispositivos electrónicos y tecnología'],
            ['nombre' => 'Oficina', 'descripcion' => 'Artículos y suministros de oficina'],
            ['nombre' => 'Hogar', 'descripcion' => 'Productos para el hogar y decoración'],
            ['nombre' => 'Deportes', 'descripcion' => 'Equipamiento deportivo y fitness'],
            ['nombre' => 'Libros', 'descripcion' => 'Literatura, manuales y material educativo'],
        ];

        foreach ($categorias as $categoria) {
            Categorias::create([
                'nombre' => $categoria['nombre'],
                'descripcion' => $categoria['descripcion'],
                'id_user' => $demoUser->id,
            ]);
        }

        // Crear categorías para admin
        Categorias::create([
            'nombre' => 'Administración',
            'descripcion' => 'Productos de uso administrativo',
            'id_user' => $adminUser->id,
        ]);

        // Obtener categorías creadas
        $electronicosId = Categorias::where('nombre', 'Electrónicos')->where('id_user', $demoUser->id)->first()->id;
        $oficinaId = Categorias::where('nombre', 'Oficina')->where('id_user', $demoUser->id)->first()->id;
        $hogarId = Categorias::where('nombre', 'Hogar')->where('id_user', $demoUser->id)->first()->id;
        $deportesId = Categorias::where('nombre', 'Deportes')->where('id_user', $demoUser->id)->first()->id;
        $librosId = Categorias::where('nombre', 'Libros')->where('id_user', $demoUser->id)->first()->id;

        // Crear productos para demo user
        $productos = [
            // Electrónicos
            [
                'nombre' => 'Laptop Dell Inspiron 15',
                'precio' => 899.99,
                'descripcion' => 'Laptop de 15.6 pulgadas, Intel i5, 8GB RAM, 256GB SSD',
                'almacen' => $almacenPrincipal->id,
                'id_user' => $demoUser->id,
            ],
            [
                'nombre' => 'Mouse Logitech MX Master 3',
                'precio' => 89.99,
                'descripcion' => 'Mouse inalámbrico ergonómico para productividad',
                'almacen' => $almacenPrincipal->id,
                'id_user' => $demoUser->id,
            ],
            [
                'nombre' => 'Monitor Samsung 24"',
                'precio' => 199.99,
                'descripcion' => 'Monitor Full HD de 24 pulgadas con panel IPS',
                'almacen' => $almacenSecundario->id,
                'id_user' => $demoUser->id,
            ],
            [
                'nombre' => 'Teclado Mecánico RGB',
                'precio' => 129.99,
                'descripcion' => 'Teclado mecánico con switches azules y retroiluminación RGB',
                'almacen' => $almacenPrincipal->id,
                'id_user' => $demoUser->id,
            ],

            // Oficina
            [
                'nombre' => 'Silla Ergonómica',
                'precio' => 249.99,
                'descripcion' => 'Silla de oficina ergonómica con soporte lumbar ajustable',
                'almacen' => $almacenPrincipal->id,
                'id_user' => $demoUser->id,
            ],
            [
                'nombre' => 'Escritorio Standing Desk',
                'precio' => 399.99,
                'descripcion' => 'Escritorio ajustable en altura para trabajo de pie',
                'almacen' => $almacenSecundario->id,
                'id_user' => $demoUser->id,
            ],
            [
                'nombre' => 'Impresora Multifuncional',
                'precio' => 179.99,
                'descripcion' => 'Impresora láser multifuncional con WiFi',
                'almacen' => $almacenPrincipal->id,
                'id_user' => $demoUser->id,
            ],

            // Hogar
            [
                'nombre' => 'Aspiradora Robot',
                'precio' => 299.99,
                'descripcion' => 'Aspiradora robot inteligente con mapeo y control por app',
                'almacen' => $almacenPrincipal->id,
                'id_user' => $demoUser->id,
            ],
            [
                'nombre' => 'Cafetera Espresso',
                'precio' => 159.99,
                'descripcion' => 'Cafetera espresso automática con molinillo integrado',
                'almacen' => $almacenSecundario->id,
                'id_user' => $demoUser->id,
            ],

            // Deportes
            [
                'nombre' => 'Bicicleta Estática',
                'precio' => 449.99,
                'descripcion' => 'Bicicleta estática con resistencia magnética y monitor LCD',
                'almacen' => $almacenSecundario->id,
                'id_user' => $demoUser->id,
            ],
            [
                'nombre' => 'Set de Mancuernas',
                'precio' => 89.99,
                'descripcion' => 'Set de mancuernas ajustables de 5 a 25 kg',
                'almacen' => $almacenPrincipal->id,
                'id_user' => $demoUser->id,
            ],

            // Libros
            [
                'nombre' => 'Clean Code - Robert Martin',
                'precio' => 39.99,
                'descripcion' => 'Guía para escribir código limpio y mantenible',
                'almacen' => $almacenPrincipal->id,
                'id_user' => $demoUser->id,
            ],
            [
                'nombre' => 'Laravel: Guía Completa',
                'precio' => 49.99,
                'descripcion' => 'Manual completo para desarrollo con Laravel',
                'almacen' => $almacenPrincipal->id,
                'id_user' => $demoUser->id,
            ],
        ];

        $productosCreados = [];
        foreach ($productos as $index => $producto) {
            $productoCreado = Productos::create($producto);
            $productosCreados[] = $productoCreado;
        }

        // Crear algunos productos para admin user
        $adminCategoria = Categorias::where('id_user', $adminUser->id)->first()->id;
        
        $serverProduct = Productos::create([
            'nombre' => 'Servidor Dell PowerEdge',
            'precio' => 2999.99,
            'descripcion' => 'Servidor empresarial para infraestructura crítica',
            'almacen' => $almacenAdmin->id,
            'id_user' => $adminUser->id,
        ]);

        // Asignar categorías a productos (relación muchos a muchos)
        $categoriaMapping = [
            // Electrónicos (productos 0-3)
            [0, $electronicosId], [1, $electronicosId], [2, $electronicosId], [3, $electronicosId],
            // Oficina (productos 4-6)
            [4, $oficinaId], [5, $oficinaId], [6, $oficinaId],
            // Hogar (productos 7-8)
            [7, $hogarId], [8, $hogarId],
            // Deportes (productos 9-10)
            [9, $deportesId], [10, $deportesId],
            // Libros (productos 11-12)
            [11, $librosId], [12, $librosId],
        ];

        foreach ($categoriaMapping as [$productoIndex, $categoriaId]) {
            if (isset($productosCreados[$productoIndex])) {
                \DB::table('productos_has_categorias')->insert([
                    'id_producto' => $productosCreados[$productoIndex]->id,
                    'id_categoria' => $categoriaId,
                ]);
            }
        }

        // Asignar categoría al producto del admin
        \DB::table('productos_has_categorias')->insert([
            'id_producto' => $serverProduct->id,
            'id_categoria' => $adminCategoria,
        ]);

        // Crear estados para todos los productos
        foreach ($productosCreados as $index => $producto) {
            $status = ($index === 3) ? 'con incidencia' : 'en stock'; // El teclado mecánico tiene incidencia
            Estados::create([
                'status' => $status,
                'descripcion' => $status === 'en stock' ? 'Producto disponible en inventario' : 'Producto con problemas de funcionamiento',
                'id_producto' => $producto->id,
            ]);
        }

        // Estado para producto admin
        Estados::create([
            'status' => 'en stock',
            'descripcion' => 'Equipo crítico disponible',
            'id_producto' => $serverProduct->id,
        ]);

        $this->command->info('✅ Datos de ejemplo creados exitosamente:');
        $this->command->info('📧 Demo Admin: demo@inventario.com / demo123');
        $this->command->info('📧 Admin tenant 2: admin@inventario.com / admin123');
        $this->command->info('📧 Operario: operario@inventario.com / operario123');
        $this->command->info('📦 ' . (count($productos) + 1) . ' productos creados');
        $this->command->info('🏢 3 almacenes creados');
        $this->command->info('📋 6 categorías creadas');
        $this->command->info('🔗 ' . (count($categoriaMapping) + 1) . ' relaciones producto-categoría creadas');
        $this->command->info('📊 ' . (count($productosCreados) + 1) . ' estados de producto creados');
    }
}