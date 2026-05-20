FROM node:20-slim

WORKDIR /code

ADD package*.json ./

RUN npm install

COPY . ./

ENTRYPOINT ["npm"]
