# Web Pages
## This a Master-Thesis

### To create user's for jenkins

After installed jenkins we need to create user as jenkins which is dedicated to Jenkins, then we will change file config (in debian this file is created in) `/etc/default/jenkins` as `NAME=jenkins` or `$JENKINS_USER="jenkins"` it's depends for system version.

Then change the ownership of the Jenkins home, Jenkins webroot and logs.

`chown -R manula:manula /var/lib/jenkins` 
`chown -R manula:manula /var/cache/jenkins`
`chown -R manula:manula /var/log/jenkins`

Then restarted the Jenkins jenkins and check the user has changed using a ps command

`/etc/init.d/jenkins restart`
`ps -ef | grep jenkins`
