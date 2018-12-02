## 윈도우7을 위한 Console  프로그램 설치하기 

#### 방법1: putty (공짜 프로그램) 설치하기 
* https://www.chiark.greenend.org.uk/~sgtatham/putty/latest.html
   * 64-bit: putty-64bit-0.70-installer.msi 다운로드 및 설치할것. 

* Hostname: invain.mooo.com
* Saved Sessions: invain.mooo.com

#### 방법2: mobaxterm (공짜 프로그램) 설치하기
* https://mobaxterm.mobatek.net/download-home-edition.html 
* "MobaXterm Home Edition (Installer edition)"을 다운로드후에 설치하세요. 

## 참고 사이트
* https://brunch.co.kr/@khross3701/4
* https://cloud.google.com/speech-to-text/docs/reference/libraries#client-libraries-usage-php
* https://github.com/GoogleCloudPlatform/php-docs-samples/tree/master/speech

## Google Speech API 개발환경 설치하기: PHP 언어 사용
* 참고사이트
   * https://cloud.google.com/speech-to-text/
   * https://github.com/GoogleCloudPlatform/php-docs-samples/tree/master/speech 
   * https://getcomposer.org/

* 설치 방법 
```bash
ssh id: ****
ssh pass:***

pwd
sudo mkdir -p /work/google-speech-api
sudo chown {your_id}:{your_id} /work/google-speech-api
cd /work/google-speech-api
ls -al 

git clone https://github.com/GoogleCloudPlatform/php-docs-samples.git
cd php-docs-samples/speech
sudo apt install composer
composer install  (또는 composer require google/cloud-speech)
export GOOGLE_APPLICATION_CREDENTIALS=/work/sintoburi-79c7917331aa.json

php speech.php
php speech.php transcribe test/data/audio32KHz.raw --encoding LINEAR16 --sample-rate 32000
php speech.php transcribe-async test/data/audio32KHz.flac --encoding FLAC --sample-rate 32000
php speech.php transcribe-words test/data/audio32KHz.flac --encoding FLAC --sample-rate 32000
```

* Troubleshooting :  proc_open(): fork failed - Cannot allocate memory
   * PHP Fatal error:  Uncaught ErrorException: proc_open(): fork failed - Cannot allocate memory in /usr/share/php/Symfony/Component/Console/Application.php:943

```bash
# To enable the swap you can use for example:

sudo /bin/dd if=/dev/zero of=/var/swap.1 bs=1M count=1024
sudo /sbin/mkswap /var/swap.1
sudo /sbin/swapon /var/swap.1
```

##  내가 녹음한 .m4a  to ( .flac + .raw )으로 변환하기 
* http://doubles.mooo.com/sintoburi/webapp/audio/
```bash
cd ~/google-speech-api/php-docs-samples/speech/
 wget http://doubles.mooo.com/sintoburi/webapp/audio/201807222150_434082af99805667cc9e060ba55fb083.m4a
```

* from .m4a to PCM raw
```bash
cd ~/google-speech-api/php-docs-samples/speech/
ffmpeg -y -i 201807201630.m4a -acodec pcm_s16le -f s16le -ac 1 -ar 16000 201807201630.raw

* -f s16le 옵션 의미: frequency, signed 16-bit little endian samples
* -ac 1 옵션 의미 : 1 audio channels (stereo)
* -ar 16000 옵션 의미: audio sample rate 16,000Hz
```

* from .m4a to .flac
```bash
cd ~/google-speech-api/php-docs-samples/speech/
ffmpeg -i 201807201630.m4a -f flac 201807201630.flac

ffmpeg -i 201807201630.m4a -ac 1 -af aformat=s16:44100 201807201630.flac  (**RECOMMENDED**)
* 설명: The above command encodes to  44.1 kHz and 16-bit sample.

ffmpeg -i 201807201630.m4a -ac 1 -af aformat=s32:176000 201807201630.flac
* 설명: The above command encodes to a 176 kHz and 24-bit sample, stored as 32-bits. 
```



