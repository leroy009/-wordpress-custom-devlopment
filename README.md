if you are unable to add and delete plugins and themes

Run ls -la /var/www/html/wordpress/ command to check the ownership of the wp-content directory
AND PERHAPS change it using sudo chown -R www-data:www-data /var/www/html/wordpress/.
