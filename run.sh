#!/bin/bash

if [[ ! -d "laradock" ]]
then
  git clone https://github.com/Laradock/laradock.git
  cp laradock/env-example laradock/.env

  ## Criar a base de dados no container do postgres
fi

if [[ ! -d "public" ]]
then
  mkdir public
  ln -s blog/public/ public
fi

if [[ ! -f "blog/.env" ]]
  cp blog/.env.example blog/.env
fi

sudo chown -R $(users):$(users) blog/*

cd laradock
docker-compose up -d nginx postgres
