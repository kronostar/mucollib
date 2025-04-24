#!/bin/sh
#
# syntax: copyrightbump.sh <directory>
# $1 = directory
#
if [ "$#" -lt 1 ]; then
    echo "Usage: copyrightbump.sh <directory>"
    exit 1
fi
DIR="${1}"
cd ${DIR}
for FILE in $(grep -ilR "Copyright (C) " *); do
    sed -i "s/2018,2019,2021,2025 Steve Martin/2018,2019,2021,2025 Steve Martin/g" ${FILE}
done
