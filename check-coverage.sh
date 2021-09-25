#!/usr/bin/env bash

CLASSES_COVERAGE=$(perl -lne 'print "$1$2" if /\s+Classes:\s+(\d{0,3})\.(\d{2})%/' < tests/_output/coverage.txt)
METHODS_COVERAGE=$(perl -lne 'print "$1$2" if /\s+Methods:\s+(\d{0,3})\.(\d{2})%/' < tests/_output/coverage.txt)
LINES_COVERAGE=$(perl -lne 'print "$1$2" if /\s+Lines:\s+(\d{0,3})\.(\d{2})%/' < tests/_output/coverage.txt)

ERROR=0
if [[ "$CLASSES_COVERAGE" -lt "8000" ]]; then
    echo "Class coverage under minimum."
    ERROR=1
fi

if [[ "$METHODS_COVERAGE" -lt "8000" ]]; then
    echo "Method coverage under minimum."
    ERROR=1
fi

if [[ "$LINES_COVERAGE" -lt "8000" ]]; then
    echo "Line coverage under minimum."
    ERROR=1
fi

if [[ "$ERROR" == "1" ]]; then
    exit 1
fi