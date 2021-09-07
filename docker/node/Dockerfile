FROM node:alpine

# Create a work directory
RUN mkdir -p /var/www/frontend

# Set up work directory
WORKDIR /var/www/frontend

# Install  dependencies via apk
RUN apk update && apk upgrade

# Configure host
ENV HOST 0.0.0.0

# Init command
CMD ["sh", "-c", "npm install && npm run dev"]