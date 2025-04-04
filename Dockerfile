# Sử dụng PHP + Apache
FROM php:8.3-apache

# Cài đặt các extension PHP cần thiết
RUN docker-php-ext-install pdo pdo_mysql

# Cài đặt mod_rewrite
RUN a2enmod rewrite


# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy toàn bộ mã nguồn vào container
COPY . /var/www/html

# Phân quyền cho thư mục storage và bootstrap
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Mở cổng 80
EXPOSE 80

# Chạy Apache ở foreground
CMD ["apache2-foreground"]