UID = $(shell id -u)
GID = $(shell id -g)
docker-exec = docker run --rm -v $(PWD):/usr/app -w /usr/app runroom_samples_bundle $(1)

.PHONY: build halt destroy provision ssh composer-update composer-install composer-normalize phpstan psalm php-cs-fixer phpunit phpunit-coverage rector lint-qa

up:
	docker build -t runroom_samples_bundle .
	docker run -d -v $(PWD):/usr/app --name runroom_samples_bundle runroom_samples_bundle
.PHONY: up

halt:
	docker stop runroom_samples_bundle
.PHONY: halt

destroy:
	docker stop runroom_samples_bundle && docker rm runroom_samples_bundle
.PHONY: destroy

build: halt destroy
	docker build --build-arg UID=$(UID) --build-arg GID=$(GID) -t runroom_samples_bundle .
.PHONY: build

provision: composer-install

down:
	docker stop runroom_samples_bundle && docker rm runroom_samples_bundle
.PHONY: down

ssh:
	docker exec -it runroom_samples_bundle sh
.PHONY: ssh

composer-update:
	$(call docker-exec,composer update --optimize-autoloader)
.PHONY: composer-update

composer-install:
	$(call docker-exec,composer install --optimize-autoloader)
.PHONY: composer-install

composer-normalize:
	$(call docker-exec,composer normalize)
.PHONY: composer-normalize

phpstan:
	$(call docker-exec,composer phpstan)
.PHONY: phpstan

psalm:
	$(call docker-exec,composer psalm -- --stats)
.PHONY: psalm

php-cs-fixer:
	$(call docker-exec,composer php-cs-fixer)
.PHONY: php-cs-fixer

phpunit:
	$(call docker-exec,phpunit)
.PHONY: phpunit

phpunit-coverage:
	$(call docker-exec,phpunit --coverage-html /usr/app/coverage)
.PHONY: phpunit-coverage

rector:
	$(call docker-exec,composer rector)
.PHONY: rector

lint-qa:
	$(call docker-exec,composer php-cs-fixer)
	$(call docker-exec,phpunit --coverage-html /usr/app/coverage)
	$(call docker-exec,composer phpstan)
	$(call docker-exec,composer psalm -- --stats)
	$(call docker-exec,composer rector)
	$(call docker-exec,composer normalize)
	$(call docker-exec,bin/console lint:container)
	$(call docker-exec,bin/console lint:twig src)
	$(call docker-exec,bin/console lint:xliff src)
	$(call docker-exec,bin/console lint:yaml src)
.PHONY: lint-qa
