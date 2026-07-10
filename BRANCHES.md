# Branches Git — Vue rapide

## Branche principale

| Branche | Qui | Description |
|---------|-----|-------------|
| `main` | KEVIN | Code stable, intégration de toute l'équipe |

## Branches de travail

| Branche | Membre | Mission |
|---------|--------|---------|
| `kevin/coordination` | BITUBISHA MBEMBA KEVIN | Vagrantfile, inventaire, site.yml, intégration |
| `jose/cluster1-nginx` | SIKU EMEDI JOSE | Nginx + PHP, Cluster 1 |
| `jonathan/cluster2-apache` | TSHILUMBA TSHILUMBA JONATHAN | Apache + PHP, Cluster 2 |
| `dieuvie/monitoring-reseau` | KABENGELE KABENGELE DIEUVIE | SSH, utilisateurs, monitoring |
| `chris/securite` | MONSHEVIALE KILOR CHRIS | Firewall, scans, rapport sécurité |

## Workflow

```
main ─────────────────────────────────────────► (code final)
  │
  ├── kevin/coordination      (intégration)
  ├── jose/cluster1-nginx     (Cluster 1)
  ├── jonathan/cluster2-apache (Cluster 2)
  ├── dieuvie/monitoring-reseau (monitoring)
  └── chris/securite          (sécurité)
```

Chaque membre travaille sur sa branche → Pull Request → KEVIN fusionne dans `main`.
