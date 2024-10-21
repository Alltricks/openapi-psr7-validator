Fork from https://github.com/thephpleague/openapi-psr7-validator.  
Add some feature to support 3.1.  
Tags on this repo is same as forked with our commits on the top.
If you need to upgrade this repo with original one, do it like this :

```
# X.X.X = nouveau tag à recupérer, Y.Y.Y = dernier tag recupéré

git remote add forked git@github.com:thephpleague/openapi-psr7-validator.git
git fetch forked
git checkout from-Y-Y-Y
git pull
git checkout -b from-X-X-X
git rebase --onto X.X.X Y.Y.Y
git push

```
