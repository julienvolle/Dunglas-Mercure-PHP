start: ## start demo
start:
	docker-compose up -d --build
	@echo "PHP listening on http://localhost:8080/"
	@echo "Mercure listening on http://localhost:3000/"
.PHONY: start

stop: ## stop demo
stop:
	docker-compose down
.PHONY: stop

.DEFAULT_GOAL := help
help:
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
.PHONY: help
