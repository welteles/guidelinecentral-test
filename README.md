
# Project Setup Instructions

Follow the steps below to set up the project environment.

---

## 1. Install PHP Dependencies

```bash
composer install
```

---

## 2. Install Node.js Dependencies

```bash
npm i
```

---

## 3. Link Storage for Images

```bash
php artisan storage:link
```

---

## 4. Run Seeders (in correct order)

```bash
php artisan seed:product-types
```
> Generate and save initial product types using `ProductTypeService`

```bash
php artisan seed:products
```
> Generate and save 20 sample products using `ProductService` and Faker

```bash
php artisan seed:product-images
```
> Download and attach random product images from Picsum to existing products

---

## 5. Start Laravel Server

```bash
php artisan serve
```

---

## 6. Start Vite Development Server

```bash
npm run dev
```
