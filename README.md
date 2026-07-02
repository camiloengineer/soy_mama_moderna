# Soy Mamá Moderna — WordPress

Código del sitio [soymamamoderna.com](https://www.soymamamoderna.com) bajo control de versiones, con despliegue continuo a cPanel vía GitHub Actions.

## Qué versiona este repo

Versiona **el código**: WordPress core, tema y plugins. **No** versiona datos ni secretos:

| Fuera del repo | Motivo |
|---|---|
| `wp-config.php` | Contiene credenciales de BD y salts. El repo es **público**. |
| `wp-content/uploads/` | Media (imágenes). Son datos, no código; ~2 GB. Viven solo en el hosting. |
| `wp-content/cache/`, `endurance-page-cache/` | Cachés generadas en runtime. |
| `wp-content/mu-plugins/` | Inyectados y auto-actualizados por el hosting (Newfold/Bluehost). |
| `.htaccess` | Lo reescribe WordPress/EPC dinámicamente en el servidor. |

## Despliegue (CI/CD)

`git push` a `main` dispara `.github/workflows/deploy.yml`, que sincroniza el código al hosting por **FTPS** (`SamKirkland/FTP-Deploy-Action`).

- **No** borra archivos del servidor que no estén en el repo (`dangerous-clean-slate: false`) → la media en `uploads/` está a salvo.
- Excluye del deploy: `wp-config.php`, `.htaccess`, `mu-plugins/`, `uploads/`, cachés y temporales.

### Secrets requeridos (Settings → Secrets → Actions)

| Secret | Valor |
|---|---|
| `FTP_SERVER` | `soymamamoderna.com` |
| `FTP_USERNAME` | usuario FTP de cPanel |
| `FTP_PASSWORD` | contraseña del usuario FTP |

## Caché

El hosting trae **Endurance Page Cache** (mu-plugin nativo). Se controla con la opción `endurance_cache_level` (0=Off, 1=Assets, 2=Normal, 3=Advanced). Activar por la vía correcta (WP-CLI o Ajustes → Generales → Endurance Cache) para que se reescriban las reglas de `.htaccess` y se active la caché nginx del host:

```bash
wp option update endurance_cache_level 2
```
