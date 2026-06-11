# TP Cloud Computing — Vagrant & Ansible

Infrastructure virtualisée automatisée pour le Travail Pratique de Cloud Computing.

**Technologies :** Vagrant, VirtualBox, Ansible (aucune autre technologie requise pour la partie principale).

**Dépôt GitHub :** [KEVINBMK/CloudVagrantProject](https://github.com/KEVINBMK/CloudVagrantProject)

## Démarrage rapide pour l'équipe

1. Cloner : `git clone https://github.com/KEVINBMK/CloudVagrantProject.git`
2. Lire **ton guide** dans `docs/guides/` (voir tableau ci-dessous)
3. Aller sur **ta branche** : `git checkout NOM-BRANCHE`
4. Travailler uniquement sur **tes fichiers**
5. Pousser et ouvrir une **Pull Request** vers `main`

| Membre | Branche | Guide |
|--------|---------|-------|
| KEVIN | `kevin/coordination` | [GUIDE_KEVIN.md](docs/guides/GUIDE_KEVIN.md) |
| JOSÉ | `jose/cluster1-nginx` | [GUIDE_JOSE.md](docs/guides/GUIDE_JOSE.md) |
| JONATHAN | `jonathan/cluster2-apache` | [GUIDE_JONATHAN.md](docs/guides/GUIDE_JONATHAN.md) |
| DIEUVIE | `dieuvie/monitoring-reseau` | [GUIDE_DIEUVIE.md](docs/guides/GUIDE_DIEUVIE.md) |
| CHRIS | `chris/securite` | [GUIDE_CHRIS.md](docs/guides/GUIDE_CHRIS.md) |

Mode d'emploi Git pour tous : [GIT_POUR_TOUS.md](docs/guides/GIT_POUR_TOUS.md)

## Architecture

| Machine | IP | Rôle |
|---------|-----|------|
| `master` | 192.168.56.10 | Contrôle Ansible, monitoring, audit sécurité |
| `cluster1-node1` | 192.168.56.11 | Application PHP + Nginx |
| `cluster1-node2` | 192.168.56.12 | Application PHP + Nginx |
| `cluster1-node3` | 192.168.56.13 | Application PHP + Nginx |
| `cluster2-node1` | 192.168.56.21 | Application PHP + Apache |
| `cluster2-node2` | 192.168.56.22 | Application PHP + Apache |
| `cluster2-node3` | 192.168.56.23 | Application PHP + Apache |

**Total : 7 machines virtuelles.**

## Prérequis

Installer sur la machine hôte :

- [VirtualBox](https://www.virtualbox.org/wiki/Downloads) (≥ 6.x)
- [Vagrant](https://www.vagrantup.com/downloads) (≥ 2.3)
- [Ansible](https://docs.ansible.com/ansible/latest/installation_guide/intro_installation.html) (≥ 2.14)

Sous Windows, Ansible s’installe le plus simplement via WSL2 (Ubuntu) ou un environnement Linux.

Vérification :

```bash
vagrant --version
VBoxManage --version
ansible --version
```

## Membres du groupe

| Membre | Rôle principal |
|--------|----------------|
| BITUBISHA MBEMBA KEVIN | Coordination, Vagrantfile, inventaire, playbook principal |
| SIKU EMEDI JOSE | Cluster 1 — Nginx + PHP |
| TSHILUMBA TSHILUMBA JONATHAN | Cluster 2 — Apache + PHP |
| KABENGELE KABENGELE DIEUVIE | Réseau, SSH, monitoring |
| MONSHEVIALE KILOR CHRIS | Cybersécurité, firewall, audit |

## Structure du projet

```
tp-cloud-vagrant-ansible/
├── Vagrantfile          # Création des 7 VMs
├── inventory.ini        # Inventaire Ansible et groupes d’hôtes
├── ansible.cfg          # Configuration Ansible
├── playbooks/           # Playbooks (site.yml = point d’entrée)
├── roles/               # Rôles Ansible réutilisables
├── templates/           # Templates Jinja2
├── group_vars/          # Variables par groupe
├── apps/                # Applications PHP des clusters
└── docs/                # Documentation et rapport sécurité
```

## Lancement du projet

### 1. Cloner le dépôt et se placer dans le dossier

```bash
cd tp-cloud-vagrant-ansible
```

### 2. Créer les machines virtuelles

```bash
vagrant up
```

Cette commande crée et démarre les 7 VMs via VirtualBox. La première exécution télécharge l’image `ubuntu/jammy64` (peut prendre plusieurs minutes).

Vérifier l’état :

```bash
vagrant status
```

### 3. Tester la connectivité SSH

```bash
vagrant ssh master
# ou depuis l’hôte :
ansible all -m ping
```

### 4. Déployer l’infrastructure avec Ansible

Une fois les rôles et playbooks complétés :

```bash
ansible-playbook playbooks/site.yml
```

### 5. Commandes utiles

```bash
# Arrêter toutes les VMs
vagrant halt

# Redémarrer
vagrant reload

# Détruire les VMs (réinitialisation complète)
vagrant destroy -f
vagrant up
ansible-playbook playbooks/site.yml
```

## Règles du TP

1. **Aucune création manuelle** de machines ou de services.
2. **Vagrant** crée toutes les VMs.
3. **Ansible** installe et configure tous les services.
4. Les dossiers `.vagrant/` ne sont **pas** versionnés (voir `.gitignore`).
5. Le projet doit être **reproductible** : `vagrant up` puis `ansible-playbook playbooks/site.yml`.

## État actuel

- [x] Structure du projet
- [x] Vagrantfile (7 machines)
- [x] Inventaire Ansible
- [x] Configuration Ansible de base
- [ ] Rôles et playbooks (à compléter étape par étape)

## Documentation

Voir le dossier `docs/` :

- `architecture.md` — schéma et description de l’infrastructure
- `repartition_taches.md` — répartition détaillée des tâches
- `procedure_execution.md` — procédure complète d’exécution
- `rapport_securite.md` — rapport d’audit sécurité (équipe cybersécurité)
