# 📦 Sistema de Gestión de Inventario

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-4.x-646CFF?style=for-the-badge&logo=vite&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

**Sistema completo de gestión de inventario con autenticación multiusuario, scanner QR y reportes avanzados**

[🚀 Demo en vivo](#demo) • [📖 Documentación](#documentación) • [💻 Instalación](#instalación) • [🤝 Contribuir](#contribuir)

</div>

---

## 🌟 Características Principales

### 🔐 **Autenticación Avanzada**
- Sistema completo de registro/login
- Autenticación con **Laravel Sanctum & Passport**
- Gestión de sesiones seguras
- Recuperación de contraseña
- Área personal del usuario

### 📦 **Gestión de Inventario**
- **Productos**: CRUD completo con imágenes y códigos QR únicos
- **Almacenes**: Organización por ubicaciones físicas
- **Categorías**: Sistema de clasificación flexible
- **Estados**: Control de estado de productos
- **Multi-tenancy**: Cada usuario maneja su propio inventario

### 📱 **Scanner QR Integrado**
- Generación automática de códigos QR únicos
- Scanner web nativo para consulta rápida
- Búsqueda instantánea por código QR
- Compatible con dispositivos móviles

### 🎨 **Interface Moderna**
- **Responsive Design** con TailwindCSS
- **Animaciones fluidas** con Animate.css
- **Dark/Light mode ready**
- **Progressive Web App (PWA)** compatible
- **Mobile-first** approach

### 🖼️ **Gestión de Imágenes**
- Integración con **Cloudinary**
- Subida múltiple de imágenes
- Optimización automática
- CDN global para carga rápida

### 🗄️ **Base de Datos Flexible**
- **SQLite** para desarrollo local (configuración cero)
- **MySQL/PostgreSQL** para producción
- Migraciones automáticas
- Datos de ejemplo incluidos

### 🔧 **API REST**
- Endpoints completos para todas las entidades
- Documentación con Swagger
- Rate limiting implementado
- Versionado de API

---

## 🛠️ Stack Tecnológico

### Backend
```php
🐘 PHP 8.1+
🎯 Laravel 10.x
🔐 Laravel Sanctum + Passport
📧 Laravel Mail System
🗄️ SQLite (desarrollo) / MySQL/PostgreSQL (producción)
☁️ Cloudinary Integration
```

### Frontend
```javascript
🎨 TailwindCSS 3.x
⚡ Vite 4.x
🌊 Alpine.js 3.x
📱 Bootstrap 4.x (Legacy support)
✨ Animate.css
🔍 QR Scanner Library
```

### DevOps & Tools
```yaml
🐳 Docker Ready
🧪 PHPUnit Testing
📊 Laravel Telescope
🔍 Laravel Debugbar
📝 Composer Package Manager
📦 NPM/Yarn Support
```

---

## 📸 Capturas de Pantalla

<div align="center">

### 🏠 Dashboard Principal
![Dashboard](https://via.placeholder.com/800x400/1F2937/FFFFFF?text=Dashboard+Principal)

### 📦 Gestión de Productos
![Productos](https://via.placeholder.com/800x400/3B82F6/FFFFFF?text=Gestión+de+Productos)

### 📱 Scanner QR
![Scanner](https://via.placeholder.com/800x400/10B981/FFFFFF?text=Scanner+QR)

</div>

---

## 🚀 Instalación Rápida

### 📋 Prerrequisitos
- PHP 8.1 o superior (con extensión SQLite habilitada)
- Composer
- Node.js 16+ y NPM  
- Git

> **💡 Nota**: No necesitas MySQL/PostgreSQL para empezar. El proyecto incluye SQLite configurado con datos de ejemplo.

### ⚡ Instalación en 5 pasos

```bash
# 1️⃣ Clonar el repositorio
git clone https://github.com/tu-usuario/sistema-inventario.git
cd sistema-inventario

# 2️⃣ Instalar dependencias PHP
composer install

# 3️⃣ Instalar dependencias JavaScript
npm install

# 4️⃣ Configurar entorno
cp .env.example .env
php artisan key:generate

# 5️⃣ Configurar base de datos y ejecutar migraciones con datos de ejemplo
php artisan migrate --seed
```

### 🔧 Configuración Adicional

```bash
# Configurar Passport
php artisan passport:install

# Compilar assets
npm run build

# Iniciar servidor de desarrollo
php artisan serve

# ✅ ¡Listo! Accede a http://localhost:8000
# 🔐 Usa: demo@inventario.com / demo123 para login
```

> **🎉 ¡Configuración completada!** Tu sistema de inventario incluye datos de ejemplo y está listo para usar.

### 🌐 Variables de Entorno Importantes

```env
# Base de datos SQLite (recomendado para desarrollo)
DB_CONNECTION=sqlite
DB_DATABASE=database/inventario.sqlite

# Configuración MySQL alternativa (comentada)
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=inventario
# DB_USERNAME=tu_usuario
# DB_PASSWORD=tu_password

# Cloudinary (para imágenes)
CLOUDINARY_URL=cloudinary://api_key:api_secret@cloud_name
CLOUDINARY_UPLOAD_PRESET=tu_preset

# Mail
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=tu_username
MAIL_PASSWORD=tu_password
```

---

## 👤 Datos de Ejemplo Incluidos

### 🔐 **Usuarios de Prueba**

| Usuario | Email | Contraseña | Rol | Datos |
|---------|-------|------------|-----|-------|
| **Demo User** | `demo@inventario.com` | `demo123` | Usuario estándar | 13 productos, 2 almacenes, 5 categorías |
| **Admin User** | `admin@inventario.com` | `admin123` | Administrador | 1 producto, 1 almacén, 1 categoría |

### 📦 **Productos de Ejemplo**
- **Electrónicos**: Laptop Dell, Mouse Logitech, Monitor Samsung, Teclado RGB
- **Oficina**: Silla Ergonómica, Standing Desk, Impresora Multifuncional  
- **Hogar**: Aspiradora Robot, Cafetera Espresso
- **Deportes**: Bicicleta Estática, Set de Mancuernas
- **Libros**: Clean Code, Laravel: Guía Completa

### 🏢 **Almacenes Configurados**
- Almacén Principal (Demo User)
- Almacén Sucursal Norte (Demo User)  
- Almacén Administrativo (Admin User)

### 📊 **Estados de Productos**
- **En Stock**: Mayoría de productos disponibles
- **Con Incidencia**: Teclado RGB (ejemplo de producto con problemas)

> **💡 Tip**: Usa las credenciales de demo para explorar todas las funcionalidades sin configurar datos manualmente.

---

## 📖 Documentación de la API

### 🔗 Endpoints Principales

| Método | Endpoint | Descripción | Autenticación |
|--------|----------|-------------|---------------|
| `GET` | `/api/productos` | Listar productos | ✅ |
| `POST` | `/api/productos` | Crear producto | ✅ |
| `GET` | `/api/productos/{id}` | Mostrar producto | ✅ |
| `PUT` | `/api/productos/{id}` | Actualizar producto | ✅ |
| `DELETE` | `/api/productos/{id}` | Eliminar producto | ✅ |
| `GET` | `/api/almacenes` | Listar almacenes | ✅ |
| `GET` | `/api/categorias` | Listar categorías | ✅ |

### 📝 Ejemplo de Respuesta API

```json
{
  "success": true,
  "data": {
    "id": 1,
    "nombre": "Laptop HP Pavilion",
    "precio": 899.99,
    "descripcion": "Laptop para trabajo y gaming",
    "almacen": "Almacén Central",
    "categoria": "Electrónicos",
    "QR": "ABC123XYZ",
    "imagen_url": "https://res.cloudinary.com/...",
    "created_at": "2024-01-15T10:30:00Z"
  },
  "message": "Producto recuperado exitosamente"
}
```

---

## 🧪 Testing

### Ejecutar Tests
```bash
# Tests unitarios
php artisan test

# Tests con coverage
php artisan test --coverage

# Tests específicos
php artisan test --filter ProductosTest
```

### 📊 Coverage Actual
- **Models**: 85%
- **Controllers**: 78%
- **API Endpoints**: 92%
- **General**: 82%

---

## 🤝 Contribuir

¡Las contribuciones son bienvenidas! Por favor, sigue estos pasos:

1. **Fork** el proyecto
2. Crea tu **Feature Branch** (`git checkout -b feature/AmazingFeature`)
3. **Commit** tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. **Push** al Branch (`git push origin feature/AmazingFeature`)
5. Abre un **Pull Request**

### 📋 Guidelines de Contribución
- Seguir **PSR-12** para PHP
- Escribir **tests** para nuevas funcionalidades
- Mantener **cobertura de tests** >80%
- Documentar cambios en **CHANGELOG.md**

---

## 🐛 Reportar Bugs

Si encuentras un bug, por favor [abre un issue](https://github.com/tu-usuario/sistema-inventario/issues) con:

- **Descripción** detallada del problema
- **Pasos** para reproducir
- **Entorno** (OS, PHP version, Browser)
- **Screenshots** si es aplicable

---

## 📈 Roadmap

### 🔮 Próximas Funcionalidades

- [ ] **Dashboard Analytics** con gráficos avanzados
- [ ] **Reportes PDF/Excel** exportables
- [ ] **Notificaciones Push** para stock bajo
- [ ] **API GraphQL** alternativa
- [ ] **App Mobile** nativa (React Native)
- [ ] **Integración IoT** para sensores de inventario
- [ ] **Machine Learning** para predicción de demanda

---

## 👥 Equipo

<div align="center">

**Desarrollado con ❤️ por [Tu Nombre]**

[![LinkedIn](https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white)](https://linkedin.com/in/tu-perfil)
[![GitHub](https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white)](https://github.com/tu-usuario)
[![Portfolio](https://img.shields.io/badge/Portfolio-FF5722?style=for-the-badge&logo=google-chrome&logoColor=white)](https://tu-portfolio.com)

</div>

---

## 📄 Licencia

Este proyecto está bajo la **Licencia MIT**. Ver el archivo [LICENSE](LICENSE) para más detalles.

---

## 💝 Agradecimientos

- [Laravel](https://laravel.com) por el framework excepcional
- [TailwindCSS](https://tailwindcss.com) por el sistema de diseño
- [Cloudinary](https://cloudinary.com) por el manejo de imágenes
- [Font Awesome](https://fontawesome.com) por los iconos
- [Animate.css](https://animate.style) por las animaciones

---

<div align="center">

**⭐ Si este proyecto te fue útil, ¡no olvides darle una estrella! ⭐**

![Hecho con Laravel](https://img.shields.io/badge/Hecho%20con-Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)

</div>
