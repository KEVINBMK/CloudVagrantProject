# Architecture de l'infrastructure

## Vue d'ensemble

```
                    ┌─────────────────────────────────────┐
                    │           Machine hôte              │
                    │     (Vagrant + VirtualBox)          │
                    └─────────────────────────────────────┘
                                      │
                    Réseau privé 192.168.56.0/24
                                      │
        ┌─────────────────────────────┼─────────────────────────────┐
        │                             │                             │
   ┌────▼────┐              ┌───────────▼───────────┐      ┌─────────▼─────────┐
   │ master  │              │      Cluster 1        │      │     Cluster 2     │
   │ .56.10  │              │  Nginx + PHP (x3)     │      │  Apache + PHP (x3)│
   └─────────┘              │  .56.11 / .12 / .13   │      │  .56.21 / .22 / .23│
                            └───────────────────────┘      └───────────────────┘
```

## Rôles des machines

### Master (192.168.56.10)
- Contrôle Ansible
- Monitoring et supervision
- Audit et tests de sécurité (Nmap, Nikto, Lynis)

### Cluster 1 (192.168.56.11–13)
- Serveur web Nginx
- Application PHP
- 3 nœuds identiques

### Cluster 2 (192.168.56.21–23)
- Serveur web Apache
- Application PHP
- 3 nœuds identiques

## Groupes Ansible

| Groupe | Machines | Usage |
|--------|----------|-------|
| `master` | master | Contrôle, monitoring, sécurité |
| `cluster1` | cluster1-node1..3 | Nginx + PHP |
| `cluster2` | cluster2-node1..3 | Apache + PHP |
| `webservers_nginx` | cluster1 | Playbooks Nginx |
| `webservers_apache` | cluster2 | Playbooks Apache |
| `monitoring` | master | Supervision |
| `security` | master | Audit sécurité |
