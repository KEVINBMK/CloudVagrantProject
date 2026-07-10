# Guide JONATHAN — Cluster 2 (Apache + PHP)

**Branche Git :** `jonathan/cluster2-apache`

## Ton rôle en une phrase

Tu installes **Apache + PHP** sur les 3 machines du Cluster 2 et tu déploies l'application PHP.

---

## Tes machines

| Machine | IP |
|---------|-----|
| cluster2-node1 | 192.168.56.21 |
| cluster2-node2 | 192.168.56.22 |
| cluster2-node3 | 192.168.56.23 |

---

## Tes fichiers (tu es le seul à les modifier)

```
roles/apache/                 ← installer et configurer Apache
roles/php/                    ← installer PHP (coordination avec José)
templates/apache-vhost.conf.j2
playbooks/install_apache.yml
apps/cluster2-apache-app/
group_vars/cluster2.yml
```

> **Note :** Le rôle `php` est partagé avec José. Si José l'a déjà fait, réutilise-le. Sinon, complète-le de la même façon.

---

## Ce que tu dois faire (étape par étape)

### Étape 1 — Aller sur ta branche
```bash
git checkout jonathan/cluster2-apache
```

### Étape 2 — Démarrer les VMs
```bash
vagrant up
```

### Étape 3 — Remplir le rôle `roles/apache/tasks/main.yml`

```yaml
---
- name: Installer Apache
  ansible.builtin.apt:
    name: apache2
    state: present
    update_cache: true

- name: Activer mod_php / libapache2-mod-php
  ansible.builtin.apt:
    name: "libapache2-mod-php{{ php_version }}"
    state: present

- name: Copier le VirtualHost
  ansible.builtin.template:
    src: apache-vhost.conf.j2
    dest: /etc/apache2/sites-available/{{ app_name }}.conf
  notify: Restart apache

- name: Activer le site
  ansible.builtin.command: a2ensite {{ app_name }}
  notify: Restart apache

- name: Démarrer Apache
  ansible.builtin.service:
    name: apache2
    state: started
    enabled: true
```

### Étape 4 — Remplir `playbooks/install_apache.yml`

```yaml
---
- name: Installer Apache et PHP sur Cluster 2
  hosts: cluster2
  become: true
  roles:
    - php
    - apache
```

### Étape 5 — Déployer l'application

Copie `apps/cluster2-apache-app/` vers `/var/www/cluster2` sur chaque nœud.

### Étape 6 — Tester

```bash
ansible-playbook playbooks/install_apache.yml
curl http://192.168.56.21
curl http://192.168.56.22
curl http://192.168.56.23
```

Tu dois voir la page PHP avec le nom du serveur.

### Étape 7 — Envoyer sur GitHub

```bash
git add .
git commit -m "Cluster 2 : Apache + PHP + application"
git push origin jonathan/cluster2-apache
```

Puis ouvre une **Pull Request** vers `main`.

---

## Checklist

- [ ] PHP installé sur cluster2-node1, node2, node3
- [ ] Apache installé et démarré
- [ ] `curl http://192.168.56.21` affiche la page PHP
- [ ] PR ouverte vers `main`
