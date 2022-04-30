#Required stack
1. php 8.1
2. mysql 5.7
3. symfony cli (optional)

# Environment variable
Use default ones in .env or create .env.local and override as you need
Don't forget to configure a valid MAILER_DSN so that you can receive automatic emails.

#Installation
1. Clone the project
2. Run composer install
3. yarn install
4. yarn encore prod
5. bin/console doctrine:database:create
6. bin/console doctrine:migrations:migrate
7. bin/console doctrine:fixtures:load --no-interaction --append
8. symfony run

#Default user account
Since you ran fixtures command you can log in as (user/password)
1. admin@carbooking.com/admin (ROLE_ADMIN)
2. user@carbooking.com/user (ROLE_USER)

You can create a new user account by registering from '/' url as well.

Enjoy!
