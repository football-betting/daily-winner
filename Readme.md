# **Daily-Winner**

---

### Setup project:
- please make sure to have amqp-1.11.0beta or higher installed locally
- `composer install`
- `docker-compose up -d`
- `bash init.sh`

---

### Before pushing:
- Execute following commands without getting any errors:
    - `php vendor/bin/phpunit`
    - `vendor/bin/infection --only-covered --min-msi=100`
    - `vendor/bin/psalm`

---

### Execute Command:
- to get all matches from the European Championship
    - `bin/console football:matches`
- to get only live matches from the European Championship
    - `bin/console football:matches --live`
    
---

### RabbitMq
- Start container:
    - `docker-compose start`
- Stop container:
    - `docker-compose stop`
- Admin Panel:
    - http://localhost:15672
- Messenges are published to rabbitMq as Json:
```json
{"event":"match.api","data":{"matchId":"2021-06-11:1900:TR-IT","team1":"TR","team2":"IT","matchDatetime":"2021-06-11 19:00"}}
```
