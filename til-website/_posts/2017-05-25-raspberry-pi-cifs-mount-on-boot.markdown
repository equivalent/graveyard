---
layout: post
title:  "Raspberry PI CIFS mount on boot"
date:   2017-05-25 20:44:22 +0200
categories: raspberryPI linux
---

In order to mount NAS unit / network folder in linux / Raspbery PI
place this in your `/etc/fstab`

{% highlight bash %}
//192.168.1.150/Volume_1/  /mnt/mymount       cifs   uid=1000,gid=1000,rw,username=myusername,password=MyPAssWD      0       0
{% endhighlight %}

Now in order for Rasp PI to mount this on boot you need
to configure in `sudo raspi-config`


{% highlight bash %}
Boot Options > Wait for Network at Boot > Yes 
{% endhighlight %}

#### source

* [https://askubuntu.com/questions/157128/proper-fstab-entry-to-mount-a-samba-share-on-boot](https://askubuntu.com/questions/157128/proper-fstab-entry-to-mount-a-samba-share-on-boot)
