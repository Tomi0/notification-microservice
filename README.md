# Notification microservice
Notification microservice is a microservice that sends notifications to users.

# Start server for development

Build the image
```bash
make build
```

Copy .env.local.example to .env.local
```bash
cp .env.local.example .env.local
```

Start microservice
```bash
make start
```

Run tests
```bash
make test
```

For stopping microservice
```bash
make stop
```