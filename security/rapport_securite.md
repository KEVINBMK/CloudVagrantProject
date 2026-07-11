# Rapport de sécurité

## Projet
CloudVagrantProject

## Objectif

Ce projet met en œuvre une infrastructure automatisée avec Vagrant et Ansible afin de renforcer la sécurité d'un environnement Linux.

## Mesures de sécurité appliquées

### Pare-feu UFW

- Activation du pare-feu UFW
- Autorisation des ports :
  - SSH (22)
  - HTTP (80)
  - HTTPS (443)
- Test d'ouverture du port 8080
- Suppression du port 8080 après validation

### Outils de sécurité installés

- Nmap
- Nikto
- Lynis

### Vérification

Les règles UFW ont été vérifiées avec :

```bash
sudo ufw status numbered
```

Les playbooks Ansible ont été exécutés avec succès.

## Résultats obtenus

### Nmap

Les scans ont été exécutés sur :

- 192.168.56.11
- 192.168.56.21

Les machines répondent mais filtrent les requêtes ICMP, ce qui explique le message :


### Nikto

Nikto a été exécuté sur les deux serveurs.

Aucun serveur Web n'a été détecté sur le port 80 au moment du test.

### Lynis

Lynis est correctement installé et fonctionne.

L'audit complet peut être lancé avec :

```bash
sudo lynis audit system

## Conclusion

L'environnement est correctement sécurisé grâce à l'automatisation avec Ansible.
Les ports inutiles sont supprimés et les outils d'audit sont installés.