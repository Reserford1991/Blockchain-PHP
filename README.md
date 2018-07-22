# Blockchain-PHP
Simple blockchain technolgy implementation in PHP

Project contains several folders.

frontend - folder contains all frontend code for project (form to upload file).
backend - contains all three backend nodes to encrypt and store files.

In order to make project work, you have to configure routing for frontend and backend.
In case of Ubuntu + Apache it looks like this:

1) Making frontend work:
    1.1) Add "127.0.0.1 blockchain.loc" to etc/hosts file
    
    1.2) Create file etc/apache2/sites-enabled/blockchain.loc.conf
    
    1.3) Add followong code to hte file:
        <VirtualHost *:80>
         ServerAdmin admin@beprogrammer.com
         DocumentRoot /var/www/blockchain.loc/public_html/frontend
         ServerName blockchain.loc
         DirectoryIndex index.php
         ServerAlias www.blockchain.loc
         ErrorLog /var/www/blockchain.loc/logs/error_log
         CustomLog /var/www/blockchain.loc/logs/access_log common
         <Directory /var/www/blockchain.loc/public_html>
         Options Indexes FollowSymLinks
         AllowOverride All
         Order allow,deny
         Allow from all
         </Directory>
         </VirtualHost>
    1.4) type "sudo service apache2 restart" in terminal
    
    1.5) open link "http://blockchain.loc/" in browser to make sure everyting worked out fine
    
2) Making backend work:

    2.1) Add those lines to ect/hosts:
    
    127.0.0.1 blockchain-node-1.loc
    127.0.0.1 blockchain-node-2.loc
    127.0.0.1 blockchain-node-3.loc
    
    2.2) Create files:
    blockchain-node-1.loc.conf
    blockchain-node-2.loc.conf
    blockchain-node-3.loc.conf
    in etc/apache2/sites-enabled folder
    
    2.3) Add:
    
    <VirtualHost *:91>
    ServerAdmin admin@beprogrammer.com
    DocumentRoot /var/www/blockchain.loc/public_html/backend/node-1
    ServerName blockchain.loc
    DirectoryIndex index.php
    ServerAlias www.blockchain.loc
    ErrorLog /var/www/blockchain.loc/logs/error_log
    CustomLog /var/www/blockchain.loc/logs/access_log common
    <Directory /var/www/blockchain.loc/public_html>
    Options Indexes FollowSymLinks
    AllowOverride All
    Order allow,deny
    Allow from all
    </Directory>
    </VirtualHost>
    
    to blockchain-node-3.loc.conf
    
    <VirtualHost *:92>
    ServerAdmin admin@beprogrammer.com
    DocumentRoot /var/www/blockchain.loc/public_html/backend/node-2
    ServerName blockchain.loc
    DirectoryIndex index.php
    ServerAlias www.blockchain.loc
    ErrorLog /var/www/blockchain.loc/logs/error_log
    CustomLog /var/www/blockchain.loc/logs/access_log common
    <Directory /var/www/blockchain.loc/public_html>
    Options Indexes FollowSymLinks
    AllowOverride All
    Order allow,deny
    Allow from all
    </Directory>
    </VirtualHost>
        
    to blockchain-node-3.loc.conf
    
    <VirtualHost *:93>
    ServerAdmin admin@beprogrammer.com
    DocumentRoot /var/www/blockchain.loc/public_html/backend/node-3
    ServerName blockchain.loc
    DirectoryIndex index.php
    ServerAlias www.blockchain.loc
    ErrorLog /var/www/blockchain.loc/logs/error_log
    CustomLog /var/www/blockchain.loc/logs/access_log common
    <Directory /var/www/blockchain.loc/public_html>
    Options Indexes FollowSymLinks
    AllowOverride All
    Order allow,deny
    Allow from all
    </Directory>
    </VirtualHost>
    
    to blockchain-node-3.loc.conf
    
    2.4) Open file etc/apache2/ports.conf and add there:
         
    Listen 91
    Listen 92
    Listen 93
    
    after other Listen directives
    
    2.5) Check if everything works. Visit those URLs in your browser:
        http://localhost:93:91/
        http://localhost:93:92/
        http://localhost:93:93/
        

!!! EVERYTHING WORKS FINE !!!

    
    
