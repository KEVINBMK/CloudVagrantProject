# Guide DIEUVIE — Réseau, SSH & Monitoring

**Branche Git :** `dieuvie/monitoring-reseau`

## Ton rôle en une phrase

Tu configures **SSH et les utilisateurs**, puis tu mets en place le **monitoring** (CPU, mémoire, services, HTTP) sur toutes les machines.

---

## Tes machines cibles

- **Toutes les machines** (SSH, agents monitoring)
- **Master** (192.168.56.10) = serveur de monitoring central

---

## Tes fichiers (tu es le seul à les modifier)

```
roles/users/
roles/monitoring_server/      ← sur le master
roles/monitoring_agent/       ← sur tous les nœuds
playbooks/users.yml
playbooks/monitoring.yml
group_vars/monitoring.yml
templates/monitoring-config.j2
```

---

## Ce que tu dois faire (étape par étape)

### Étape 1 — Aller sur ta branche
```bash
git checkout dieuvie/monitoring-reseau
```

### Étape 2 — Vérifier le réseau (test de connectivité)

```bash
vagrant up
ansible all -m ping
```

Tout doit répondre `pong`. Si une machine échoue, vérifie son IP dans `inventory.ini`.

Test manuel des IP :
```bash
ping 192.168.56.10
ping 192.168.56.11
# ... jusqu'à .23
```

### Étape 3 — Rôle `users` : utilisateurs et SSH

Dans `roles/users/tasks/main.yml`, crée par exemple un utilisateur `deploy` :

```yaml
---
- name: Créer l'utilisateur deploy
  ansible.builtin.user:
    name: deploy
    groups: sudo
    shell: /bin/bash
    create_home: true

- name: Autoriser la clé SSH
  ansible.builtin.authorized_key:
    user: deploy
    key: "{{ lookup('file', '~/.ssh/id_rsa.pub') }}"
    state: present
```

Dans `playbooks/users.yml` :
```yaml
---
- name: Configurer utilisateurs et SSH
  hosts: all
  become: true
  roles:
    - users
```

### Étape 4 — Monitoring agent (sur toutes les machines)

Dans `roles/monitoring_agent/tasks/main.yml`, installe un script simple qui vérifie :
- CPU (seuil : 80 %)
- Mémoire (seuil : 85 %)
- État des services (nginx, apache2)
- Réponse HTTP (port 80)

Tu peux utiliser des commandes shell + `cron`, ou installer `htop` / `sysstat`.

### Étape 5 — Monitoring server (sur le master)

Dans `roles/monitoring_server/tasks/main.yml`, centralise les alertes :
- Machine inaccessible → log d'alerte
- Service arrêté → log d'alerte
- CPU > 80 % → log d'alerte

### Étape 6 — Playbook monitoring

```yaml
---
- name: Installer agents de monitoring
  hosts: all
  become: true
  roles:
    - monitoring_agent

- name: Configurer serveur de monitoring
  hosts: master
  become: true
  roles:
    - monitoring_server
```

### Étape 7 — Tester

```bash
ansible-playbook playbooks/users.yml
ansible-playbook playbooks/monitoring.yml
```

### Étape 8 — Envoyer sur GitHub

```bash
git add .
git commit -m "SSH, utilisateurs et monitoring"
git push origin dieuvie/monitoring-reseau
```

Puis ouvre une **Pull Request** vers `main`.

---

## Checklist

- [ ] `ansible all -m ping` → 7 machines OK
- [ ] Utilisateur `deploy` créé sur toutes les machines
- [ ] Script monitoring actif sur chaque nœud
- [ ] Alertes configurées sur le master
- [ ] PR ouverte vers `main`
