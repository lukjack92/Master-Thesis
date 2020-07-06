#!/bin/bash

#sudo adduser www-data jenkins
#Add to group
#usermod -G devops user4
#Remove user form Group
#gpasswd -d user4 qa_team

chmod 775 /var/www/html/$ENV/logs
chmod 775 /var/www/html/$ENV/upload
chmod 775 /var/www/html/$ENV/video