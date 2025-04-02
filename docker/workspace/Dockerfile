FROM debian:12-slim
LABEL authors="Mipam Guillot"

WORKDIR /var/www/html

ENV DEBIAN_FRONTEND noninteractive
ENV TZ=UTC

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Basic tools
RUN apt-get update  && \
    apt-get install -y \
    gnupg gosu \
    curl wget \
    software-properties-common ca-certificates lsb-release apt-transport-https \
    zip unzip jq \
    git sqlite3 python3 \
    supervisor \
    nano vim \
    libcap2-bin \
    libpng-dev \
    sshpass

# PHP Repository
RUN echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list
RUN wget -qO - https://packages.sury.org/php/apt.gpg | apt-key add -

# PHP Installation + Modules
ARG PHP_VERSION=8.2
ENV PHP_VERSION ${PHP_VERSION}

RUN apt-get update && apt-get install -y \
    php${PHP_VERSION}-cli \
    php${PHP_VERSION}-dev \
    php${PHP_VERSION}-mysql \
    php${PHP_VERSION}-pgsql \
    php${PHP_VERSION}-sqlite3 \
    php${PHP_VERSION}-redis \
    php${PHP_VERSION}-memcached \
    php${PHP_VERSION}-curl \
    php${PHP_VERSION}-gd \
    php${PHP_VERSION}-imagick \
    php${PHP_VERSION}-mbstring \
    php${PHP_VERSION}-readline \
    php${PHP_VERSION}-tokenizer \
    php${PHP_VERSION}-fileinfo \
    php${PHP_VERSION}-bcmath \
    php${PHP_VERSION}-ctype \
    php${PHP_VERSION}-xml \
    php${PHP_VERSION}-dom \
    php${PHP_VERSION}-zip \
    php${PHP_VERSION}-soap \
    php${PHP_VERSION}-intl \
    php${PHP_VERSION}-msgpack \
    php${PHP_VERSION}-igbinary \
    php${PHP_VERSION}-imap \
    php${PHP_VERSION}-ldap \
    php${PHP_VERSION}-swoole \
    php${PHP_VERSION}-pcov \
    php${PHP_VERSION}-xdebug

RUN update-alternatives --set php /usr/bin/php${PHP_VERSION}
RUN setcap "cap_net_bind_service=+ep" /usr/bin/php${PHP_VERSION}

# Composer
ARG COMPOSER_VERSION=2.6.5
RUN php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer --version=${COMPOSER_VERSION}

# Yarn
RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | gpg --dearmor | tee /usr/share/keyrings/yarnkey.gpg > /dev/null
RUN echo "deb [signed-by=/usr/share/keyrings/yarnkey.gpg] https://dl.yarnpkg.com/debian/ stable main" > /etc/apt/sources.list.d/yarn.list
RUN apt-get update && apt-get install -y yarn

# PostgreSQL and MySQL clients
RUN apt-get update && apt-get install -y postgresql-client default-mysql-client

# COSMOS user configuration
ARG WWWGROUP=1000
ENV WWWGROUP ${WWWGROUP}
ARG WWWUSER=1000
ENV WWWUSER ${WWWUSER}

RUN groupadd --force -g $WWWGROUP cosmos
RUN useradd -ms /bin/bash --no-user-group -g $WWWGROUP -u $WWWUSER cosmos

# Add Cosmos user as /var/www/html owner
RUN chown -R cosmos:cosmos /var/www/html

# ZSH shell
RUN apt-get install zsh -y

USER cosmos
SHELL ["/bin/bash", "--login", "-c"]

# NVM
RUN mkdir /home/cosmos/.nvm
ARG NODE_VERSION=20
ENV NVM_DIR /home/cosmos/.nvm
ARG NVM_VERSION=0.39.5

RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v${NVM_VERSION}/install.sh | bash
RUN source $NVM_DIR/nvm.sh \
    && nvm install $NODE_VERSION \
    && nvm alias default $NODE_VERSION \
    && nvm use default

## Oh My Zsh
RUN sh -c "$(curl -fsSL https://raw.githubusercontent.com/ohmyzsh/ohmyzsh/master/tools/install.sh) --keep-zshrc" && \
    git clone https://github.com/zsh-users/zsh-autosuggestions /home/cosmos/.oh-my-zsh/custom/plugins/zsh-autosuggestions && \
    git clone https://github.com/jessarcher/zsh-artisan.git /home/cosmos/.oh-my-zsh/custom/plugins/artisan && \
    sed -i -r 's/^plugins=\(.*?\)$/plugins=(zsh-autosuggestions git composer laravel)/' /home/cosmos/.zshrc && \
    sed -i '1iZSH_AUTOSUGGEST_BUFFER_MAX_SIZE=20' /home/cosmos/.zshrc && \
    sed -i '1iZSH_AUTOSUGGEST_STRATEGY=(history completion)' /home/cosmos/.zshrc && \
    sed -i '1iZSH_AUTOSUGGEST_USE_ASYNC=1' /home/cosmos/.zshrc && \
    sed -i '1iTERM=xterm-256color' /home/cosmos/.zshrc

USER root

# Image cleaning
RUN apt-get -y autoremove && apt-get -y clean
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Config files

#ENV MT_CONFIGS_PATH /home/cosmos/configs
#COPY --chown=cosmos:cosmos configs $MT_CONFIGS_PATH
#RUN find $MT_CONFIGS_PATH -name "*.sh" -type f -print0 | xargs -0 chmod +x

COPY .bash_aliases /home/cosmos/.bash_aliases
COPY .bashrc_extension /home/cosmos/.bashrc_extension
COPY .zshrc_extension /home/cosmos/.zshrc_extension

RUN cat /home/cosmos/.bashrc_extension >> /home/cosmos/.bashrc
RUN rm /home/cosmos/.bashrc_extension

RUN cat /home/cosmos/.zshrc_extension >> /home/cosmos/.zshrc
RUN rm /home/cosmos/.zshrc_extension

COPY supervisord.conf /etc/supervisor/supervisord.conf

COPY php.ini /etc/php/${PHP_VERSION}/cli/conf.d/99-cosmos.ini

# Custom php executable to run php as cosmos user
COPY mtphp /usr/bin/mtphp
RUN chmod +x /usr/bin/mtphp

COPY start-container /usr/local/bin/start-container
RUN chmod +x /usr/local/bin/start-container

EXPOSE 80 9001

ENTRYPOINT ["start-container"]
