#!/bin/bash

if [[ ! -d "laradock" ]]
then
  git clone https://github.com/Laradock/laradock.git
  cp env-example .env

  ## Criar a base de dados no container do postgres
fi

if [[ ! -d "public" ]]
  mkdir public
  ln -s blog/public/ public
fi

sudo chown -R $(users):$(users) blog/*

cd laradock
docker-compose up -d nginx postgres