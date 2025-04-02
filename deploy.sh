#!/bin/bash

source .env

#sshpass -p "$SSH_PRIVATE_KEY" ssh "$SSH_USERNAME@$SSH_HOST" "cd $SSH_PATH &&
#git pull &&
#composer install &&
#php artisan migrate --force &&
#php artisan config:cache &&
#curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.1/install.sh| bash &&
#export NVM_DIR="$HOME/.nvm"
#[ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh"
#nvm install 17.9.1 &&
#nvm use 17.9.1 &&
#yarn install && yarn build"
#&&
#php artisan inertia:start-ssr"

## Build the project locally because no NODE on Infomaniak
yarn install
yarn build

# Copy the 'dist' directory to the remote server
sshpass -p "$SSH_PRIVATE_KEY" scp -r public/build "$SSH_USERNAME@$SSH_HOST:$SSH_PATH/public/"
