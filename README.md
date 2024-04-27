# Notification microservice
Notification microservice is a microservice that sends notifications to users.

# Start server for development

Build the image
```bash
make build
```

Start Rabbitmq
```bash
make up
```

Start listening for messages
```bash
make listen
```