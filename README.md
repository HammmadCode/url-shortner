# URL Shortener Application

## Overview
This is a full-stack URL shortener web application built with Laravel. Users can shorten long URLs, track analytics (clicks, locations, devices), and manage their shortened links through an intuitive dashboard.

## Features
- **User Authentication:** Register, login, and secure access to dashboard.
- **URL Shortening:** Generate short URLs, with optional custom codes.
- **Analytics Tracking:** View IP address, browser info, location, and timestamp for clicks.
- **User Dashboard:** Manage URLs and view detailed analytics.
- **Charts:** Visualize analytics data using Chart.js.
- **Link Expiry:** Set expiry dates for short URLs.
- **Custom Branding:** Custom favicon and responsive design.

## Bonus Features
- Docker setup for deployment.

## Setup Instructions
1. **Clone Repository:**
   ```bash
   git clone https://github.com/HammmadCode/url-shortner.git
   cd url-shortener

## Start the Redis Server 
- find you redis server normaly in the local-server\bin\redis\
- here find you redis exec file and start this before run the project

## Install Dependencies
- composer install
- npm install && npm run dev

## Migrate Database:
- php artisan migrate

## Run the Application:
1. **Using the artisan:**
- php artisan serve

2. **Use Docker**
- docker-compose up -d
