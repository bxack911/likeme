kubectl apply -f apache-deployment.yaml,apache-service.yaml,db-deployment.yaml,db-service.yaml,phpmyadmin-deployment.yaml,phpmyadmin-service.yaml,redis-deployment.yaml,redis-service.yaml,elasticsearch-deployment.yaml,elasticsearch-service.yaml,kibana-deployment.yaml,kibana-service.yaml,logstash-deployment.yaml,logstash-service.yaml
sudo sysctl -w vm.max_map_count=262144