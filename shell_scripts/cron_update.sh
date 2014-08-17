cd ../schedule
find -name "*.crontab" -exec cat {} \; > /tmp/radio.crontab
crontab -r; crontab /tmp/radio.crontab
rm /tmp/radio.crontab
crontab -l

