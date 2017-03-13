# sync-dev-to-prod-FOR-REAL.sh

read -r -p "Would you really like to reset THE PRODUCTION DATABASE and send up the latest from dev? [y/N] " response
if [[ $response =~ ^([yY][eE][sS]|[yY])$ ]]
then
    wp @development db export - > sql-dump-development.sql
    scp sql-dump-development.sql root@198.58.113.100:/srv/www/example.com/current

    wp @production db export just-in-case.sql
    wp @production db reset --yes

    wp @production db import sql-dump-development.sql
    wp @production search-replace http://lawrencehumane.dev  http://lhs.nuleafs.com
    scp -r web/app/uploads/ root@198.58.113.100:/srv/www/lhs.nuleafs.com/shared
else
    exit 0
fi
