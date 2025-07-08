# 🚀 Taklifa Admin Platform

[![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3+-blue.svg)](https://php.net)
[![Filament](https://img.shields.io/badge/Filament-3.x-orange.svg)](https://filamentphp.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

**Taklifa** is a sophisticated, multi-tenant admin platform built with Laravel 11 and Filament 3. It provides a comprehensive solution for managing businesses, users, products, and services with advanced features like multi-language support, role-based access control, and modular architecture.

## 🌟 Key Features

### 🎛️ **Multi-Panel Administration**
- **Admin Panel**: Super admin dashboard with full system control
- **Company Panel**: Business management interface
- **Base Panel**: Core functionality panel
- Multi-language support (Arabic/English) with RTL support

### 🔐 **Advanced Authentication & Authorization**
- Role-based access control (RBAC) with Spatie Laravel Permission
- Multi-factor authentication support
- Company invitation system
- JWT token-based API authentication

### 📱 **RESTful API with OpenAPI Documentation**
- Auto-generated OpenAPI 3.0.2 specifications
- Swagger UI integration for API testing
- Modular API endpoints across different modules
- Bearer token authentication

### 🏗️ **Modular Architecture**
The platform is built using a modular approach with the following modules:

| Module | Purpose | Features |
|--------|---------|----------|
| **Core** | System foundation | Module management, core entities |
| **Auth** | Authentication | Login, registration, password reset |
| **API** | API services | OpenAPI docs, endpoints management |
| **User** | User management | User profiles, permissions |
| **Geography** | Location services | Countries, cities, regions |
| **Company** | Business management | Company profiles, invitations |
| **Media** | File management | Image/file uploads, storage |
| **Product** | Product catalog | Products, categories, inventory |
| **Cart** | Shopping cart | Cart management, checkout |
| **Rating** | Review system | Product/service ratings |
| **Services** | Service management | Service listings, bookings |
| **Notification** | Messaging | SMS, email, push notifications |
| **Support** | Customer support | Tickets, help system |

### 📧 **Communication Features**
- **SMS Integration**: Deewan SMS service for Saudi Arabia
- **Email Notifications**: Laravel mail system
- **Push Notifications**: Real-time notifications
- **Multi-channel Communication**: Unified messaging system

### 🌐 **Internationalization**
- Full Arabic and English language support
- RTL (Right-to-Left) layout support
- Google Translate integration
- Localized content management

### ☁️ **Cloud-Ready Deployment**
- Laravel Vapor integration for AWS deployment
- DigitalOcean Spaces for file storage
- Optimized for production environments
- Auto-scaling capabilities

## 📋 Prerequisites

- **PHP**: 8.3 or higher
- **Node.js**: 16.x or higher
- **Composer**: 2.x
- **Database**: MySQL 8.0+ or PostgreSQL 13+
- **Redis**: For caching and queues (optional but recommended)

## 🚀 Installation

### 1. Clone the Repository
```bash
git clone https://github.com/your-org/taklifa-admin.git
cd taklifa-admin
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure your database and other services in .env
```

### 4. Database Setup
```bash
# Run migrations
php artisan migrate

# Seed the database with default data
php artisan db:seed

# Refresh modules
php artisan module:refresh
```

### 5. Build Frontend Assets
```bash
# For development
npm run dev

# For production
npm run build
```

### 6. Storage Setup
```bash
# Create storage link
php artisan storage:link

# Optimize Filament
php artisan filament:optimize
```

### Development
```bash
# Start the development server
php artisan serve

# Start the queue worker
php artisan queue:work

# Watch for asset changes
npm run dev
```

### Production
```bash
# Optimize the application
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start the production server (with Octane)
php artisan octane:start --host=0.0.0.0 --port=8000
```

## 📚 API Documentation

The API documentation is automatically generated and available at:
- **Swagger UI**: `http://your-domain/api/docs`
- **OpenAPI Schema**: `http://your-domain/api/docs/v1`

### Authentication

All API endpoints require authentication using Bearer tokens:

```bash
# Login to get a token
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email": "admin@taklifa.com", "password": "#!@taklifa"}'

# Use the token in subsequent requests
curl -X GET http://localhost:8000/api/user \
  -H "Authorization: Bearer YOUR_TOKEN"
```

## 🎨 Admin Panel Access

### Main Admin Panel
- **URL**: `http://localhost:8000/admin`
- **Features**: Complete system management, user management, module control

### Company Panel
- **URL**: `http://localhost:8000/company`
- **Features**: Business management, employee management, service management

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run with coverage
php artisan test --coverage

# Run specific test suite
php artisan test --testsuite=Feature
```

## 📦 Module Management

### List All Modules
```bash
php artisan module:list
```

### Enable/Disable Modules
```bash
# Enable a module
php artisan module:enable ModuleName

# Disable a module
php artisan module:disable ModuleName
```

### Create New Module
```bash
php artisan module:make ModuleName
```

## 🚀 Deployment

### Laravel Vapor (AWS)
```bash
# Install Vapor CLI
composer require laravel/vapor-cli

# Deploy to staging
vapor deploy staging

# Deploy to production
vapor deploy production
```

### Traditional Deployment
```bash
# Build for production
composer install --optimize-autoloader --no-dev
npm run build

# Optimize Laravel
php artisan optimize
php artisan migrate --force
```

## 🔧 Development Commands

### Code Quality
```bash
# Fix code style
./vendor/bin/pint

# Static analysis
./vendor/bin/phpstan analyse

# Generate IDE helpers
php artisan ide-helper:generate
```

### Database
```bash
# Fresh migration with seeding
php artisan migrate:fresh --seed

# Create new migration
php artisan make:migration create_table_name

# Create model with migration
php artisan make:model ModelName -m
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🆘 Support

For support and questions:
- **Email**: admin@taklifa.com
- **Documentation**: Check the `/docs` folder for detailed documentation
- **Issues**: Report bugs and feature requests on GitHub

## 🏆 Acknowledgments

- **Laravel Team** for the amazing framework
- **Filament Team** for the incredible admin panel
- **Spatie** for the excellent Laravel packages
- **All contributors** who help improve this project

---

Made with ❤️ by the Taklifa Team
