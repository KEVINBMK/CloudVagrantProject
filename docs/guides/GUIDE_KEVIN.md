# Guide KEVIN — Coordination & intégration

**Branche Git :** `kevin/coordination`

## Ton rôle en une phrase

Tu fais le lien entre tout le monde : tu maintiens la base du projet et tu branches les travaux de l'équipe dans `site.yml`.

---

## Tes fichiers (tu es le seul à les modifier)

```
Vagrantfile
inventory.ini
ansible.cfg
README.md
playbooks/site.yml          ← TRÈS IMPORTANT : playbook principal
docs/
.gitignore
```

---

## Ce que tu dois faire (dans l'ordre)

### Étape 1 — Vérifier que les VMs démarrent
```bash
vagrant up
vagrant status
```

### Étape 2 — Vérifier qu'Ansible voit toutes les machines
```bash
ansible all -m ping
```

### Étape 3 — Intégrer les playbooks dans `site.yml`

Quand chaque membre finit son playbook, tu l'ajoutes dans `playbooks/site.yml` :

```yaml
---
- import_playbook: users.yml
- import_playbook: firewall.yml
- import_playbook: install_nginx.yml
- import_playbook: install_apache.yml
- import_playbook: deploy_app.yml
- import_playbook: monitoring.yml
- import_playbook: install_security_tools.yml
```

Ajoute-les **un par un**, au fur et à mesure que l'équipe livre.

### Étape 4 — Tester le déploiement complet
```bash
ansible-playbook playbooks/site.yml
```

### Étape 5 — Fusionner les Pull Requests sur GitHub

Quand un membre ouvre une PR, vérifie que :
- Les fichiers modifiés sont les bons
- `ansible-playbook` ne plante pas
- Puis clique **Merge**

---

## Commandes Git pour toi

```bash
git checkout kevin/coordination
git add .
git commit -m "Intégration playbook monitoring"
git push origin kevin/coordination
```

---

## Checklist finale

- [ ] `vagrant up` fonctionne (7 VMs)
- [ ] `ansible all -m ping` → tout en vert
- [ ] `site.yml` appelle tous les playbooks
- [ ] README à jour
- [ ] Toutes les PR fusionnées dans `main`
