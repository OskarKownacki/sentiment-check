# Sentiment check
Sentiment check is a tool for browsing news from various providers. It uses **NewsAPI** to fetch news, and **IBM Watson Natural Language Understanding** to check their sentiment.

## Requirements
For the app to run locally, docker, WSL if you're using Windows, and access to terminal is required. 

## Dependencies 
There is package-lock.json file included in the project. Just run ```composer install && npm install```, and they all should be installed. 

## Installation 
To install the project on your local machine, you first neet to clone the repository to your local machine. Than, copy the .env.example file and name it ".env". In your new .env file you will see a position named "NEWSAPI_KEY". Make it equal to your NewsAPI key, than run 

````/vendor/bin/sail up```` 

from the project root directory. Next run

````sail artisan queue:work rabbitmq```` 

and you're done!