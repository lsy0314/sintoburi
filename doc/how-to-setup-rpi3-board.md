 
 # Deprecated: Plewse use Moniwifi webpage since Feb-25-2019.
 
**Table Of Contents**
- [운영체제 설치하기](#운영체제-설치하기)
- [와이파이 설정하기](#와이파이-설정하기)
- [SSH Server](#ssh-server)
- [Raspberry Pi 화면 180도 회전시키기](#raspberry-pi-화면-180도-회전시키기)
- [터치스크린 보정을 위해 xinput_calibrator 설치](#터치스크린-보정을-위해-xinput_calibrator-설치)
- [Apache 웹서버 설치하기](#Apache-웹서버-설치하기)
- [PHP 개발환경 설치](#php-개발환경-설치)
- [MySQL 데이타베이스 서버 설치하기](#mysql-데이타베이스-서버-설치하기)
- [phpMyAdmin 설치하기](#phpmyadmin-설치하기)
- [VNC Server Setup on Raspberry Pi 3](#vnc-server-setup-on-raspberry-pi-3)
- [How to do realtime streamming service with camera and gstreamer software](#how-to-do-realtime-streamming-service-with-camera-and-gstreamer-software)
- [How to enable onboard ALSA audio to play sound file](#How-to-enable-onboard-ALSA-audio-to-play-sound-file)
- [How to make live stream video using vlc from webcam on Linux](#how-to-make-live-stream-video-using-vlc-from-webcam-on-linux)
- [How to record your voice from microphone of USB webcam using ALSA](#how-to-record-your-voice-from-microphone-of-usb-webcam-using-alsa)
- [Play wma file with cvlc and mplayer command](#play-wma-file-with-cvlc-and-mplayer-command)
- [이메일 발송하기](#이메일-발송하기)
- [How to convert sound file from wma to wav](#how-to-convert-sound-file-from-wma-to-wav)
- [터미널을 통한 WiFi 연결](#터미널을-통한-wifi-연결)
- [cron job으로부터 email notifications를 중지하는 방법](#cron-job으로부터-email-notifications를-중지하는-방법) 

# 운영체제 설치하기
* 참고 사이트
   * https://elinux.org/RPi_Easy_SD_Card_Setup
* 단계1: 인기 있는 OS 종류: 1) Raspbian Stretch (=Debian Stretch, 9.0), 2) Ubuntu MATE (=Ubuntu 16.04, Xenial)
   * OS 이미지를 다운로드하기 위하여 https://www.raspberrypi.org/downloads/ 에 접속후에 2) 우분투(마테버젼)을 다운로드 한다.
   * Desktop PC의 보관 장소(OS): `D:\rpi3\`

* 단계2: micro SDcard를 포맷한다.
   * Windows PC: SD_CardFormatter0500SetupEN.exe를 이용한다.
      * 다운로드 주소: https://www.download3k.com/Install-SDFormatter.html 
   * Ubuntu PC: fat32 형식으로 포맷하도록 한다.
      * 댜운로드 주소: sudo apt install gparted

* 단계3: microSD카드에 .img를 flash 한다.
   * https://www.raspberrypi.org/documentation/installation/installing-images/windows.md|
   * Windows PC: win32diskimager-1.0.0-install.exe 프로그램을 실행후에 다운로드한 OS 이미지를 micro SDcard에 설치하도록 한다.
      * 다운로드 주소: https://sourceforge.net/projects/win32diskimager/files/Archive/ 
   * Ubuntu PC:
      * 다운로드 주소: https://www.balena.io/etcher/
      
* 단계4: RPi3보드 부팅시에 Ubuntu OS를 자동으로 로그인하기  (자동 로그인하려는 계정이 'hjoon0510'이라고 가정한다.)
   ```
   $ sudo vi /etc/lightdm/lightdm.conf
   [Seat:*]
   autologin-guest=false
   autologin-user=hjoon0510
   autologin-user-timeout=0
   ```

* 단계5: SD카드 파티션들을 수동으로 resizing하기
   * 기본적으로 .img는 2GiB 또는 2GiB용량으로 제작된다. 그래서  사용자가 가지고 있는 microSD카드가 64gb이라면, 파티션의 resize가 필요하다.
     * https://elinux.org/RPi_Resize_Flash_Partitions
   ```
   $ sudo fdisk -l /dev/mmcblk0
   $ sudo dd if=/dev/mmcblk0 of=$HOME/sdbackup.img bs=512

   $ sudo umount /dev/mmcblk0
   $ sudo parted /dev/mmcblk0 (Expand the partition /dev/mmcblk0p2)
   $ sudo dd if=$HOME/sdbackup.img of=/dev/mmcblk0 bs=512

   $ sudo e2fsck -f /dev/mmcblk0p2
   $ sudo resize2fs /dev/mmcblk0p2
   ```
   
   * 파티션을 resizing하기 위한 가장 간단한 방법은 `raspi-config` 메뉴의 `expand_rootfs` 옵션을 실행하는 것이다.
   ```
   $ sudo raspi-config 
   7. Advance options --> A1 Expand Filesystem --> reboot
   ```
   
# 와이파이 설정하기

라즈베리파이3에는 WiFi가 내장되어 있다. 그런데 어떤 WiFi SSID는 접속이 되고 어떤 WiFi 있는데, 활성화가 되지 않았다. 별짓을 다 했음에도 동작을 하지 않아서 집에 굴러다니던 USB형 WiFi동글을 꼽았더니 그냥 동작이 잘된다. 일반적으로 라즈베리파이3는 인터넷을 위한 방법으로 WiFi 와 블루투스 장치를 제공하고 있다. 여기서는 무선 WiFi 장치를 이용하는 방법으로 설명한다. 
   * RPI3에서 wifi을 사용하기위해 가급적  (1) 인터넷 공유기와 (2) RPI3 보드 둘다 모두 "country=US"을 설정되어 있어야 한다. 
   * 20012년에 출시되었던 wevo공유기는 호환이 안되어  (leemgswevo2g)에 WiFi 연결이 안되었다. LG Uplus 공유기의 (leemgslgu2g)에는 wifi접속이 잘되었다. 
   * 우측 상단의 와이파이 아이콘을 클릭후 [v] "Enable WiFi"를 클릭하면 Wifi 리스트가 scanning된다. 
   
* RPI3 보드에서 원활한 WiFi 접속을 위해서 ko_KR.UTF8 설정하면 안되고, en_US.UTF8으로 설정해야 한다. 
```bash
$ locale
$ sudo apt-get install language-pack-ko
$ sudo locale-gen "en_US.UTF-8"
$ sudo dpkg-reconfigure locales
   [*] en_US.UTF-8   
```

* WiFI 환경파일 설정: WiFi Country에서 반드시 US (United State)를 선택해야 한다.
   * 라즈비안OS의 경우
```bash
   시스템 - 기본설정 - Raspberry Configuration - Localisation - WiFi Country - US (United State) 선택
```
   * 우분투 마테의 경우 (콘솔에서 수동 설정방법: 비추천)
```bash
u1404@lgs:~# apt-get install wi  wpasupplicant  iproute2  net-tools
u1404@lgs:~# rfkill unblock wifi
u1404@lgs:~# iw dev
u1404@lgs:~# ip link set mlan0 up
u1404@lgs:~# ip link show mlan0
u1404@lgs:~# iw dev mlan0 scan | grep SSID
u1404@lgs:~# wpa_passphrase [SSID]   [SSID_PASSWORD]   >>  /etc/wpa_supplicant.conf
(ctrl+z and bg)
u1404@lgs:~# wpa_supplicant -i mlan0 -c /etc/wpa_supplicant.conf
u1404@lgs:~# /etc/wpa_supplicant.conf
country=US
u1404@lgs:~# iw mlan0 link
u1404@lgs:~# ip link show mlan0
u1404@lgs:~# dhclient mlan0
u1404@lgs:~# ifconfig 
u1404@lgs:~# ping 8.8.8.8
(Where mlan0 is wifi adapter and essid is SSID)
(Add Routing manually)
u1404@lgs:~# ip route add default via 192.168.1.1 dev mlan0


```

# SSH Server
```bash
  sudo apt -y install openssh-server openssh-client
  sudo systemctl restart ssh
  sudo systemctl enable ssh  
  sudo netstat -natp | grep 22
```  


hjoon0510 이라는 계정아이디를 추가하는 방법이다.  아래와 같이 터미널에서 adduser 명령을 이용하면 된다. 
```bash
$ sudo adduser hjoon0510
Enter new UNIX password: ******
Retype new UNIX password: ******
        Full Name []: hjoon0510
        Room Number []:
        Work Phone []:
        Home Phone []:
        Other []:
Is the information correct? [Y/n] Y

```

이제 windows7의 mobaxterm 프로그램을 실행한후에 RaspBerry Pi 3보드의 SSH 서버에 접속하면 된다.
또는 터미널 환경에서 아래와 같이 명령을 실행하여 Pi3보드의 SSH 서버에 접속할수 있다. 
```bash
ssh {account_id}@192.168.219.104
```



# Raspberry Pi 화면 180도 회전시키기 

```bash
sudo vi /boot/config.txt 
display_rotate=2 
(0:0도, 1:90도, 2:180도, 3: 270도) 
```

# 터치스크린 보정을 위해 xinput_calibrator 설치 

필요한 프로그램 설치
```bash
sudo apt-get install libx11-dev libxext-dev libxi-dev x11proto-input-dev 
```
xinput_calibrator 다운로드
```bash
wget http://github.com/downloads/tias/xinput_calibrator/xinput_calibrator-0.7.5.tar.gz 
ls 
```
설치...(압축 풀고 해당 폴더에서...)
```bash
tar xvzf xinput_calibrator-0.7.5.tar.gz
cd xinput_calibrator-0.7.5
./configure 
make 
sudo make install 
```
실행 (Rasp Berry Pi3 보드에서 실행해야함.)
```bash
xinput_calibrator 
```
터치 4번 손으로 직접 조정하면 보정됨.
터치스크린 보정한 것을 부팅할때마다 자동으로 항상 불러오기
```bash
# mkdir /etc/X11/xorg.conf.d
# vi /etc/X11/xorg.conf.d/99-calibration.conf
 
Section "InputClass"
  Identifier "calibration"
  MatchProduct "FT5406 memory based driver"   
  Option "Calibration" "801 14 463 -12"
EndSection
```
재부팅시에 그래픽 화면이 나오지 않고 콘솔 화면으로 나온다면, 이 경우 대부분 99-calibration.conf 파일의 내용에 오타가 있었다.
```bash
# cd /etc/X11/xorg.conf.d/
# mv 99-calibration.conf 99-calibration.conf.disable
```
# Apache 웹서버 설치하기 
라즈베리 파이 보드를 이용하여 자신만의 웹서버를 운영할 수 있다.
```bash
sudo apt install apache2
sudo systemctl restart apache2 
sudo systemctl enable apache2
firefox http://192.168.219.104 
sudo mv /var/www/html/index.html /var/www/html/index.html.disable
sudo vi /var/www/html/index.html
-------------------- index.html: start -------------------------------
<H2> This webserver is created by Gildong Hong</H2>
<br>
<img src=./now.jpg></img> 
User1 &nbsp; &nbsp; &nbsp; User2 &nbsp; &nbsp; &nbsp; User3
<br> 

<br>
<br>
1. [사용자1]<br>
오늘 수학숙제를 내는 날 입니다.<br>
오늘은 고양이를 병원에 데려가는 날입니다.<br>
5시에 수학학원을 가야 합니다.<br>
-------------------- index.html: end -------------------------------
```


# PHP 개발환경 설치

```bash
$ sudo apt-get -y install php php-cgi libapache2-mod-php php-common php-pear php-mbstring
$ sudo a2enconf php7.0-cgi 
$ sudo systemctl restart apache2 
$ sudo cd /var/www/html
$ sudo vi /var/www/html/index.php

<html>
<body>
<?php
  print Date("Y/m/d");
?>
</body>
</html 
```


# MySQL 데이타베이스 서버 설치하기

MYSQL 데이타베이스를 사용하기 위하여 mysql-server, mysql-client 패키지를 설치해야 합니다. 
```bash
sudo apt-get update
sudo apt-get install mysql-server 
password:*****
sudo apt-get install mysql-client 
sudo apt-get install php-mysql

mysql -uroot -p
status;
exit

sudo /etc/init.d/mysql restart
```

기존의 MySQL 데이타베이스의 "root" id 암호를 변경하는 방법입니다. 
```bash
# To alter MySQL password from it's default empty value
$ mysqladmin --user=root password "newpassword"

# To alter MySQL password from the existing password value
$ mysqladmin --user=root --password=oldpassword password "newpassword" 
```

당신의 데이타베이스를 하나 만드는 예제입니다. 예를 들어  "sbdb"라는 데이타베이스를 만들겠습니다.
```bash
mysql -uroot -p

CREATE DATABASE sbdb;
DROP USER 'sbuser'@'localhost';
FLUSH PRIVILEGES;
CREATE USER 'sbuser'@'localhost' IDENTIFIED BY 'sb2848';
GRANT ALL PRIVILEGES ON sbdb.* TO 'sbuser'@'localhost';
FLUSH PRIVILEGES;

exit

mysql -usbuser -p sbdb

```

당신이 만든 데이타베이스에 여러개의 테이블을 만들수 있습니다. 여기서는 "test_upload_file"이라는 테이블을 만드는 연습을 해보겠습니다. 
Create a new table 'upload_file'.
```bash
mysql -usbuser -p sbdb

CREATE TABLE test_upload_file (
  file_id   VARCHAR(255) NOT NULL PRIMARY KEY,
  name_orig VARCHAR(255),
  name_save VARCHAR(255),
  reg_time  TIMESTAMP NOT NULL
);

exit
```

# phpMyAdmin 설치하기
MySQL 데이타베이스를 잘 모르는 경우에, 오픈소스 공짜 프로그램인 phpMyAdmin 을 이용하면 자신만의 데이타베이스/테이블을 쉽게 관리할수 있습니다. 
```bash
sudo apt install phpmyadmin
----------------------------------------
1. Configure database for phpmyadmin with dbconfig-common? yes
2. MySQL application password for phpmyadmin: **** okay
3. [*] apache2 okay
----------------------------------------
sudo vi /etc/apache2/apache2.conf
Include /etc/phpmyadmin/apache.conf
sudo ln -s /usr/share/phpmyadmin /var/www/html/phpmyadmin
sudo /etc/init.d/apache2 restart

firefox http://smartsecretary.mooo.com/phpmyadmin
- user: root
- pass: *****
```

*신토불이 데이타베이스 테이블 setup하기
https://github.com/lsy0314/sintoburi/tree/master/mysql/
http://192.168.219.102/phpmyadmin/ - sbdb 테이블 선택하기(좌측메뉴) -sql 메뉴 선택하기
 
# VNC Server Setup on Raspberry Pi 3

Install VNC Server
```bash
$ sudo apt install tightvncserver   (OR sudo apt install vnc4server)
$ vi ~/vnc.sh
---------- vnc server:start ---------------
#!/bin/sh
vncserver :1 -geometry 1280x1024 -depth 24
---------- vnc server: end ----------------

$ sh ./vnc.sh
You will require a password to access your desktops.
Password:***
Verify: ***
Would you like to enter a view-only password (y/n)? n

$ sudo netstat -nat | grep 5901

$ cat ~/.vnc/xstartup
---------- start ---------------
#!/bin/sh
xrdb $HOME/.Xresources
xsetroot -solid grey -cursor_name left_ptr
#x-terminal-emulator -geometry 80x24+10+10 -ls -title "$VNCDESKTOP Desktop" &
#x-window-manager &
# Fix to make GNOME work
export XKL_XMODMAP_DISABLE=1
/etc/X11/Xsession
---------- end ----------------

# VNC Server 서비스를 죽이는 방법 
$ vncserver -kill :1
```


Run VNC client

방법1: Ultra vnc viewer 사용방법 
```bash
$ firefox http://www.uvnc.com/downloads/ultravnc.html 에서 프로그램을 다운로드한다.
접속할때 아래처럼 IP 및 암호를 입력하면 된다. 
 * IP 192.168.219.104:5901
 * password: ***
```

방법2: mobaxterm의 vnc viewer 사용방법
```bash
Basic Vnc serttings:
* Remote hostname or IP address: 192.168.219.104:5901
* Port: 5901
* password: ***
```

# How to do realtime streamming service with camera and gstreamer software
* http://www.icbanq.com/P007122889 (라즈베리파이 카메라 모듈 V2 8MegaPixel) 

Install gstreamer
```bash
sudo apt update
sudo apt upgrade

sudo apt install gstreamer1.0
----gstreamer installation: start ------------
The following NEW packages will be installed:
  debhelper dh-strip-nondeterminism freepats gstreamer1.0-clutter gstreamer1.0-doc
  gstreamer1.0-dvswitch gstreamer1.0-espeak gstreamer1.0-fluendo-mp3 gstreamer1.0-hybris
  gstreamer1.0-libav gstreamer1.0-libav-dbg gstreamer1.0-packagekit gstreamer1.0-plugins-bad
  gstreamer1.0-plugins-bad-dbg gstreamer1.0-plugins-bad-doc gstreamer1.0-plugins-bad-faad
  gstreamer1.0-plugins-bad-videoparsers gstreamer1.0-plugins-base-apps
  gstreamer1.0-plugins-base-dbg gstreamer1.0-plugins-base-doc gstreamer1.0-plugins-good-dbg
  gstreamer1.0-plugins-good-doc gstreamer1.0-plugins-ugly gstreamer1.0-plugins-ugly-amr
  gstreamer1.0-plugins-ugly-dbg gstreamer1.0-plugins-ugly-doc gstreamer1.0-pocketsphinx
  gstreamer1.0-vaapi gstreamer1.0-vaapi-doc intltool-debian libandroid-properties1
  libarchive-zip-perl libavfilter-ffmpeg5 libavresample-ffmpeg2 libde265-0
  libfile-stripnondeterminism-perl libglib2.0-dev libglib2.0-doc libgstreamer-plugins-bad1.0-0
  libgstreamer1.0-0-dbg libgstreamer1.0-dev libhybris-common1 libmail-sendmail-perl libmedia1
  libmimic0 libmjpegutils-2.1-0 libmms0 libmpeg2encpp-2.1-0 libmpg123-0 libmplex2-2.1-0 libofa0
  libopencore-amrnb0 libopencore-amrwb0 libopencv-calib3d2.4v5 libopencv-contrib2.4v5
  libopencv-features2d2.4v5 libopencv-flann2.4v5 libopencv-highgui2.4v5 libopencv-legacy2.4v5
  libopencv-ml2.4v5 libopencv-objdetect2.4v5 libopencv-video2.4v5 libpcre3-dev libpcre32-3
  libpcrecpp0v5 libpocketsphinx3 libsidplay1v5 libsoundtouch1 libspandsp2 libsphinxbase3 libsrtp0
  libsys-hostname-long-perl libva-wayland1 libvo-aacenc0 libvo-amrwbenc0 libwildmidi-config
  libwildmidi1 libzbar0 po-debconf zlib1g-dev
----gstreamer installation: end ------------
```
Run shell script to stream captured image files
```bash
gst-launch-1.0 --version
vi camera_test.sh
#---------- script code: start -------------------
#!/usr/bin/env bash
MY_IP=$(hostname -I)
echo "My IP Addr is $MY_IP"
raspivid -t 0 -h 720 -w 1280 -fps 25 -hf -b 2000000 -o - | gst-launch-1.0 \
-v fdsrc ! h264parse ! rtph264pay config-interval=1 pt=96 ! gdppay ! tcpserversink host=$MY_IP port=5000
#---------- script code: end -------------------

chmod +x camera_test.sh
./camera_test.sh
```
라즈베리파이 보드에 연결된 터치스크린/모니터에 카메라의 촬영 창이 실행되는 것을 볼수 있다.

안드로이드 모바일 폰은 구글스토어에서 "RaspberryPi Camera viewer"라는 애플리케이션을 검색/설치하면 된다.
그리고나서 해당 모바일 앱을 실행한후에 "+" 아이콘을 클릭하여 메뉴버턴을 생성한다. 생성된 메뉴버턴을 클릭한후 아래의 정보를 입력한다.
* Name: 192.168.219.104
* IP Address: 192.168.219.104
* Port: 5000
* Description: New Raspberry Pi device
* Aspect ratio: 1.6 


# How to enable onboard ALSA audio to play sound file
RPI3보드와 HDMI 모니터간에 HDMI 케이블을 연결할경우에 mp3 플레이가 잘 안되는 문제가 있다. 
* rpi3 를 부팅후에 사운드 플레이 소리가 안들린다면 종종  스피커 선을 rpi3으로부터 분리하였다가 다시 꼽으면 하드웨어적으로 인식이 다시 잘되는 경우가 있었다. 
* 또는 우분투 마테를 부팅시에 로그인 아이디가 아닌 다른 아이디로 터미널환경에서 aplayer/cvlc 명령으로 .mp3를 플레이시에 권한이 없기때문에 사운드 플레이를 할수 없다.


"aplay -l " 명령을 이용하여 사운드 카드 정보를 확인하다. 
```bash
hjoon0510@ubuntu:~$ aplay -l
**** List of PLAYBACK Hardware Devices ****
MobaXterm X11 proxy: Authorisation not recognised
xcb_connection_has_error() returned true
MobaXterm X11 proxy: Authorisation not recognised
card 0: ALSA [bcm2835 ALSA], device 0: bcm2835 ALSA [bcm2835 ALSA]
  Subdevices: 7/8
  Subdevice #0: subdevice #0
  Subdevice #1: subdevice #1
  Subdevice #2: subdevice #2
  Subdevice #3: subdevice #3
  Subdevice #4: subdevice #4
  Subdevice #5: subdevice #5
  Subdevice #6: subdevice #6
  Subdevice #7: subdevice #7
card 0: ALSA [bcm2835 ALSA], device 1: bcm2835 ALSA [bcm2835 IEC958/HDMI]
  Subdevices: 1/1
  Subdevice #0: subdevice #0
```

사운드 플레이를 위하여 커널의 사운드 모듈 (*.ko) 이 잘 실행되는지 확인한다. 
```bash
lsmod | grep snd_Bcm 
snd_bcm2835            20447  1
snd_pcm                75762  2 snd_bcm2835,snd_pcm_oss
snd                    51908  11 snd_bcm2835,snd_pcm_oss,snd_timer,snd_pcm,snd_seq,snd_rawmidi,snd_seq_oss,snd_seq_device,snd_mixer_oss
```

사운드 스피커 플레이를 위하여 우분투 마테 커널의 환경 설정 파일을 아래와 같이 점검한다. 
* 주의사항: 
   * 스피커가 내장된 HDMI 모니터를 이용하여 사운드를 플레이하려면, /boot/config.txt 파일내의 "hdmi_drive=2" 설정을 해주어야 한다. 이 경우에는 사운드는 무조건 RPI3 보드의 내장 스피커가 아닌 HDMI 모니터의 스피커로만 음악이 플레이된다. 
   * 만약 RPI3 보드의 내장 스피커로만 음악이 플레이 되게 하려면, /boot/config.txt 파일내의 "#hdmi_drive=2" 이렇게 주석 설정을 해주면 된다. 

```bash
sudo vi /boot/config.txt
## Enable the onboard ALSA audio (loads snd_bcm2835) (rpi3에 내장되어 있는 사운드 카드를 사용하려고 할때 주석을 해제하여라. 기본 지원임.)
dtparm=audio=on

# Chooses between HDMI and DVI modes (HDMI 모니터가 사운드 스피터 내장되는 모니터 인경우에 주석을 해제하여라.)
hdmi_drive=2
```

이제 .mp3 와 .wav 파일을 실행하여 스피커로 소리가 잘 들리는지 점검한다. 
```bash
aplay /usr/share/scratch/Media/Sounds/Vocals/Singer2.wav
cvlc  /usr/share/scratch/Media/Sounds/Animal/Cat.mp3  --repeat
```


# How to make live stream video using vlc from webcam on Linux

```bash
# Verify Webcam Device on VLC
$ ls /dev/video*
$ vlc v4l2:///dev/video0

# Live Stream Webcam from the Command Line
$ cvlc v4l2:///dev/video0 :v4l2-standard= :input-slave=alsa://hw:0,0 :live-caching=300 :sout="#transcode{vcodec=WMV2,vb=800,scale=1,acodec=wma2,ab=128,channels=2,samplerate=44100}:http{dst=:8080/stream.wmv}"


# Security Protections for Your Webcam Feed
$ vlc http://<ip_address_of_webcam_host>:8080/stream.wmv
$ mplayer http://<ip_address_of_webcam_host>:8080/stream.wmv


```
# How to record your voice from microphone of USB webcam using ALSA
* 참고 사이트 
   * https://www.raspberrypi.org/documentation/configuration/audio-config.md
   * https://www.mythtv.org/wiki/Raspberry_Pi

* Record a voice
```bash
 # make sure your microphone is connected to device
alsamixer
# capture microphone input with arecord

sudo apt install alsa-utils
# check probed audio devices
arecord -l
vi ~/.asoundrc
# http://auction.kr/iBV35PO (Logitech, HD Pro Webcam C920)
# hw:<card-val>,<device-val>
pcm.copy { type plug slave { pcm "hw:2,0" } } ctl.!default { type hw card 2 }

# record void for 10 seconds, then save audio file with .wav format
arecord -D copy -d 10 foo.wav
```
Play recorded audio file
```bash
aplay foo.wav
```

# Play wma file with cvlc and mplayer command
```bash
Please make *.wma file by running recording software on winodws7.
# gksu -u hjoon0510 cvlc ../sound/sound-rain.wma
# mplayer  ./sound/weather-rain.wma
```



# 이메일 발송하기



## ssmtp 프로그램 이용하기

[ssmtp install]
```bash
$ sudo apt-get install ssmtp (smtp를 이용하여 이메일 메세지 발송 프로그램)
$ sudo chmod 755 /etc/ssmtp
$ cd /etc/ssmtp
$ sudo cp ssmtp.conf ssmtp.conf.bak
```

[/etc/ssmtp/ssmtp.conf 파일 설정 변경]
```bash
root=hjoon0510@gmail.com
mailhub=smtp.gmail.com:587
rewriteDomain=
hostname=localhost
UseTLS=YES
UseSTARTTLS=YES
AuthUser=hjoon0510@gmail.com
AuthPass=xxxxxxxxx
FromLineOverride=YES
```

[구글 계정에서 이메일 SMTP 설정권한 변경]

gmail smtp을 사용하여 정상적으로 이메일을 발송할수 있으려면, 
보안 수준을 낮추어 주어야 ssmtp (Simple SMTP)접근 가능하고 이메일 전송이 가능하다.
구글 계정 설정 -> 내 계정 -> 로그인 및 보안 -> 연결된 앱 및 사이트 - [v]보안 수준이 낮은 앱 허용 
* https://myaccount.google.com/security?utm_source=OGB&pli=1


[콘솔 테스트 예제]
ssmtp 명령이 정상적으로로 동작하는지 알기 위해서 -v 옵션을 활용하는 것이 좋다. 
```bash
$ echo "Hi, This is test email." | ssmtp -v 이메일주소

$ vim ./msg.txt
To: myemailaddress@gmail.com
From: myemailaddress@gmail.com
Subject: alert

The server is down!

$ ssmtp 이메일주소  < ./msg.txt
```

[그림파일을 이메일로 첨부하여 보내는 방법: mpack, uuencode]
```bash
$ sudo apt-get install mpack (이메일을 보낼때 파일을 첨부하여주는 프로그램)
$ mpack -s "제목" ./happy.jpg 이메일주소

$ sudo apt install shareutils
$ uuencode file.txt myfile.txt | sendmail user@example.com
```

[디폴트 mta 변경방법]
출력되는 목록들중에서 "sendmail.ssmtp"을 선택해야 한다. 
만약 선택가능한 MTA가 오직 1개이라면 " error: no alternative for mta" 메세지가 나올수 있으며, 
이것은 오류가 없는 정상적인 결과라고 이해하면 된다. 
```bash
$ sudo update-alternatives --config mta
```

[PHP /etc/php/7.0/apache2/php.ini 파일 설정변경]
```bash
수정 전 --> ;sendmail_path = /usr/sbin/sendmail -t -i
수정 후 --> sendmail_path = /usr/sbin/ssmtp -t
```

[Apache 웹서버 재시작하기]
```bash
sudo /etc/init.d/apache2 restart
```

[php언어로 이메일 발송하는 프로그램 코드 예제]
```bash
$ vi gmail_send.php 
<?php
$uname = "PyeongAn_Security";  //받는 사람에게 보여줄 이름을 적는다
$uemail = "MyMail@gmail.com";  //gmail smtp 서버에 등록한 계정의 이메일주소
$from ="=?UTF-8?B?".base64_encode($uname)."?=<$uemail>\r\n";
$headers  = 'MIME-Version: 1.0' ."\r\n";
$headers.='Content-type: text/html; charset=UTF-8' . "\r\n"; 
$headers.='From:  '.$from."\r\n";  
$createday = date("Y-m-d"); 
$to='Receiver@naver.com'; // 받을 사람 이메일 주소 
$subject='Raspberrypi test mail'; // 제목 
$subject = "=?UTF-8?B?".base64_encode($subject)."?=";  // 이메일 제목 깨지지 않도록 인코딩 작업 하기 
$msg="man의 자유공간<br>\n"; // 서명   
mail($to,$subject,$msg,$headers);
?>
```

## PHPMailer 프로그램 이용하기
* https://github.com/PHPMailer/PHPMailer 에서 PHPMailer이라는 오픈소스 라이브러리를 다운로드한다. 
* 예제 프로그램은 ./PHPMailer-master/examples/ 폴더에 위치하여 있다. 
* 이제 아래와 같이 php 소스코드를 작성하여 사용하기마만 하면 된다. 
```bash
 require_once("./PHPMailer/class.phpmailer.php");
 $mail                  = new PHPMailer();
 $mail->IsHTML(true);                         // HTML의 형식으로보냄
 $mail->IsSMTP();
 $mail->SMTPSecure      = "ssl";
 $mail->Port            = 465;                    // 465 or 587 set the SMTPport for the GMAIL server
 $mail->Host            = "smtp.gmail.com";
 $mail->ContentType     = "text/html";
 $mail->Charset         = "utf-8";
 $mail->Encoding        = "base64";
 $mail->SMTPAuth        = true;                   // turn on  SMTP authentication
 $mail->Username        = 구글계정;    
 $mail->Password        = 구글계정SMTP비밀번호;   // SMTP 비밀번호
 $mail->setFrom($mail->Username, "보내는사람");
 $mail->addAddress(받을이메일주소);               // 받을 이메일 주소
 $mail->Subject         = '제목';
 $mail->Body            = '내용';  
 if(!$mail->Send()){
    echo "메일 전송에 실패 하였습니다.\n\n" .
    $mail->ErrorInfo;
 }
 else{ 
    echo "메일 전송에 성공 하였습니다.";
 }

```

구글의 gmail stmp 서비스 설정에 설문제가 있다면 오류가 발생할수 있다. 
```bash
bash$mail->SMTPSecure = "ssl";
$mail->Port = 465; // 465 or 587 set the SMTP port for the GMAIL server
```
위 소스가 안된다면
```bash
$mail->SMTPSecure = "tls";
$mail->Port = 587; // 465 or 587 set the SMTP port for the GMAIL server
```
위 소스를 사용하면 된다. 
stream_socket_enable_crypto 에러가 발생한다면 , php.ini 에서 extension=php_openssl.dll위 php_openssl 모듈을 활성화해야 한다.

실제로 실행을 하면 위의  if(!$mail->Send()) 부분에서 에러가 발생한다. 이문제를 해결하기 위해서 구글 시큐리티로 접속후에  "내 Windows 컴퓨터의 메일"을 생성한다. 그리고나서 만들어진 시큐리티 암호 16값을 제공받아서 위의 소스코드  $mail->Password 에 적용하면 정상적으로 이메일이 발송됨을 확인할수 있다.
* 참고:
   * http://stackoverflow.com/questions/17227532/gmail-530-5-5-1-authentication-required-learn-more-at 
   * https://support.google.com/mail/answer/185833?hl=en&visit_id=1-636532191943049589-646099977&rd=1#
   
```bash
- Select app: smart_secrectary
- Select device: default (don't select)
```

"GENERATE" 버턴을 클릭하면 아래와 같은 app password가 생성된다. 
```bash
- app password: rqnzataqgkdigxxx
```


# How to convert sound file from wma to wav
```
$ ffmpeg -i test.wma test.wav
$ mpalyer test.wav
```


# 터미널을 통한 WiFi 연결

다음 명령을 실행하여 wpa_supplicant.conf 파일을 엽니다. 
wpa_supplicant.conf는 와이파이의 이름과 비밀번호에 대한 정보를 갖고 있는 파일입니다.

```bash
    sudo nano /etc/wpa_supplicant/wpa_supplicant.conf
```

새 이미지의 SD카드일 경우 파일 안에 아무 내용이 없고, 사용하시던 것이라면 기존에 사용하시던 와이파이에 대한 정보가 있을 것입니다. 
다음과 같이 연결할 와이파이에 대한 내용을 추가해 줍니다.

```bash
    network = {
        ssid = "<와이파이 이름>"
        psk = "<와이파이 비밀번호>"
    }
```

ssid 는 와이파이 이름, psk 는 비밀번호에 해당하는 변수 같은 것이 되겠습니다. 비밀번호가 없다면,
```bash
    network = {
        ssid = "<와이파이 이름>"
        key_mgmt = NONE
    }
```

숨겨진 네트워크(공유기 세팅에서 와이파이 이름이 다른 사람에게 뜨지 않게 한 경우)일 경우
```bash
   network = {
        ssid = "<와이파이 이름>"
        scan_ssid = 1
        psk = "<와이파이 비밀번호>"
    }
```
로 해줍니다.

와이파이와 연결이 되었다면 ifconfig wlan0 명령을 통해 확인할 수 있습니다. 
연결이 되지 않았다면 sudo reboot 명령을 통해 재부팅을 해봅니다.




# cron job으로부터 email notifications를 중지하는 방법 

* https://www.a2hosting.com/kb/developer-corner/linux/disabling-e-mail-notifications-from-cron-jobs

This article demonstrates how to stop receiving e-mail notifications from cron jobs.

By default, when a cron job is run, cron sends e-mail notifications to the user account. 
To disable e-mail notifications, append >/dev/null 2>&1 to the command in the cron job. 
This redirects all output from the cron job to the /dev/null device. 
For example, the following cron job does not send e-mail notifications:

$ vi /etc/crontab ( or $ crontab -e ) 
```
15 * * * Sun     /home/username/bigtask.sh > /dev/null 2>&1
```
To resume receiving e-mail notifications from cron jobs, simply remove >/dev/null 2>&1 from the command.

