# Create RabbitMQ vhosts
echo "Create RabbitMQ vhosts and assign them to user"
docker exec daily_winner_rabbitmq /bin/sh -c "rabbitmqctl add_vhost daily.winner.to.app"
docker exec daily_winner_rabbitmq /bin/sh -c "rabbitmqctl set_permissions -p daily.winner.to.app admin '.*' '.*' '.*'"
