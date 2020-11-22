#!/bin/sh

crontab /var/spool/cron/crontabs/app-cron
crond -f &

exec "$@"