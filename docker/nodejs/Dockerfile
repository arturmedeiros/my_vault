FROM node:16

WORKDIR /app

RUN npm i -g @quasar/cli

RUN rm -rf dist

# Copy package.json and package-lock.json to the container
COPY /frontend/package*.json ./

COPY /frontend .

RUN yarn install

RUN quasar build -m spa

CMD ["quasar", "serve", "dist/spa", "--history"]

EXPOSE 4000 3000 8080
