# Guide CHRIS — Cybersécurité & Firewall

**Branche Git :** `chris/securite`

## Ton rôle en une phrase

Tu configures le **firewall**, installes les **outils de sécurité** sur le master, tu scannes les machines et tu rédiges le **rapport de sécurité**.

---

## Ta machine d'attaque / audit

**Master** — 192.168.56.10

Tu te connectes dessus pour lancer Nmap, Nikto et Lynis contre les autres machines.

---

## Tes fichiers (tu es le seul à les modifier)

```
roles/firewall/
roles/security_tools/
playbooks/firewall.yml
playbooks/open_ports.yml
playbooks/close_ports.yml
playbooks/hardening.yml
playbooks/deploy_vulnerable_apps.yml
playbooks/install_security_tools.yml
group_vars/security.yml
templates/firewall-rules.j2
docs/rapport_securite.md
docs/captures/               ← screenshots des scans
```

---

## Ce que tu dois faire (étape par étape)

### Étape 1 — Aller sur ta branche
```bash
git checkout chris/securite
```

### Étape 2 — Installer les outils sur le master

Dans `roles/security_tools/tasks/main.yml` :

```yaml
---
- name: Installer outils de sécurité
  ansible.builtin.apt:
    name:
      - nmap
      - nikto
      - lynis
    state: present
    update_cache: true
```

```bash
ansible-playbook playbooks/install_security_tools.yml
```

### Étape 3 — Configurer le firewall (ufw)

Dans `roles/firewall/tasks/main.yml` :

```yaml
---
- name: Installer ufw
  ansible.builtin.apt:
    name: ufw
    state: present

- name: Autoriser SSH
  community.general.ufw:
    rule: allow
    port: "22"
    proto: tcp

- name: Autoriser HTTP
  community.general.ufw:
    rule: allow
    port: "80"
    proto: tcp

- name: Activer ufw
  community.general.ufw:
    state: enabled
```

> Si `community.general` n'est pas installé : `ansible-galaxy collection install community.general`

### Étape 4 — Ouvrir / fermer des ports

- `playbooks/open_ports.yml` → ouvre un port (ex. 8080)
- `playbooks/close_ports.yml` → ferme un port

Utilise des **variables** dans `group_vars/security.yml` :

```yaml
allowed_ports:
  - 22
  - 80
```

### Étape 5 — Scanner les machines (depuis le master)

```bash
vagrant ssh master

# Scan des ports
nmap -sV 192.168.56.11
nmap -sV 192.168.56.21

# Scan web
nikto -h http://192.168.56.11

# Audit système
sudo lynis audit system
```

Fais une **capture d'écran** de chaque scan → `docs/captures/`

### Étape 6 — Rédiger le rapport

Complète `docs/rapport_securite.md` avec :
1. Ports ouverts par machine
2. Vulnérabilités trouvées
3. Captures d'écran
4. Recommandations et mitigations

### Étape 7 — Envoyer sur GitHub

```bash
git add .
git commit -m "Firewall, outils sécurité et rapport"
git push origin chris/securite
```

Puis ouvre une **Pull Request** vers `main`.

---

## Checklist

- [ ] ufw actif sur toutes les machines
- [ ] Nmap, Nikto, Lynis installés sur le master
- [ ] Scans réalisés sur cluster1 et cluster2
- [ ] Rapport de sécurité complété
- [ ] Captures dans `docs/captures/`
- [ ] PR ouverte vers `main`
