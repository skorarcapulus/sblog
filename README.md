# WordPress Development Environment

Modern WordPress development stack with Docker, featuring hot reloading, Redis caching, and optimized development workflow.

## 🚀 Features

- **WordPress 6.6+** with PHP 8.3 (PHP-FPM)
- **Nginx** with security headers and optimized caching
- **MariaDB 11** with health checks
- **Redis** for object caching and performance
- **Vite** for modern asset bundling and hot reloading
- **Mailpit** for local email testing
- **Xdebug** ready for debugging
- **WP-CLI** included for command-line management

## ⚡ Quick Start

1. **Setup environment:**
   ```bash
   cp .env.example .env
   ```

2. **Start development environment:**
   ```bash
   make dev
   ```

3. **Install WordPress:**
   ```bash
   make install
   ```

4. **Access your site:**
   - **WordPress:** http://localhost:8080 (admin/admin)
   - **Vite Dev Server:** http://localhost:3000
   - **Mailpit:** http://localhost:8025

## 📋 Available Commands

Run `make` to see all available commands:

```bash
make help      # Show all commands
make dev       # Start development stack
make up        # Start basic WordPress only
make install   # Install WordPress
make fresh     # Fresh installation (rebuild everything)
make logs      # Show logs (make logs wp/nginx/node)
make shell     # Access container (make shell wp/node/redis)
make wp        # Run WP-CLI commands
make cache     # Clear all caches
make status    # Show container status
make down      # Stop everything
make reset     # Nuclear option - remove everything
```

## 🛠️ Development Workflow

### Theme/Plugin Development
The Node.js container provides modern development tools:
- **File watching** for PHP, JS, CSS changes
- **Vite** for asset bundling and hot reloading
- **Sass** support included

### Debugging
Enable Xdebug by editing `.env`:
```bash
XDEBUG_MODE=debug
```

### Database Management
Connect to MariaDB:
```bash
Host: localhost
Port: 3307
Database: wordpress
User: wp
Password: wp
```

### Redis Caching
Redis is automatically available for WordPress object caching:
```bash
make shell redis  # Access Redis CLI
```

## 📁 Project Structure

```
├── docker/                 # Docker build files
│   └── wp/                 # WordPress PHP-FPM container
├── nginx/                  # Nginx configuration
├── wp-content/             # WordPress themes & plugins
├── docker-compose.yml      # Main stack definition
├── docker-compose.dev.yml  # Development overrides
├── docker-compose.prod.yml # Production overrides
├── package.json            # Node.js dependencies
├── vite.config.js          # Vite configuration
└── Makefile                # Development commands
```

## 🔧 Configuration

### Environment Variables
Key settings in `.env`:
```bash
PROJECT_NAME=wpdev           # Container prefix
WP_URL=http://localhost:8080 # WordPress URL
XDEBUG_MODE=off             # Enable/disable Xdebug
```

### Production Deployment
Use production configuration:
```bash
docker compose -f docker-compose.yml -f docker-compose.prod.yml up -d
```

## 🆘 Troubleshooting

### Containers won't start
```bash
make reset    # Nuclear reset
make fresh    # Rebuild everything
```

### WordPress issues
```bash
make logs wp     # Check WordPress logs
make shell wp    # Access WordPress container
```

### Clear everything
```bash
make cache       # Clear WordPress + Redis cache
make reset       # Remove all containers and volumes
```

## 🏗️ Tech Stack

| Service | Version | Purpose |
|---------|---------|---------|
| WordPress | 6.6+ | CMS |
| PHP | 8.3 | Runtime |
| Nginx | Alpine | Web server |
| MariaDB | 11 | Database |
| Redis | 7 | Caching |
| Node.js | 20 | Asset building |
| Vite | 5.4+ | Build tool |

---

Happy coding! 🎉

---
Made with ❤️ by [skorar](https://github.com/skorarcapulus) and 🤖 AI