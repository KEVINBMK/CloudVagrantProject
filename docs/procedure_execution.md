# Procédure d'exécution

## Étape 1 — Prérequis

Vérifier l'installation de VirtualBox, Vagrant et Ansible sur la machine hôte.

## Étape 2 — Création des VMs

```bash
cd tp-cloud-vagrant-ansible
vagrant up
```

Durée estimée : 10–20 minutes (première exécution, téléchargement de l'image Ubuntu).

## Étape 3 — Vérification

```bash
# État des machines
vagrant status

# Test SSH sur le master
vagrant ssh master

# Test Ansible (depuis le dossier du projet)
ansible all -m ping
```

## Étape 4 — Déploiement Ansible

```bash
ansible-playbook playbooks/site.yml
```

## Étape 5 — Tests fonctionnels

```bash
# Cluster 1 (Nginx)
curl http://192.168.56.11
curl http://192.168.56.12
curl http://192.168.56.13

# Cluster 2 (Apache)
curl http://192.168.56.21
curl http://192.168.56.22
curl http://192.168.56.23
```

## Étape 6 — Réinitialisation complète

```bash
vagrant destroy -f
vagrant up
ansible-playbook playbooks/site.yml
```

## Dépannage

| Problème | Solution |
|----------|----------|
| VM ne démarre pas | Vérifier que VirtualBox est installé et que la virtualisation est activée dans le BIOS |
| `ansible ping` échoue | Attendre la fin du provisionnement shell, puis relancer |
| IP inaccessible | Vérifier le réseau host-only VirtualBox (192.168.56.0/24) |
| Clé SSH introuvable | Lancer `vagrant up` au moins une fois pour générer `.vagrant/` |
