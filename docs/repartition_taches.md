# Répartition des tâches

## BITUBISHA MBEMBA KEVIN — Coordination technique

- [x] Structure du projet
- [x] Vagrantfile
- [x] Inventaire Ansible (`inventory.ini`)
- [x] Configuration Ansible (`ansible.cfg`)
- [x] Playbook principal (`playbooks/site.yml`)
- [ ] Intégration globale des rôles
- [ ] Documentation principale (`README.md`)

## SIKU EMEDI JOSE — Cluster 1 (Nginx + PHP)

- [ ] Rôle `nginx`
- [ ] Rôle `php` (partie Cluster 1)
- [ ] Template `nginx.conf.j2`
- [ ] Playbook `install_nginx.yml`
- [ ] Application `apps/cluster1-nginx-app/`
- [ ] Tests HTTP du Cluster 1

## TSHILUMBA TSHILUMBA JONATHAN — Cluster 2 (Apache + PHP)

- [ ] Rôle `apache`
- [ ] Rôle `php` (partie Cluster 2)
- [ ] Template `apache-vhost.conf.j2`
- [ ] Playbook `install_apache.yml`
- [ ] Application `apps/cluster2-apache-app/`
- [ ] Tests HTTP du Cluster 2

## KABENGELE KABENGELE DIEUVIE — Réseau & Monitoring

- [ ] Vérification des IP et connectivité réseau
- [ ] Configuration SSH
- [ ] Rôle `monitoring_server`
- [ ] Rôle `monitoring_agent`
- [ ] Playbook `monitoring.yml`
- [ ] Alertes (CPU, mémoire, services, HTTP)

## MONSHEVIALE KILOR CHRIS — Cybersécurité

- [ ] Rôle `firewall`
- [ ] Rôle `security_tools`
- [ ] Playbooks `firewall.yml`, `open_ports.yml`, `close_ports.yml`
- [ ] Playbooks `hardening.yml`, `deploy_vulnerable_apps.yml`
- [ ] Scans Nmap, Nikto, Lynis
- [ ] Rapport de sécurité (`docs/rapport_securite.md`)
