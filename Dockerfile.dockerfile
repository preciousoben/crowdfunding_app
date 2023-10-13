# Use an official PHP image as a parent image
FROM php:8.0-fpm

# Set the working directory to /var/www
WORKDIR /var/www

# Copy the current directory contents into the container at /var/www
COPY . .

# Install any needed packages specified in requirements.txt
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev unzip && docker-php-ext-configure gd --with-freetype --with-jpeg && docker-php-ext-install gd pdo pdo_mysql

# Expose port 9000
EXPOSE 9000

# Define your entrypoint
CMD ["php-fpm"]
