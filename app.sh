#!/usr/bin/env bash

set -eu
set -o nounset

readonly __DIR__=$(cd "${0%/*}";echo "${PWD}")
readonly __FILE__="${__DIR__}${0##*/}"
readonly __ARG_COUNT__=0

readonly E_BAD_ARGS=65

[[ $# -lt $__ARG_COUNT__ ]] && exit $E_BAD_ARGS

# ...

exit 0
