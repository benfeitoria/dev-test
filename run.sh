#!/bin/bash

if [[ ! -d "laradock" ]]
then
  git clone https://github.com/Laradock/laradock.git
  cp laradock/env-example laradock/.env
fi

if [[ ! -d "public" ]]
then
  ln -s blog/public/ public
fi

if [[ ! -d "blog/storage/framework" ]]
then
  mkdir -p blog/storage/framework/cache/data
  mkdir -p blog/storage/framework/sessions
  mkdir -p blog/storage/framework/views
fi

if [[ ! -f "blog/.env" ]]
then
  cp blog/.env.example blog/.env
fi

sudo chown -R $(users):$(users) blog/*

cd laradock
docker-compose up -d nginx postgres
