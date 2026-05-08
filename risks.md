# Riesgos y deuda técnica — C-DEPOT

Documento de seguimiento. Última actualización: 2026-05-08.

---

## 🔴 Acciones manuales pendientes (críticas)

### R-01 — Rotar APP_KEY en producción
La clave `base64:ZrpbqwELd3bKvk0+M8lLUnCOEOMiXEmLYnqIX1IMAFI=` quedó expuesta en el historial de git (commit `db4e0db` y siguientes). En este PR ya se eliminó del `render.yaml` (ahora `sync: false`).

**Pasos manuales obligatorios antes del deploy de este PR:**
1. Entrar al panel de Render → Service `c-depot` → Environment.
2. Generar una nueva APP_KEY localmente: `php artisan key:generate --show`.
3. Definir `APP_KEY` en Render como Secret con el valor generado.
4. Redeploy.
5. Las sesiones activas se invalidarán (esperado).

### R-02 — Rotar X_RAPID_API_KEY
Si la clave de RapidAPI estaba en el `.env` de producción, rotarla. En F4 (próxima fase) se elimina la dependencia y la variable.

---

## 🟡 Hallazgos pendientes para fases siguientes

| ID | Origen | Severidad | Fase planificada |
|---|---|---|---|
| F-07 | Sin headers de seguridad (CSP, HSTS, X-Frame-Options, X-Content-Type-Options, Referrer-Policy) | MEDIO | F13 |
| F-09 | `session.encrypt = false` (cookie ahora ya tiene Secure/SESSION_LIFETIME corto) | MEDIO | F13 |
| F-10 | Resultado de QR escaneado se inserta en `innerHTML` como `<a href>` sin validar protocolo | MEDIO | F4 |
| F-12 | Bootstrap 4.0.0 con CVE-2018-14040/14041/14042 + jQuery duplicado | MEDIO | F12 (al migrar a Tailwind se elimina) |
| F-13 | Sin logging de eventos de seguridad (login fallido, cambios de estado) | MEDIO | F12 |
| F-14 | Credenciales demo `demo@inventario.com / demo123` y `admin@inventario.com / admin123` en seeder ejecutado en producción | BAJO | F2 (al rehacer seeder con roles) |
| F-15 | Política de password solo `min:8`, sin complejidad ni 2FA | BAJO | F11 |
| F-16 | CORS `allowed_origins: ['*']` (sólo afecta a `api/*`, sin `supports_credentials`) | BAJO | F13 |
| F-17 | Patrón SSRF latente en `APIController::getQRCode` (código muerto, pero feo) | BAJO | F4 (controlador desaparece) |

---

## 🟢 Cerrado en este hotfix (work/security-hotfix)

- F-01 IDOR en Productos `edit/update/destroy/detail/updateStatus`
- F-02 IDOR en `show/display` (ahora filtran por `id_user`)
- F-03 `debug-render.php` borrado del repo
- F-04 `APP_KEY` ya no está en `render.yaml` (pendiente acción manual R-01)
- F-05 `logout()` invalida sesión, regenera token y revoca tokens Passport
- F-06 `throttle` aplicado a `/login` (5/min), `/signup` (3/min), `/getQRCode` (10/min)
- F-08 `updateStatus` valida ownership y whitelist de status
- F-11 Mass assignment cerrado: `$request->only(...)` + `id_user` fuera del `$fillable`
- F-19 `startup.sh` usa `migrate` (no `migrate:fresh`); seeders solo si DB vacía
- F-18 `SESSION_LIFETIME=120` y `SESSION_SECURE_COOKIE=true` en producción
- `/qrscanner` ahora requiere auth
