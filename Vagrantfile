# -*- mode: ruby -*-
# TP Cloud Computing — Infrastructure Vagrant (7 machines)
# Technologies : Vagrant + VirtualBox + Ansible

Vagrant.configure("2") do |config|
  # Image Ubuntu 22.04 LTS (compatible VirtualBox)
  config.vm.box = "ubuntu/jammy64"

  # Configuration commune à toutes les machines
  config.vm.provider "virtualbox" do |vb|
    vb.memory = 1024
    vb.cpus = 1
  end

  # Clé SSH Vagrant (utilisée par Ansible)
  config.ssh.insert_key = false

  # Définition des machines : nom, IP privée, hostname
  machines = {
    "master"         => { ip: "192.168.56.10", hostname: "master" },
    "cluster1-node1" => { ip: "192.168.56.11", hostname: "cluster1-node1" },
    "cluster1-node2" => { ip: "192.168.56.12", hostname: "cluster1-node2" },
    "cluster1-node3" => { ip: "192.168.56.13", hostname: "cluster1-node3" },
    "cluster2-node1" => { ip: "192.168.56.21", hostname: "cluster2-node1" },
    "cluster2-node2" => { ip: "192.168.56.22", hostname: "cluster2-node2" },
    "cluster2-node3" => { ip: "192.168.56.23", hostname: "cluster2-node3" }
  }

  machines.each do |name, opts|
    config.vm.define name do |node|
      node.vm.hostname = opts[:hostname]

      # Réseau privé VirtualBox (host-only)
      node.vm.network "private_network", ip: opts[:ip]

      # Provisionnement minimal : mise à jour des paquets
      # Toute configuration avancée passe par Ansible
      node.vm.provision "shell", inline: <<-SHELL
        export DEBIAN_FRONTEND=noninteractive
        apt-get update -qq
        apt-get install -y -qq python3 python3-apt
      SHELL
    end
  end
end
