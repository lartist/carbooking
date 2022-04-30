#Required stack
1. php 8.1
2. symfony cli (optional)
3. docker
4. composer
5. yarn

#Environment variable
Use default ones in .env or create .env.local and override as you need
Don't forget to configure a valid MAILER_DSN so that you can receive automatic emails.

#Installation
1. Run composer install
2. yarn install
3. yarn encore prod
4. docker compose up --remove-orphans -d
5. bin/console doctrine:migrations:migrate
6. bin/console doctrine:fixtures:load --no-interaction --append
7. symfony serve

#Default user account
Since you ran fixtures command you can log in as (user/password)
1. admin@carbooking.com/admin (ROLE_ADMIN)
2. user@carbooking.com/user (ROLE_USER)

You can create a new user account by registering from '/' url as well.

Enjoy!
