#!/bin/bash


echo "Content-Type:text/html; Charset=gbk"
echo ""

echo "<br/>"
if [[ "$REQUEST_METHOD" == "POST" ]];then
    read vars
    echo "$vars" | awk -F "=" '{print $2}' > temp
    dos2unix temp
    side_length=`cat temp`
    c_area="$side_length*$side_length"
    

    echo "<br/>"
    echo "<table border="5" cellpadding="10">"
    echo "Info:"
    echo "<tr>"
    echo "<td>±ß³¤</td><td>Ãæ»ý</td>"
    echo "</tr>"
    echo "<tr>"
    echo "<td>"$side_length"</td><td>"$c_area"</td>"
    echo "</tr>"
    echo "</table>"
fi
