# Procédure d'exécution

## Étape 1 — Prérequis

- **Windows / PowerShell** : VirtualBox et Vagrant
- **WSL / Linux** : Ansible (≥ 2.14)

Ne pas installer Ansible dans PowerShell Windows.
Ne pas exécuter Vagrant depuis l'intérieur d'une VM.

## Étape 2 — Création des VMs (Windows / PowerShell)

```powershell
cd CloudVagrantProject
vagrant up
vagrant status
```

Durée estimée : 10–20 minutes (première exécution, téléchargement de l'image Ubuntu Jammy).

## Étape 3 — Vérification Ansible (WSL / Linux)

```bash
# Depuis WSL, se placer dans le dossier du projet (chemin Windows monté sous /mnt/c/...)
cd /mnt/c/.../CloudVagrantProject
ansible all -m ping
```

Les 7 machines doivent répondre `pong`.

## Étape 4 — Déploiement Ansible (WSL / Linux)

```bash
ansible-playbook playbooks/site.yml
```

Pour le moment, `site.yml` déploie uniquement :
- utilisateurs et SSH ;
- Apache + PHP (Cluster 2) ;
- monitoring.

Nginx (José) et la sécurité (Chris) seront intégrés après leurs Pull Requests.

## Étape 5 — Tests fonctionnels

```bash
# Cluster 2 (Apache) — disponible maintenant
curl http://192.168.56.21
curl http://192.168.56.22
curl http://192.168.56.23

# Utilisateur deploy
ansible all -b -m command -a "id deploy"

# Monitoring
ansible all -b -m stat -a "path=/usr/local/bin/cloud-monitor-agent"
ansible master -b -m stat -a "path=/usr/local/bin/cloud-monitor-central"
```

```bash
# Cluster 1 (Nginx) — après la livraison de José
curl http://192.168.56.11
curl http://192.168.56.12
curl http://192.168.56.13
```

## Étape 6 — Arrêt des VMs (Windows / PowerShell)

```powershell
vagrant halt
```

## Étape 7 — Réinitialisation complète (si nécessaire)

```powershell
vagrant destroy -f
vagrant up
```

Puis depuis WSL :

```bash
ansible-playbook playbooks/site.yml
```

## Dépannage

| Problème | Solution |
|----------|----------|
| VM ne démarre pas | Vérifier VirtualBox et la virtualisation BIOS |
| `ansible ping` échoue | Attendre la fin du provisionnement shell, puis relancer |
| IP inaccessible | Vérifier le réseau host-only VirtualBox (192.168.56.0/24) |
| Clé SSH introuvable | Lancer `vagrant up` au moins une fois pour générer `.vagrant/` |
| Ansible introuvable sous Windows | Utiliser WSL2 (Ubuntu) |
