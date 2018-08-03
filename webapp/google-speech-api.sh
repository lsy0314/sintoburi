#!/usr/bin/env bash

# @title: .m4a 음성파일을 테스트하기 위한 스크립트
# @author: HyeonJun Lim <hjoon0510@gmail.com>

# Configuration variables
# "message": The request is missing a valid API key.
google_speech=~/google-speech-api/php-docs-samples/speech/speech.php

# import license key
export GOOGLE_APPLICATION_CREDENTIALS=/work/sintoburi-79c7917331aa.json

# Check if required commands are prepared
which ffmpeg
which php

# Check if an user types argument1 and argument2.
if [[ $1 == "" && $2 == "" ]]; then
    echo -e "Ooops.!!! Run $0 correctly."
    echo -e "For example, > $0  {raw|flac} {file_name}."
    echo -e "Do not type .m4a in case of {file_name}."
fi

# Running sequence: .m4a --> .flac --> korean text
if [[ $1 == "flac" ]]; then
    lang_locale=ko-KR
    sample_rate=44100
    media_type=FLAC
    sudo ffmpeg -i $2.m4a -af aformat=s16:$sample_rate  $2.flac
    echo -e "---------------------------------------------"
    php $google_speech transcribe  --encoding $media_type --language-code $lang_locale --sample-rate $sample_rate $2.flac
fi

# Running sequence: .m4a --> .raw --> korean text
if [[ $1 == "raw" ]]; then
    lang_locale=ko-KR
    sample_rate=16000
    media_type=LINEAR16
    sudo ffmpeg -y -i $2.m4a -acodec pcm_s16le -f s16le -ac 1 -ar $sample_rate $2.raw
    echo -e "---------------------------------------------"
    php $google_speech transcribe  --encoding $media_type --language-code $lang_locale --sample-rate $sample_rate $2.raw
fi
