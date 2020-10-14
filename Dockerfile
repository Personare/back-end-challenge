FROM composer:latest as builder

WORKDIR /app

COPY composer.* ./
RUN composer install --no-interaction --optimize-autoloader --no-dev --no-scripts

FROM php:cli-alpine

WORKDIR /app

COPY . .
COPY --from=builder /app .

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000", "index.php"]
