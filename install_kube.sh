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

sudo apt-get update
sudo apt-get install apt-transport-https
sudo apt-get upgrade

#install kubectl
curl -LO https://storage.googleapis.com/kubernetes-release/release/`curl -s https://storage.googleapis.com/kubernetes-release/release/stable.txt`/bin/linux/amd64/kubectl
chmod +x ./kubectl
sudo mv ./kubectl /usr/local/bin/kubectl
#install kvm2 driver for k8s
sudo apt install cpu-checker && sudo kvm-ok
sudo kvm-ok

sudo apt install libvirt-clients libvirt-daemon-system qemu-kvm \
    && sudo usermod -a -G libvirt $(whoami) \
    && newgrp libvirt

sudo virt-host-validate
#check version kubctl
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

#install microk8s
#if you have-t snap, install it.
# sudo rm /etc/apt/preferences.d/nosnap.pref
# sudo apt install snapd
sudo snap install microk8s --classic
microk8s status --wait-ready
#start microk8s
microk8s enable dashboard dns registry istio
microk8s kubectl get all --all-namespaces
#start minikube dashboard. Wait for 5-10 minutes.
microk8s dashboard-proxy