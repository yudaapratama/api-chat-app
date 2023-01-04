
# Chat Api

simple chat api for web using laravel.


## Requirements

- php v.8+
## Environment Variables

To run this project, you will need to modify the following environment variables in .env file

`PUSHER_APP_ID`

`PUSHER_APP_KEY`

`PUSHER_APP_SECRET`

`PUSHER_APP_CLUSTER`

get credential from [pusher](https://pusher.com)


## Installation

Install on local computer, make sure set the database in .env file

```bash
  git clone https://github.com/yudaapratama/api-chat-app.git
  cd api-chat-app
  cp .env.example .env
  composer update
  php artisan migrate:fresh --seed
  php artisan serve
```
default user :

```
username : john@mail.com
password : john@123

username : doe@mail.com
password : doe@123
```

    
## Documentation

[Documentation](https://documenter.getpostman.com/view/6769748/2s8Z72VrRq)


## Example Listen Event on Front-end

Listen event using [Laravel Echo](https://github.com/laravel/echo)
```
Echo.private(`chat-${this.room.id}`).listen(
    "PrivateChat",
    e => {
        this.chats.push({ 
          message: e.content, 
          type: e.type, 
          send_at: "Just Now" 
        });
    }
);

```