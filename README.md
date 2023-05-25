# Symfony Application
Application to Store users as manager/player and manager can sell/buy players.
- Create a user crud with 2 types with enum class which are Manager, Player.
- Create a team crud.
- Created a pivot table name for storing player_id, manager_id, player_price, is_vacant, team_id.

# system requirement
- PHP 8.1.0 or higher;
- Mysql 8.1

# Usage
- Clone the repo
- ``composer install``
- ``cd {directory_name}``
- ``cp .env.test .env``
- set up as DATABASE_URL to env
- ``php bin/console doctrine:migrations:migrate``
- ``php bin/console server:run``

# TBD:
- A form with sell/buy based on player vancancy.
- Create an event + notification, when a user sell/buy.
