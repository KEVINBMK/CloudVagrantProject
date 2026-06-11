# Guide JOSÉ — Cluster 1 (Nginx + PHP)

**Branche Git :** `jose/cluster1-nginx`

## Ton rôle en une phrase

Tu installes **Nginx + PHP** sur les 3 machines du Cluster 1 et tu déploies l'application PHP.

---

## Tes machines

| Machine | IP |
|---------|-----|
| cluster1-node1 | 192.168.56.11 |
| cluster1-node2 | 192.168.56.12 |
| cluster1-node3 | 192.168.56.13 |

---

## Tes fichiers (tu es le seul à les modifier)

```
roles/nginx/                  ← installer et configurer Nginx
roles/php/                    ← installer PHP (coordination avec Jonathan)
templates/nginx.conf.j2       ← config Nginx (ou roles/nginx/templates/)
playbooks/install_nginx.yml   ← playbook qui appelle le rôle nginx
apps/cluster1-nginx-app/      ← ton application PHP
group_vars/cluster1.yml       ← variables du cluster 1
```

---

## Ce que tu dois faire (étape par étape)

### Étape 1 — Aller sur ta branche
```bash
git checkout jose/cluster1-nginx
```

### Étape 2 — Démarrer les VMs
```bash
vagrant up
```

### Étape 3 — Remplir le rôle `roles/php/tasks/main.yml`

Installe PHP-FPM sur le cluster 1 :

```yaml
---
- name: Installer PHP et extensions
  ansible.builtin.apt:
    name:
      - php{{ php_version }}-fpm
      - php{{ php_version }}-cli
      - php{{ php_version }}-curl
      - php{{ php_version }}-mbstring
    state: present
    update_cache: true

- name: Démarrer PHP-FPM
  ansible.builtin.service:
    name: "php{{ php_version }}-fpm"
    state: started
    enabled: true
```

### Étape 4 — Remplir le rôle `roles/nginx/tasks/main.yml`

```yaml
---
- name: Installer Nginx
  ansible.builtin.apt:
    name: nginx
    state: present
    update_cache: true

- name: Copier la config Nginx
  ansible.builtin.template:
    src: nginx.conf.j2
    dest: /etc/nginx/sites-available/{{ app_name }}
  notify: Restart nginx

- name: Activer le site
  ansible.builtin.file:
    src: /etc/nginx/sites-available/{{ app_name }}
    dest: /etc/nginx/sites-enabled/{{ app_name }}
    state: link
  notify: Restart nginx

- name: Démarrer Nginx
  ansible.builtin.service:
    name: nginx
    state: started
    enabled: true
```

### Étape 5 — Remplir `playbooks/install_nginx.yml`

```yaml
---
- name: Installer Nginx et PHP sur Cluster 1
  hosts: cluster1
  become: true
  roles:
    - php
    - nginx
```

### Étape 6 — Déployer l'application

Copie `apps/cluster1-nginx-app/` vers `/var/www/cluster1` sur chaque nœud (rôle `application` ou tâche dans ton playbook).

### Étape 7 — Tester

```bash
ansible-playbook playbooks/install_nginx.yml
curl http://192.168.56.11
curl http://192.168.56.12
curl http://192.168.56.13
```

Tu dois voir la page PHP avec le nom du serveur.

### Étape 8 — Envoyer sur GitHub

```bash
git add .
git commit -m "Cluster 1 : Nginx + PHP + application"
git push origin jose/cluster1-nginx
```

Puis ouvre une **Pull Request** vers `main` sur GitHub.

---

## Checklist

- [ ] PHP installé sur cluster1-node1, node2, node3
- [ ] Nginx installé et démarré
- [ ] `curl http://192.168.56.11` affiche la page PHP
- [ ] PR ouverte vers `main`