##  Speech-To-Text 변환 테스트하기 
* Run .raw
```bash
cd ~/google-speech-api/php-docs-samples/speech/ 

file ~/google-speech-api/20180720_195535.raw
/var/www/khs7516/google-speech-api/20180720_195535.raw: data


php speech.php transcribe ~/google-speech-api/20180720_195535.raw  --encoding LINEAR16 --language-code ko-KR --sample-rate 16000
Transcript: 녹음 기능을 다시 테스트해 봅니다 지금은 곰 레코드 프로그램을 이용하여 녹음 하고 있고요 녹음 파일의 포맷은 m4a입니다
Confidence: 0.85077333

php speech.php transcribe ~/google-speech-api/20180720_195535.raw --encoding LINEAR16 --language-code ko-KR --sample-rate 32000                 
Transcript: 녹음 기능을 다시 톨스 톨스 근데 지금은 꽃무늬 코드 프로그램을 이용하여 녹음 하고 있고요 녹음 파일 보물섬 m4a입니다                                                                                 
Confidence: 0.8391638

php speech.php transcribe ~/google-speech-api/20180720_195535.raw  --encoding LINEAR16 --language-code ko-KR --sample-rate 42000
( * 실험 결과: sample-rate 수치를 42,000으로 하였을때, 아무런 결과가 출력되지 않았음.)
```

* Run .flac
```bash
php speech.php transcribe ~/google-speech-api/201807222150_434082af99805667cc9e060ba55fb083.flac  --encoding FLAC --language-code ko-KR --sample-rate 44100
Transcript: 지금 상추 가게 오시면은 특별히 오늘만 상추를 60% 할인된 가격으로 여러분 고객님은들을 모십니다 지금 빨리 어서 오십시오
Confidence: 0.8430271
```

## Terminology
* FLAC(Free Lossless Audio Codec, /ˈflæk/)은 오디오 데이터 압축을 위한 파일 형식이다. 무손실 압축 포맷이다. 다시 말해서, MP3, AAC, Vorbis와는 달리 오디오 스트림에 손실이 발생하지 않는다.
* PCM raw: 압축되지 않는 Raw 오디오 포맷이다. 

*  주파수별 소리 정확도
   * 11,025Hz: 일반적인 사람 목소리 수준
   * 22,050Hz:  카세트 테이프 음성 수준
   * 44,100Hz:  CD  음성 수준


## 초간단 테스트 방법(flac사용)
```

cd /var/www/html/sintoburi/webapp/audio/20180804
export GOOGLE_APPLICATION_CREDENTIALS=/work/sintoburi-79c7917331aa.json

sudo rm -f 201808042130_45e234af17ecda8a63889767053b1b89.flac
sudo ffmpeg -i 201808042130_45e234af17ecda8a63889767053b1b89.m4a -af aformat=s16:44100 201808042130_45e234af17ecda8a63889767053b1b89.flac

speech=/home/hjoon0510/google-speech-api/php-docs-samples/speech/speech.php 
/usr/bin/php $speech transcribe 201808042130_45e234af17ecda8a63889767053b1b89.flac  --encoding FLAC --language-code ko-KR --sample-rate 44100

```

## .flac / .raw 사운드 플레이 테스트하기

### How to play .flac file
```
Rhythmbox (the default player)
Clementine
Amarok
Xnoise
Banshee
Tomahawk
Lollypop
Guayadeque
Cmus (if you like simple music players in the Terminal window)
```

### How to play .raw file
```
sudo apt -y install sox
time play -t raw -r 16k -e signed -b 16 -c 1  ./output_all.raw

sudo apt -y install ffmpeg
time ffplay -f s16le -ar 16k -ac 1 ./output_all.raw 

sudo apt -y  alsa-util
time aplay -t raw -r 16k -c 1 -f S16_LE ./output_all.raw 

```

