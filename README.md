# CoirFurnitures

A full-stack e-commerce web application for a coconut coir furniture company, built as a final project for IT0041.

## Tech Stack
- Laravel 11
- Blade Templates
- MySQL
- Tailwind CSS

## Features
- Buyer: Browse products, cart, checkout with GCash/BDO/COD, order tracking, profile management
- Seller: Inventory CRUD, order management, sales reports, stock control

## Setup Instructions
1. Clone the repository
2. Run `composer install`
3. Run `npm install && npm run build`
4. Copy `.env.example` to `.env` and configure your database
5. Run `php artisan key:generate`
6. Run `php artisan migrate --seed`
7. Run `php artisan storage:link`
8. Run `php artisan serve`

## Test Accounts
See `test_accounts.txt` (provided separately).

## Disclaimer
For educational purposes only, and no copyright infringement is intended.