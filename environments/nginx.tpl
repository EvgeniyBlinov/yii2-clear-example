server {
    set          $www_path "[:root:]";
    set          $project_name "[:project_name:]";

    [:access_log:]
    [:error_log:]
    ########################################################################

    charset      utf-8;
    client_max_body_size  200M;

    listen       80; ## listen for ipv4
    #listen       1081; ## listen for ipv4
    #listen       [::]:80 default_server ipv6only=on; ## listen for ipv6

    server_name  "$project_name.lo";
    root         "$www_path";

    ######################  MAIN   #########################################
    location / {
        root  "$www_path/frontend/web";
        try_files  $uri /frontend/web/index.php?$args;

        # avoiding processing of calls to non-existing static files by Yii
        location ~ \.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar)$ {
            access_log  off;
            expires  360d;

            try_files  $uri =404;
        }
    }
    ######################  MAIN   #########################################

    ######################  ADMIN  #########################################
    location /admin {
        root  "$www_path/backend/web";
        rewrite  ^(/admin)/$ $1 permanent;
        try_files  $uri /backend/web/index.php?$args;
    }

    # avoiding processing of calls to non-existing static files by Yii
    location ~ ^/admin/(.+\.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar|woff|woff2|svg|eot))$ {
        access_log  off;
        expires  360d;

        rewrite  ^/admin/(.+)$ /backend/web/$1 break;
        rewrite  ^/admin/(.+)/(.+)$ /backend/web/$1/$2 break;
        try_files  $uri =404;
    }
    ######################  ADMIN  #########################################

    ######################  API  ###########################################
    location /api {
        root  "$www_path/api/web";
        rewrite  ^(/api)/$ $1 permanent;
        try_files  $uri /api/web/index.php?$args;
    }

    # avoiding processing of calls to non-existing static files by Yii
    location ~ ^/api/(.+\.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar|woff|woff2|svg|eot))$ {
        access_log  off;
        expires  360d;

        rewrite  ^/api/(.+)$ /api/web/$1 break;
        rewrite  ^/api/(.+)/(.+)$ /api/web/$1/$2 break;
        try_files  $uri =404;
    }
    ######################  API  ###########################################

    location ~ \.php$ {
        include  fastcgi_params;
        # check your /etc/php5/fpm/pool.d/www.conf to see if PHP-FPM is listening on a socket or port
        fastcgi_pass  "unix:/var/run/$project_name-php5-fpm.sock"; ## listen for socket
        # fastcgi_pass  127.0.0.1:9000; ## listen for port
        fastcgi_param  SCRIPT_FILENAME $document_root$fastcgi_script_name;
        try_files  $uri =404;
    }
    #error_page  404 /404.html;

    location = /requirements.php {
        deny all;
    }

    location ~ \.(ht|svn|git) {
        deny all;
    }
}
