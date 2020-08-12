docker-up:
	docker-compose up -d

docker-down:
	docker-compose down

docker-build:
	docker-compose up --build -d

bash:
	docker-compose exec php-cli bash

migrate:
	docker-compose exec php-cli php artisan migrate
