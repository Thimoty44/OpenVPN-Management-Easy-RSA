# OpenVPN-Management-Easy-RSA

Welcome in my repository of OpenVPN Management is a web solution to mane your OpenVPN server who work with easy-rsa on debian and ubuntu linux system.

I am Thimoty I studdy in networ and system and this is my first website developped in php. I made it to make management of openvpn server with easy rsam ore easy to manage. If you have feedback I will take it. And if you find out bug tell me. Hope this management interface gonna help.

If you want support my work you can also donate on my paypal :
https://www.paypal.com/paypalme/thimoty44?country.x=FR&locale.x=fr_FR

Requirements
Mysql or mariadb
Apache or nginx
Php
PHPMAiler

Installation with nginx, MariaDB and PHP.

Installation and configuration MariaDB

We install the following package
apt update
apt install mariadb-server mariadb-client

We do the first configuration of mariadb said yes for everything Mariadb gonna ask to change password of root mariadb account change it
mysql_secure_installation

We go in mariadb (gonna ask for root password)
mysql -u root -p

We create database with 
CREATE DATABASE `NAMEOFDATABASE`;

We create a user for teh database
CREATE USER 'USERNAME'@localhost IDENTIFIED BY 'PASSWORD';

We give right to acces mysql to our user with the following
GRANT USAGE ON *.* TO 'USERNAME'@localhost IDENTIFIED BY 'PASSWORD';

We give right on database to our user
GRANT ALL privileges ON `DATABSENAME`.* TO 'USERNAME'@localhost;

We apply right on mariadb
FLUSH PRIVILEGES;

We exit mariadb
exit;

We import our file database
mysql -u USERNAME -p DATABASENAME < openvpn.sql

Installation nginx and php
We install nginx
apt install nginx

We install php
apt install php

We install required modules for php
apt install -y php-common php-cli php-mysql php-curl php-fpm php-gd php-intl php-mbstring php-soap php-xml php-xmlrpc php-zip php-opcache php-readline php-json

Configuration of website
vim /etc/nginx/sites-enabled/openvpn.conf

Insert this config and replace the "_" at servname by the address of your website like openvpn.com

server {
       listen 80;
       listen [::]:80;

        root /var/www/html;

        index index.php index.html index.htm;

        server_name _;

        location / {
                try_files $uri $uri/ =404;
        }

        location ~* \.php$ {
                fastcgi_index   index.php;
                fastcgi_pass    127.0.0.1:9000;
                include         fastcgi_params;
                fastcgi_param   SCRIPT_FILENAME    $document_root$fastcgi_script_name;
                fastcgi_param   SCRIPT_NAME        $fastcgi_script_name;
        }

}

We delete the default config of nginx
rm /etc/nginx/sites-enabled/default

We verify our configuration nginx is good
nginx -t

We restart nginx 
systemctl restart nginx

We check status of nginx
systemctl status nginx

We put all our website file in /var/www/html
cp -R pathtothedirectory /var/www/html

We donwload php mailer on github
https://github.com/PHPMailer/PHPMailer

We put the folder PHPMailer in oru website
cp -R PATHTOOURFOLDERPHPMAILER /var/www/html/

We put right on the website
chown -R www-data:www-data /var/www/html

We go on our website and we check if php work well
http://yourwebsite.com/test.php

If a page with informations about php is showed we are good :)

We give permission to easy rsa to be acces by our website with
chown -R www-data PATHTOYOUREASYRSAFOLDER

We give him execution right to the group www-data for make able the website to create certificate
chmod -R g+x PATHTOYOUREASYRSAFOLDER

We do the same for our ipp.txt who show ip of the vpn
chown www-data PATHTOYOURIPPFILE
chmod g+x PATHTOYOURIPPFILE

We install sudo
apt install sudo
We add right to www-data to manage our vpn service

add the following lines after "root    ALL=(ALL:ALL) ALL" in /etc/sudoers :
www-data ALL=(ALL) NOPASSWD: /bin/systemctl restart NAMEOFOPENVPNSERVICE
www-data ALL=(ALL) NOPASSWD: /bin/systemctl start NAMEOFOPENVPNSERVICE
www-data ALL=(ALL) NOPASSWD: /bin/systemctl stop NAMEOFOPENVPNSERVICE

We go to http://yourwebsite.com/install.php
We indicate evrry information needed for configure the website and here we go our website is ready just test every feature of the website to be sure that work 
Default credantials are :
username : admin
password : admin
