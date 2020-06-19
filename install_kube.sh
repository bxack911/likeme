#Info on 29.05.2020

#!/Script for install docker kubernetes and etc. for work with k8s

#First install docker to your linux system.
#I use information from this site https://www.digitalocean.com/community/tutorials/docker-ubuntu-18-04-1-ru
sudo apt update
sudo apt install apt-transport-https ca-certificates curl software-properties-common
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu bionic stable"
sudo apt update
apt-cache policy docker-ce
#!/Look at output, must be output like:
# docker-ce:
#  Installed: (none)
#   Candidate: 18.03.1~ce~3-0~ubuntu
#   Version table:
#      18.03.1~ce~3-0~ubuntu 500
#         500 https://download.docker.com/linux/ubuntu bionic/stable amd64 Packages
sudo apt install docker-ce
sudo systemctl status docker
#!/Look at output, must be output like:
#docker.service - Docker Application Container Engine
#   Loaded: loaded (/lib/systemd/system/docker.service; enabled; vendor preset: enabled)
#   Active: active (running) since Thu 2018-07-05 15:08:39 UTC; 2min 55s ago
#     Docs: https://docs.docker.com
# Main PID: 10096 (dockerd)
#    Tasks: 16
#   CGroup: /system.slice/docker.service
#           ├─10096 /usr/bin/dockerd -H fd://
#           └─10113 docker-containerd --config /var/run/docker/containerd/containerd.toml

#install minikube
#info from https://computingforgeeks.com/how-to-install-minikube-on-ubuntu-debian-linux/
sudo apt-get update
sudo apt-get install apt-transport-https
sudo apt-get upgrade
sudo apt install virtualbox virtualbox-ext-pack
wget https://storage.googleapis.com/minikube/releases/latest/minikube-linux-amd64
chmod +x minikube-linux-amd64
sudo mv minikube-linux-amd64 /usr/local/bin/minikube
#Confirm minikube version
minikube version
#output like:
# minikube version: v1.9.2
# commit: 93af9c1e43cab9618e301bc9fa720c63d5efa393

#install kubectl
curl -LO https://storage.googleapis.com/kubernetes-release/release/`curl -s https://storage.googleapis.com/kubernetes-release/release/stable.txt`/bin/linux/amd64/kubectl
chmod +x ./kubectl
sudo mv ./kubectl /usr/local/bin/kubectl
#check version
kubectl version -o json 
# Output like:
#{
#  "clientVersion": {
#    "major": "1",
#    "minor": "10",
#    "gitVersion": "v1.10.4",
#    "gitCommit": "5ca598b4ba5abb89bb773071ce452e33fb66339d",
#    "gitTreeState": "clean",
#    "buildDate": "2018-06-06T08:13:03Z",
#    "goVersion": "go1.9.3",
#    "compiler": "gc",
#    "platform": "linux/amd64"
#  }
#}
#start minikube
minikube start
#start minikube dashboard. Wait for 5-10 minutes.
minikube dashboard