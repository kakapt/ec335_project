#!/usr/bin/bash

usage="usage: ${0} order-id"

if [ -z $1 ]; 
then
    echo $usage;
    exit 1;
fi

out=$(sqlite3 db/boygang.db "select * from orders where id = ${1}")

if [ -z "$out" ];
then
    echo "No order found";
    exit 1;
fi

echo "Order ID: $(echo $out | cut -d'|' -f1)"
echo "Order Date: $(echo $out | cut -d'|' -f3)"
echo "Total Amount: $(echo $out | cut -d'|' -f4) VND"
echo "Status: $(echo $out | cut -d'|' -f5)"
