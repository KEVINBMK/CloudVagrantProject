# Git — Mode d'emploi simple pour l'équipe

## 1. Cloner le projet (une seule fois)

```bash
git clone https://github.com/KEVINBMK/CloudVagrantProject.git
cd CloudVagrantProject
```

## 2. Trouver ta branche

| Membre | Branche Git |
|--------|-------------|
| BITUBISHA MBEMBA KEVIN | `kevin/coordination` |
| SIKU EMEDI JOSE | `jose/cluster1-nginx` |
| TSHILUMBA TSHILUMBA JONATHAN | `jonathan/cluster2-apache` |
| KABENGELE KABENGELE DIEUVIE | `dieuvie/monitoring-reseau` |
| MONSHEVIALE KILOR CHRIS | `chris/securite` |

## 3. Aller sur TA branche

Remplace `NOM-BRANCHE` par ta branche du tableau ci-dessus :

```bash
git checkout NOM-BRANCHE
```

Exemple pour José :
```bash
git checkout jose/cluster1-nginx
```

## 4. Travailler (chaque jour)

```bash
# 1. Récupérer les dernières modifications
git checkout main
git pull
git checkout NOM-BRANCHE
git merge main

# 2. Faire tes modifications dans les fichiers prévus

# 3. Enregistrer et envoyer
git add .
git commit -m "Description courte de ce que tu as fait"
git push origin NOM-BRANCHE
```

## 5. Quand tu as fini une partie

1. Va sur GitHub : https://github.com/KEVINBMK/CloudVagrantProject
2. Clique **Pull requests** → **New pull request**
3. Base : `main` ← Compare : ta branche
4. Décris ce que tu as fait
5. KEVIN valide et fusionne

## 6. Règles importantes

- Ne modifie **que les fichiers de ton guide** (voir ton `GUIDE_xxx.md`)
- Ne touche **pas** au dossier `.vagrant/`
- Ne modifie **pas** les fichiers des autres sans accord
- En cas de doute → demande à KEVIN sur le groupe

## 7. Ta documentation personnelle

Chaque membre a un guide détaillé dans `docs/guides/` :

- `GUIDE_KEVIN.md`
- `GUIDE_JOSE.md`
- `GUIDE_JONATHAN.md`
- `GUIDE_DIEUVIE.md`
- `GUIDE_CHRIS.md`
