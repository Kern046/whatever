server {
  listen 80;

  server_name local.battle-reenactor.com;

  access_log /var/log/nginx/battle_reenactor.access.log;
  error_log /var/log/nginx/battle_reenactor.error.log;

  merge_slashes on;

  root /srv/app/public;

  location / {
      # try to serve file directly, fallback to app.php
      try_files $uri /index.php$is_args$args;
  }

  location ~ ^/index\.php(/|$) {
      fastcgi_pass battle_reenactor_app:9000;
      fastcgi_split_path_info ^(.+\.php)(/.*)$;
      include fastcgi_params;
      fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
      fastcgi_param DOCUMENT_ROOT $realpath_root;
  }

  # return 404 for all other php files not matching the front controller
  # this prevents access to other php files you don't want to be accessible.
  location ~ \.php$ {
      return 404;
  }
}