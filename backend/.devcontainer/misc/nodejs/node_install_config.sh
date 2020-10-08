#!/bin/bash

NODEREPO="node_12.x"

DISTRO="buster"
# Your distro options are:
# Debian
#   unstable sid
#   10 buster
#   9 stretch
#   8 jessie
#   7 wheezy
#   
# Ubuntu
#   18.04 bionic (future LTS)
#   17.10 artful
#   17.04 zesty
#   16.10 yakkety
#   16.04 xenial
#   15.10 wily
#   14.04 trusty
#   12.04 precise

cat > nodesource.list <<EOF
deb     https://deb.nodesource.com/$NODEREPO $DISTRO main
deb-src https://deb.nodesource.com/$NODEREPO $DISTRO main
EOF

curl -s https://deb.nodesource.com/gpgkey/nodesource.gpg.key | gpg --import --no-default-keyring --keyring ./nodesource.gpg
