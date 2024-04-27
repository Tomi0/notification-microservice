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

Start Rabbitmq
```bash
make up
```

Start listening for messages
```bash
make listen
```